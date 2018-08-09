<?php

namespace Alexa\Model\Services\Directive;

abstract class HeaderBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $requestId = null;

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    public function withRequestId(string $requestId): self
    {
        $this->requestId = $requestId;
        return $this;
    }

    public function build(): Header
    {
        return ($this->constructor)(
            $this->requestId
        );
    }
}