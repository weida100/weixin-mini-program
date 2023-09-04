<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/9/3 20:50
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinMiniProgram\Message;

use Weida\WeixinCore\Contract\MessageInterface;

class Message implements MessageInterface
{
    private array $attributes=[];

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @param string $media_id
     * @return Image
     * @author Weida
     */
    public static function Image(string $media_id):Image{
        return new Image($media_id);
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $url
     * @param string $thumbUrl
     * @return Link
     * @author Weida
     */
    public static function Link(string $title='',string $description='',string $url='',string $thumbUrl=''):Link{
        return new Link( $title, $description, $url, $thumbUrl);
    }

    /**
     * @param string $title
     * @param string $pagePath
     * @param string $thumbMediaId
     * @return MiniProgram
     * @author Weida
     */
    public static function MiniProgram(string $title='',string $pagePath='',string $thumbMediaId=''):MiniProgram{
        return new MiniProgram( $title, $pagePath, $thumbMediaId);
    }

    /**
     * @param string $content
     * @return Text
     * @author Weida
     */
    public static function Text(string $content):Text {
        return new Text($content);
    }

    /**
     * @param array|string $attributes
     * @return void
     * @author Weida
     */
    public function setAttributes(array|string $attributes): void
    {
        $this->attributes = (array)$attributes;
    }

    /**
     * @return array
     * @author Weida
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
