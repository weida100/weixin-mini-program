<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/9/3 20:53
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinMiniProgram\Message;

use Weida\WeixinCore\Contract\MessageInterface;
use Weida\WeixinCore\Message;

class Image implements MessageInterface
{
    private array $attributes=[];
    public function __construct(string $media_id)
    {
        $this->attributes['media_id'] = $media_id;
    }

    public function setAttributes(array|string $attributes): void
    {
        $this->attributes['media_id'] = strval($attributes);
    }

    public function getAttributes(): array
    {
        return [
            'msgtype'=>Message::TYPE_IMAGE,
            'image'=>[
                'media_id'=>$this->attributes['media_id']
            ]
        ];
    }
}
