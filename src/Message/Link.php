<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/9/3 20:54
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinMiniProgram\Message;

use Weida\WeixinCore\Contract\MessageInterface;

class Link implements MessageInterface
{
    private array $attributes=[];
    public function __construct(string $title='',string $description='',string $url='',string $thumbUrl='')
    {
        $this->attributes=[
            'title'=>$title,
            'description'=>$description,
            'url'=>$url,
            'thumb_url'=>$thumbUrl
        ];
    }

    public function setAttributes(array|string $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function getAttributes(): array
    {
        return [
            'msgtype'=>'link',
            'link'=>[
                'title'=>$this->attributes['title']??'',
                'description'=>$this->attributes['description']??'',
                'url'=>$this->attributes['url']??'',
                'thumb_url'=>$this->attributes['thumb_url']??''
            ]
        ];
    }
}
