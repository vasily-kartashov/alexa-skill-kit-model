<?php

namespace Alexa\Model\Services\UPS;

use JsonSerializable;

final class PhoneNumber implements JsonSerializable
{
    /** @var string|null */
    private $countryCode = null;

    /** @var string|null */
    private $phoneNumber = null;

    protected function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function countryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return string|null
     */
    public function phoneNumber()
    {
        return $this->phoneNumber;
    }

    public static function builder(): PhoneNumberBuilder
    {
        $instance = new self;
        return new class($constructor = function ($countryCode, $phoneNumber) use ($instance): PhoneNumber {
            $instance->countryCode = $countryCode;
            $instance->phoneNumber = $phoneNumber;
            return $instance;
        }) extends PhoneNumberBuilder {};
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->countryCode = isset($data['countryCode']) ? ((string) $data['countryCode']) : null;
        $instance->phoneNumber = isset($data['phoneNumber']) ? ((string) $data['phoneNumber']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'countryCode' => $this->countryCode,
            'phoneNumber' => $this->phoneNumber
        ]);
    }
}
