<?php

namespace Alexa\Model\Interfaces\Alexa\Presentation\Apl;

abstract class RuntimeBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $maxVersion = null;

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    public function withMaxVersion(string $maxVersion): self
    {
        $this->maxVersion = $maxVersion;
        return $this;
    }

    public function build(): Runtime
    {
        return ($this->constructor)(
            $this->maxVersion
        );
    }
}
