<?php

namespace Alexa\Model\Events\SkillEvents;

use JsonSerializable;

final class ProactiveSubscriptionChangedBody implements JsonSerializable
{
    /** @var ProactiveSubscriptionEvent[] */
    private $subscriptions = [];

    protected function __construct()
    {
    }

    /**
     * @return ProactiveSubscriptionEvent[]
     */
    public function subscriptions()
    {
        return $this->subscriptions;
    }

    public static function builder(): ProactiveSubscriptionChangedBodyBuilder
    {
        $instance = new self;
        return new class($constructor = function ($subscriptions) use ($instance): ProactiveSubscriptionChangedBody {
            $instance->subscriptions = $subscriptions;
            return $instance;
        }) extends ProactiveSubscriptionChangedBodyBuilder {};
    }

    /**
     * @param array $subscriptions
     * @return self
     */
    public static function ofSubscriptions(array $subscriptions): ProactiveSubscriptionChangedBody
    {
        $instance = new self;
        $instance->subscriptions = $subscriptions;
        return $instance;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->subscriptions = [];
        if (isset($data['subscriptions'])) {
            foreach ($data['subscriptions'] as $item) {
                $element = isset($item) ? ProactiveSubscriptionEvent::fromValue($item) : null;
                if ($element !== null) {
                    $instance->subscriptions[] = $element;
                }
            }
        }
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'subscriptions' => $this->subscriptions
        ]);
    }
}
