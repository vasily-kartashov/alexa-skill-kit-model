<?php

namespace Alexa\Model\Interfaces\Display;

abstract class ImageBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $contentDescription = null;

    /** @var ImageInstance[] */
    private $sources = [];

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    public function withContentDescription(string $contentDescription): self
    {
        $this->contentDescription = $contentDescription;
        return $this;
    }

    /**
     * @param ImageInstance[] $sources
     * @return self
     */
    public function withSources(array $sources): self
    {
        $this->sources = $sources;
        return $this;
    }

    public function build(): Image
    {
        return ($this->constructor)(
            $this->contentDescription,
            $this->sources
        );
    }
}