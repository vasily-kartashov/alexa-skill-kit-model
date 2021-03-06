<?php

namespace Alexa\Model\Interfaces\System;

use JsonSerializable;

final class ErrorCause implements JsonSerializable
{
    /** @var string|null */
    private $requestId = null;

    protected function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function requestId()
    {
        return $this->requestId;
    }

    public static function builder(): ErrorCauseBuilder
    {
        $instance = new self;
        return new class($constructor = function ($requestId) use ($instance): ErrorCause {
            $instance->requestId = $requestId;
            return $instance;
        }) extends ErrorCauseBuilder {};
    }

    /**
     * @param string $requestId
     * @return self
     */
    public static function ofRequestId(string $requestId): ErrorCause
    {
        $instance = new self;
        $instance->requestId = $requestId;
        return $instance;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->requestId = isset($data['requestId']) ? ((string) $data['requestId']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'requestId' => $this->requestId
        ]);
    }
}
