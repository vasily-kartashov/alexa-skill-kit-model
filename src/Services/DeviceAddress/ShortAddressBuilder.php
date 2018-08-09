<?php

namespace Alexa\Model\Services\DeviceAddress;

abstract class ShortAddressBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $countryCode = null;

    /** @var string|null */
    private $postalCode = null;

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    public function withCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function withPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function build(): ShortAddress
    {
        return ($this->constructor)(
            $this->countryCode,
            $this->postalCode
        );
    }
}