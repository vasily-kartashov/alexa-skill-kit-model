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

    public function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param string $contentDescription
     * @return self
     */
    public function withContentDescription(string $contentDescription): self
    {
        $this->contentDescription = $contentDescription;
        return $this;
    }

    /**
     * @param array $sources
     * @return self
     */
    public function withSources(array $sources): self
    {
        foreach ($sources as $element) {
            assert($element instanceof ImageInstance);
        }
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
