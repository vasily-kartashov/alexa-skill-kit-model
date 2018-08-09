<?php

namespace Alexa\Model\Interfaces\GameEngine;

use Alexa\Model\Request;
use Alexa\Model\Services\GameEngine\InputHandlerEvent;

abstract class InputHandlerEventRequestBuilder
{
    /** @var callable */
    private $constructor;

    /** @var InputHandlerEvent[] */
    private $events = [];

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param InputHandlerEvent[] $events
     * @return self
     */
    public function withEvents(array $events): self
    {
        $this->events = $events;
        return $this;
    }

    public function build(): InputHandlerEventRequest
    {
        return ($this->constructor)(
            $this->events
        );
    }
}