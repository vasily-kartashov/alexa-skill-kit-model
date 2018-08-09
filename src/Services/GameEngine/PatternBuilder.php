<?php

namespace Alexa\Model\Services\GameEngine;

abstract class PatternBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string[] */
    private $gadgetIds = [];

    /** @var string[] */
    private $colors = [];

    /** @var InputEventActionType|null */
    private $action = null;

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param string[] $gadgetIds
     * @return self
     */
    public function withGadgetIds(array $gadgetIds): self
    {
        $this->gadgetIds = $gadgetIds;
        return $this;
    }

    /**
     * @param string[] $colors
     * @return self
     */
    public function withColors(array $colors): self
    {
        $this->colors = $colors;
        return $this;
    }

    public function withAction(InputEventActionType $action): self
    {
        $this->action = $action;
        return $this;
    }

    public function build(): Pattern
    {
        return ($this->constructor)(
            $this->gadgetIds,
            $this->colors,
            $this->action
        );
    }
}