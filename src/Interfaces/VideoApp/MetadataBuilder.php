<?php

namespace Alexa\Model\Interfaces\VideoApp;

abstract class MetadataBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $title = null;

    /** @var string|null */
    private $subtitle = null;

    public function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param string $title
     * @return self
     */
    public function withTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $subtitle
     * @return self
     */
    public function withSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    public function build(): Metadata
    {
        return ($this->constructor)(
            $this->title,
            $this->subtitle
        );
    }
}
