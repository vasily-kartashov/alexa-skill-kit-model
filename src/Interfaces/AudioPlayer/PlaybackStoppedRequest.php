<?php

namespace Alexa\Model\Interfaces\AudioPlayer;

use Alexa\Model\Request;
use JsonSerializable;

final class PlaybackStoppedRequest extends Request implements JsonSerializable
{
    const TYPE = 'AudioPlayer.PlaybackStopped';

    /** @var int|null */
    private $offsetInMilliseconds = null;

    /** @var string|null */
    private $token = null;

    protected function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE;
    }

    /**
     * @return int|null
     */
    public function offsetInMilliseconds()
    {
        return $this->offsetInMilliseconds;
    }

    /**
     * @return string|null
     */
    public function token()
    {
        return $this->token;
    }

    public static function builder(): PlaybackStoppedRequestBuilder
    {
        $instance = new self;
        return new class($constructor = function ($offsetInMilliseconds, $token) use ($instance): PlaybackStoppedRequest {
            $instance->offsetInMilliseconds = $offsetInMilliseconds;
            $instance->token = $token;
            return $instance;
        }) extends PlaybackStoppedRequestBuilder {};
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->type = self::TYPE;
        $instance->offsetInMilliseconds = isset($data['offsetInMilliseconds']) ? ((int) $data['offsetInMilliseconds']) : null;
        $instance->token = isset($data['token']) ? ((string) $data['token']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'offsetInMilliseconds' => $this->offsetInMilliseconds,
            'token' => $this->token
        ]);
    }
}
