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

class Response extends AbstractResponse
{

    public function serve(): PsrResponseInterface
    {
        if (!empty($this->params['echostr'])) {
            return $this->sendBody($this->params['echostr']);
        }
        $message = $this->getDecryptedMessage();
        $response = $this->middleware->handler($this,$message);
        return $this;
    }
}
