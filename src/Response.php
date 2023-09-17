<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/9/3 19:16
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinMiniProgram;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Weida\WeixinCore\AbstractResponse;
use GuzzleHttp\Psr7\Response as Psr7Response;

class Response extends AbstractResponse
{
    public function response(): PsrResponseInterface
    {
        $resp = new Psr7Response(200,[],'success');
        if (!empty($this->params['echostr'])) {
            return $resp->withBody($this->createBody($this->params['echostr']));
        }
        $message = $this->getDecryptedMessage();
        $response = $this->middleware->handler($this,$message);
        if($response){
        }
        return $resp;
    }

}
