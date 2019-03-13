<?php

namespace Alexa\Model\Interfaces\Connections\Entities;

abstract class RestaurantBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $name = null;

    /** @var PostalAddress|null */
    private $location = null;

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    public function withName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function withLocation(PostalAddress $location): self
    {
        $this->location = $location;
        return $this;
    }

    public function build(): Restaurant
    {
        return ($this->constructor)(
            $this->name,
            $this->location
        );
    }
}
