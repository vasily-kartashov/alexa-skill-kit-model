<?php

namespace Alexa\Model\Interfaces\AudioPlayer;

use JsonSerializable;

final class CurrentPlaybackState implements JsonSerializable
{
    /** @var int|null */
    private $offsetInMilliseconds = null;

    /** @var PlayerActivity|null */
    private $playerActivity = null;

    /** @var string|null */
    private $token = null;

    protected function __construct()
    {
    }

    /**
     * @return int|null
     */
    public function offsetInMilliseconds()
    {
        return $this->offsetInMilliseconds;
    }

    /**
     * @return PlayerActivity|null
     */
    public function playerActivity()
    {
        return $this->playerActivity;
    }

    /**
     * @return string|null
     */
    public function token()
    {
        return $this->token;
    }

    public static function builder(): CurrentPlaybackStateBuilder
    {
        $instance = new self;
        return new class($constructor = function ($offsetInMilliseconds, $playerActivity, $token) use ($instance): CurrentPlaybackState {
            $instance->offsetInMilliseconds = $offsetInMilliseconds;
            $instance->playerActivity = $playerActivity;
            $instance->token = $token;
            return $instance;
        }) extends CurrentPlaybackStateBuilder {};
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->offsetInMilliseconds = isset($data['offsetInMilliseconds']) ? ((int) $data['offsetInMilliseconds']) : null;
        $instance->playerActivity = isset($data['playerActivity']) ? PlayerActivity::fromValue($data['playerActivity']) : null;
        $instance->token = isset($data['token']) ? ((string) $data['token']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'offsetInMilliseconds' => $this->offsetInMilliseconds,
            'playerActivity' => $this->playerActivity,
            'token' => $this->token
        ]);
    }
}
