<?php

namespace Alexa\Model\Interfaces\Display;

abstract class PlainTextBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $text = null;

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    public function withText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function build(): PlainText
    {
        return ($this->constructor)(
            $this->text
        );
    }
}
