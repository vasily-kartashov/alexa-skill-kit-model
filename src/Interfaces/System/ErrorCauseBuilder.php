<?php

namespace Alexa\Model\Interfaces\System;

abstract class ErrorCauseBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $requestId = null;

    public function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param string $requestId
     * @return self
     */
    public function withRequestId(string $requestId): self
    {
        $this->requestId = $requestId;
        return $this;
    }

    public function build(): ErrorCause
    {
        return ($this->constructor)(
            $this->requestId
        );
    }
}
