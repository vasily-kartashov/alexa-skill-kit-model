<?php

namespace Alexa\Model\Services\GameEngine;

abstract class InputHandlerEventBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $name = null;

    /** @var InputEvent[] */
    private $inputEvents = [];

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    public function withName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param InputEvent[] $inputEvents
     * @return self
     */
    public function withInputEvents(array $inputEvents): self
    {
        $this->inputEvents = $inputEvents;
        return $this;
    }

    public function build(): InputHandlerEvent
    {
        return ($this->constructor)(
            $this->name,
            $this->inputEvents
        );
    }
}
