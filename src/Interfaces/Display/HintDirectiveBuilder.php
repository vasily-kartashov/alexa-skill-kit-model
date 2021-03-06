<?php

namespace Alexa\Model\Interfaces\Display;

abstract class HintDirectiveBuilder
{
    /** @var callable */
    private $constructor;

    /** @var Hint|null */
    private $hint = null;

    public function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param Hint $hint
     * @return self
     */
    public function withHint(Hint $hint): self
    {
        $this->hint = $hint;
        return $this;
    }

    public function build(): HintDirective
    {
        return ($this->constructor)(
            $this->hint
        );
    }
}
