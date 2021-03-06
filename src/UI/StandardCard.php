<?php

namespace Alexa\Model\UI;

use JsonSerializable;

final class StandardCard extends Card implements JsonSerializable
{
    const TYPE = 'Standard';

    /** @var string|null */
    private $title = null;

    /** @var string|null */
    private $text = null;

    /** @var Image|null */
    private $image = null;

    protected function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE;
    }

    /**
     * @return string|null
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function text()
    {
        return $this->text;
    }

    /**
     * @return Image|null
     */
    public function image()
    {
        return $this->image;
    }

    public static function builder(): StandardCardBuilder
    {
        $instance = new self;
        return new class($constructor = function ($title, $text, $image) use ($instance): StandardCard {
            $instance->title = $title;
            $instance->text = $text;
            $instance->image = $image;
            return $instance;
        }) extends StandardCardBuilder {};
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->type = self::TYPE;
        $instance->title = isset($data['title']) ? ((string) $data['title']) : null;
        $instance->text = isset($data['text']) ? ((string) $data['text']) : null;
        $instance->image = isset($data['image']) ? Image::fromValue($data['image']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'title' => $this->title,
            'text' => $this->text,
            'image' => $this->image
        ]);
    }
}
