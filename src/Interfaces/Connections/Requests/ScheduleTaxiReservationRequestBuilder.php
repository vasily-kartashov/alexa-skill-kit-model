<?php

namespace Alexa\Model\Interfaces\Connections\Requests;

use Alexa\Model\Interfaces\Connections\Entities\PostalAddress;

abstract class ScheduleTaxiReservationRequestBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $pickupTime = null;

    /** @var string|null */
    private $partySize = null;

    /** @var PostalAddress|null */
    private $pickupLocation = null;

    /** @var PostalAddress|null */
    private $dropOffLocation = null;

    public function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param string $pickupTime
     * @return self
     */
    public function withPickupTime(string $pickupTime): self
    {
        $this->pickupTime = $pickupTime;
        return $this;
    }

    /**
     * @param string $partySize
     * @return self
     */
    public function withPartySize(string $partySize): self
    {
        $this->partySize = $partySize;
        return $this;
    }

    /**
     * @param PostalAddress $pickupLocation
     * @return self
     */
    public function withPickupLocation(PostalAddress $pickupLocation): self
    {
        $this->pickupLocation = $pickupLocation;
        return $this;
    }

    /**
     * @param PostalAddress $dropOffLocation
     * @return self
     */
    public function withDropOffLocation(PostalAddress $dropOffLocation): self
    {
        $this->dropOffLocation = $dropOffLocation;
        return $this;
    }

    public function build(): ScheduleTaxiReservationRequest
    {
        return ($this->constructor)(
            $this->pickupTime,
            $this->partySize,
            $this->pickupLocation,
            $this->dropOffLocation
        );
    }
}
