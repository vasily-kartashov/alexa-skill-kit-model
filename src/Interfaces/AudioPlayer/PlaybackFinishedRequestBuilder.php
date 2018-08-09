<?php

namespace Alexa\Model\Interfaces\AudioPlayer;

use Alexa\Model\Request;

abstract class PlaybackFinishedRequestBuilder
{
    /** @var callable */
    private $constructor;

    /** @var int|null */
    private $offsetInMilliseconds = null;

    /** @var string|null */
    private $token = null;

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    public function withOffsetInMilliseconds(int $offsetInMilliseconds): self
    {
        $this->offsetInMilliseconds = $offsetInMilliseconds;
        return $this;
    }

    public function withToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    public function build(): PlaybackFinishedRequest
    {
        return ($this->constructor)(
            $this->offsetInMilliseconds,
            $this->token
        );
    }
}
