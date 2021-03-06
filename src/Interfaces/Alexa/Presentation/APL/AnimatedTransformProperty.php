<?php

namespace Alexa\Model\Interfaces\Alexa\Presentation\APL;

use JsonSerializable;

final class AnimatedTransformProperty extends AnimatedProperty implements JsonSerializable
{
    const PROPERTY = 'transform';

    /** @var TransformProperty[] */
    private $from = [];

    /** @var TransformProperty[] */
    private $to = [];

    protected function __construct()
    {
        parent::__construct();
        $this->property = self::PROPERTY;
    }

    /**
     * @return TransformProperty[]
     */
    public function from()
    {
        return $this->from;
    }

    /**
     * @return TransformProperty[]
     */
    public function to()
    {
        return $this->to;
    }

    public static function builder(): AnimatedTransformPropertyBuilder
    {
        $instance = new self;
        return new class($constructor = function ($from, $to) use ($instance): AnimatedTransformProperty {
            $instance->from = $from;
            $instance->to = $to;
            return $instance;
        }) extends AnimatedTransformPropertyBuilder {};
    }


    public function jsonSerialize(): array
    {
        return array_filter([
            'property' => self::PROPERTY,
            'from' => $this->from,
            'to' => $this->to
        ]);
    }
}
