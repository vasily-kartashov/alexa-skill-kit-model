<?php

namespace Alexa\Model\Services\GameEngine;

use \JsonSerializable;

final class Pattern implements JsonSerializable
{
    /** @var string[] */
    private $gadgetIds = [];

    /** @var string[] */
    private $colors = [];

    /** @var InputEventActionType|null */
    private $action = null;

    protected function __construct()
    {
    }

    /**
     * @return string[]
     */
    public function gadgetIds()
    {
        return $this->gadgetIds;
    }

    /**
     * @return string[]
     */
    public function colors()
    {
        return $this->colors;
    }

    /**
     * @return InputEventActionType|null
     */
    public function action()
    {
        return $this->action;
    }

    public static function builder(): PatternBuilder
    {
        $instance = new self();
        $constructor = function ($gadgetIds, $colors, $action) use ($instance): Pattern {
            $instance->gadgetIds = $gadgetIds;
            $instance->colors = $colors;
            $instance->action = $action;
            return $instance;
        };
        return new class($constructor) extends PatternBuilder
        {
            public function __construct(callable $constructor)
            {
                parent::__construct($constructor);
            }
        };
    }

    public static function fromValue(array $data)
    {
        $instance = new self();
        $instance->gadgetIds = [];
        foreach ($data['gadgetIds'] as $item) {
            $element = isset($item) ? ((string) $item) : null;
            if ($element) {
                $instance->gadgetIds[] = $element;
            }
        }
        $instance->colors = [];
        foreach ($data['colors'] as $item) {
            $element = isset($item) ? ((string) $item) : null;
            if ($element) {
                $instance->colors[] = $element;
            }
        }
        $instance->action = isset($data['action']) ? InputEventActionType::fromValue($data['action']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'gadgetIds' => $this->gadgetIds,
            'colors' => $this->colors,
            'action' => $this->action
        ]);
    }
}