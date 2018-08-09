<?php

namespace Alexa\Model\Services\GameEngine;

abstract class PatternRecognizerBuilder
{
    /** @var callable */
    private $constructor;

    /** @var PatternRecognizerAnchorType|null */
    private $anchor = null;

    /** @var bool|null */
    private $fuzzy = null;

    /** @var string[] */
    private $gadgetIds = [];

    /** @var string[] */
    private $actions = [];

    /** @var Pattern[] */
    private $pattern = [];

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    public function withAnchor(PatternRecognizerAnchorType $anchor): self
    {
        $this->anchor = $anchor;
        return $this;
    }

    public function withFuzzy(bool $fuzzy): self
    {
        $this->fuzzy = $fuzzy;
        return $this;
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
     * @param string[] $actions
     * @return self
     */
    public function withActions(array $actions): self
    {
        $this->actions = $actions;
        return $this;
    }

    /**
     * @param Pattern[] $pattern
     * @return self
     */
    public function withPattern(array $pattern): self
    {
        $this->pattern = $pattern;
        return $this;
    }

    public function build(): PatternRecognizer
    {
        return ($this->constructor)(
            $this->anchor,
            $this->fuzzy,
            $this->gadgetIds,
            $this->actions,
            $this->pattern
        );
    }
}