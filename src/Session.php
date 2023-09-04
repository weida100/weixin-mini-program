<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/9/3 21:33
 * Email: 150560159@qq.com
 */

namespace Weida\WeixinMiniProgram;

use RuntimeException;
use Throwable;
use Weida\WeixinCore\Contract\AccessTokenInterface;
use Weida\WeixinCore\Contract\HttpClientInterface;

class Session
{
    private string $appid;
    private string $secret;
    private ?AccessTokenInterface $accessToken=null;
    private ?HttpClientInterface $httpClient=null;
    public function __construct(string $appid,string $secret, ?AccessTokenInterface $accessToken,?HttpClientInterface $httpClient)
    {
        $this->appid = $appid;
        $this->secret = $secret;
        $this->accessToken = $accessToken;
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $code
     * @return array
     * @throws Throwable
     * @author Weida
     */
    public function login(string $code):array {
        $key = $this->accessToken->getCacheKey();
        if(str_contains($key,'open_platform')){
            return $this->_openPlatformMiniLogin($code);
        }else{
            return $this->_miniLogin($code);
        }
    }

    /**
     * 小程序自己登录
     * @param string $code
     * @return array
     * @throws Throwable
     * @author Weida
     */
    private function _miniLogin(string $code):array{
        $resp = $this->httpClient->request('GET','/sns/jscode2session',[
            'query'=>[
                'appid'=>$this->appid,
                'secret'=>$this->secret,
                'js_code'=>$code,
                'grant_type'=>'authorization_code'
            ]
        ]);
        if($resp->getStatusCode()!=200){
            throw new RuntimeException('Request login exception');
        }
        $arr = json_decode($resp->getBody()->getContents(),true);
        if (empty($arr['session_key'])) {
            throw new RuntimeException('Failed to get session_key: ' . json_encode($arr, JSON_UNESCAPED_UNICODE));
        }
        return $arr;
    }

    /**
     * @param string $code
     * @return array
     * @author Weida
     */
    private function _openPlatformMiniLogin(string $code):array{

        $resp = $this->httpClient->request('GET','/sns/jscode2session',[
            'query'=>[
                'component_access_token'=>$this->accessToken->getToken(),
                'appid'=>$this->appid,
                'grant_type'=>'authorization_code',
                'component_appid'=>$this->secret,
                'js_code'=>$code,
            ]
        ]);
        if($resp->getStatusCode()!=200){
            throw new RuntimeException('Request login exception');
        }
        $arr = json_decode($resp->getBody()->getContents(),true);
        if (empty($arr['session_key'])) {
            throw new RuntimeException('Failed to get session_key: ' . json_encode($arr, JSON_UNESCAPED_UNICODE));
        }
        return $arr;
    }

    public function check(string $openid):bool{

    }
}
