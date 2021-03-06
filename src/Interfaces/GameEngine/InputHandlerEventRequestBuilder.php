<?php

namespace Alexa\Model\Interfaces\GameEngine;

use Alexa\Model\Services\GameEngine\InputHandlerEvent;

abstract class InputHandlerEventRequestBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $originatingRequestId = null;

    /** @var InputHandlerEvent[] */
    private $events = [];

    public function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param string $originatingRequestId
     * @return self
     */
    public function withOriginatingRequestId(string $originatingRequestId): self
    {
        $this->originatingRequestId = $originatingRequestId;
        return $this;
    }

    /**
     * @param array $events
     * @return self
     */
    public function withEvents(array $events): self
    {
        foreach ($events as $element) {
            assert($element instanceof InputHandlerEvent);
        }
        $this->events = $events;
        return $this;
    }

    public function build(): InputHandlerEventRequest
    {
        return ($this->constructor)(
            $this->originatingRequestId,
            $this->events
        );
    }
}
