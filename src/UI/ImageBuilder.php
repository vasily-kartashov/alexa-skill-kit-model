<?php

namespace Alexa\Model\UI;

abstract class ImageBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $smallImageUrl = null;

    /** @var string|null */
    private $largeImageUrl = null;

    public function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param string $smallImageUrl
     * @return self
     */
    public function withSmallImageUrl(string $smallImageUrl): self
    {
        $this->smallImageUrl = $smallImageUrl;
        return $this;
    }

    /**
     * @param string $largeImageUrl
     * @return self
     */
    public function withLargeImageUrl(string $largeImageUrl): self
    {
        $this->largeImageUrl = $largeImageUrl;
        return $this;
    }

    public function build(): Image
    {
        return ($this->constructor)(
            $this->smallImageUrl,
            $this->largeImageUrl
        );
    }
}
