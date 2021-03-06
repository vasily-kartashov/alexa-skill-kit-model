<?php

namespace Alexa\Model\Interfaces\Connections\Requests;

use JsonSerializable;

final class PrintWebPageRequest extends BaseRequest implements JsonSerializable
{
    const TYPE = 'PrintWebPageRequest';

    /** @var string|null */
    private $title = null;

    /** @var string|null */
    private $url = null;

    /** @var string|null */
    private $description = null;

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
    public function url()
    {
        return $this->url;
    }

    /**
     * @return string|null
     */
    public function description()
    {
        return $this->description;
    }

    public static function builder(): PrintWebPageRequestBuilder
    {
        $instance = new self;
        return new class($constructor = function ($title, $url, $description) use ($instance): PrintWebPageRequest {
            $instance->title = $title;
            $instance->url = $url;
            $instance->description = $description;
            return $instance;
        }) extends PrintWebPageRequestBuilder {};
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
        $instance->url = isset($data['url']) ? ((string) $data['url']) : null;
        $instance->description = isset($data['description']) ? ((string) $data['description']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'title' => $this->title,
            'url' => $this->url,
            'description' => $this->description
        ]);
    }
}
