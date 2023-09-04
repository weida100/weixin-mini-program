<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/7/20 00:39
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinMiniProgram;

use Psr\Http\Message\ResponseInterface;
use Weida\WeixinCore\AbstractApplication;

class Application extends AbstractApplication
{
    protected string $appType='miniApp';

    protected ?Session $session=null;


    public function getResponse(): ResponseInterface
    {
        if(empty($this->response)){
            $this->response = new Response(
                $this->getRequest(),
                $this->getEncryptor(),
                $this->getAppType() //用来区别事件
            );
        }
        return $this->response;
    }

    public function getSession():Session{
        if(empty($this->session)){
            $this->session = new Session(
                appid: $this->getAccount()->getAppId(),
                secret:$this->getAccount()->getSecret(),
                accessToken:$this->getAccessToken(),
                httpClient: $this->getHttpClient()
            );
        }
        return $this->session;
    }

}
