<?php

namespace Alexa\Model;

use JsonSerializable;

final class Person implements JsonSerializable
{
    /** @var string|null */
    private $personId = null;

    /** @var string|null */
    private $accessToken = null;

    protected function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function personId()
    {
        return $this->personId;
    }

    /**
     * @return string|null
     */
    public function accessToken()
    {
        return $this->accessToken;
    }

    public static function builder(): PersonBuilder
    {
        $instance = new self;
        return new class($constructor = function ($personId, $accessToken) use ($instance): Person {
            $instance->personId = $personId;
            $instance->accessToken = $accessToken;
            return $instance;
        }) extends PersonBuilder {};
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->personId = isset($data['personId']) ? ((string) $data['personId']) : null;
        $instance->accessToken = isset($data['accessToken']) ? ((string) $data['accessToken']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'personId' => $this->personId,
            'accessToken' => $this->accessToken
        ]);
    }
}
