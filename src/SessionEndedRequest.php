<?php

namespace Alexa\Model;

use JsonSerializable;

final class SessionEndedRequest extends Request implements JsonSerializable
{
    const TYPE = 'SessionEndedRequest';

    /** @var SessionEndedReason|null */
    private $reason = null;

    /** @var SessionEndedError|null */
    private $error = null;

    protected function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE;
    }

    /**
     * @return SessionEndedReason|null
     */
    public function reason()
    {
        return $this->reason;
    }

    /**
     * @return SessionEndedError|null
     */
    public function error()
    {
        return $this->error;
    }

    public static function builder(): SessionEndedRequestBuilder
    {
        $instance = new self;
        return new class($constructor = function ($reason, $error) use ($instance): SessionEndedRequest {
            $instance->reason = $reason;
            $instance->error = $error;
            return $instance;
        }) extends SessionEndedRequestBuilder {};
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->type = self::TYPE;
        $instance->reason = isset($data['reason']) ? SessionEndedReason::fromValue($data['reason']) : null;
        $instance->error = isset($data['error']) ? SessionEndedError::fromValue($data['error']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'reason' => $this->reason,
            'error' => $this->error
        ]);
    }
}
