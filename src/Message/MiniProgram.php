<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/9/3 21:02
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinMiniProgram\Message;

use Weida\WeixinCore\Contract\MessageInterface;

class MiniProgram implements MessageInterface
{
    private array $attributes=[];
    public function __construct(string $title='',string $pagePath='',string $thumbMediaId='')
    {
        $this->attributes=[
            'title'=>$title,
            'pagepath'=>$pagePath,
            'thumb_media_id'=>$thumbMediaId
        ];
    }

    public function setAttributes(array|string $attributes): void
    {
       $this->attributes = (array)$attributes;
    }

    public function getAttributes(): array
    {
        return [
            'msgtype'=>'miniprogrampage',
            'miniprogrampage'=>[
                'title'=>$this->attributes['title']??'',
                'pagepath'=>$this->attributes['pagepath']??'',
                'thumb_media_id'=>$this->attributes['thumb_media_id']??'',
            ]
        ];
    }
}
