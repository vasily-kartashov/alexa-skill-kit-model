<?php

namespace Alexa\Model\Events\SkillEvents;

abstract class ProactiveSubscriptionEventBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $eventName = null;

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    public function withEventName(string $eventName): self
    {
        $this->eventName = $eventName;
        return $this;
    }

    public function build(): ProactiveSubscriptionEvent
    {
        return ($this->constructor)(
            $this->eventName
        );
    }
}
