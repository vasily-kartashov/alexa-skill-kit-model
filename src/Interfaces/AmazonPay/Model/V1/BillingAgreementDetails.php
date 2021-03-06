<?php

namespace Alexa\Model\Interfaces\AmazonPay\Model\V1;

use JsonSerializable;
use \DateTime;

final class BillingAgreementDetails implements JsonSerializable
{
    /** @var string|null */
    private $billingAgreementId = null;

    /** @var DateTime|null */
    private $creationTimestamp = null;

    /** @var Destination|null */
    private $destination = null;

    /** @var string|null */
    private $checkoutLanguage = null;

    /** @var ReleaseEnvironment|null */
    private $releaseEnvironment = null;

    /** @var BillingAgreementStatus|null */
    private $billingAgreementStatus = null;

    protected function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function billingAgreementId()
    {
        return $this->billingAgreementId;
    }

    /**
     * @return DateTime|null
     */
    public function creationTimestamp()
    {
        return $this->creationTimestamp;
    }

    /**
     * @return Destination|null
     */
    public function destination()
    {
        return $this->destination;
    }

    /**
     * @return string|null
     */
    public function checkoutLanguage()
    {
        return $this->checkoutLanguage;
    }

    /**
     * @return ReleaseEnvironment|null
     */
    public function releaseEnvironment()
    {
        return $this->releaseEnvironment;
    }

    /**
     * @return BillingAgreementStatus|null
     */
    public function billingAgreementStatus()
    {
        return $this->billingAgreementStatus;
    }

    public static function builder(): BillingAgreementDetailsBuilder
    {
        $instance = new self;
        return new class($constructor = function ($billingAgreementId, $creationTimestamp, $destination, $checkoutLanguage, $releaseEnvironment, $billingAgreementStatus) use ($instance): BillingAgreementDetails {
            $instance->billingAgreementId = $billingAgreementId;
            $instance->creationTimestamp = $creationTimestamp;
            $instance->destination = $destination;
            $instance->checkoutLanguage = $checkoutLanguage;
            $instance->releaseEnvironment = $releaseEnvironment;
            $instance->billingAgreementStatus = $billingAgreementStatus;
            return $instance;
        }) extends BillingAgreementDetailsBuilder {};
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->billingAgreementId = isset($data['billingAgreementId']) ? ((string) $data['billingAgreementId']) : null;
        $instance->creationTimestamp = isset($data['creationTimestamp']) ? new DateTime($data['creationTimestamp']) : null;
        $instance->destination = isset($data['destination']) ? Destination::fromValue($data['destination']) : null;
        $instance->checkoutLanguage = isset($data['checkoutLanguage']) ? ((string) $data['checkoutLanguage']) : null;
        $instance->releaseEnvironment = isset($data['releaseEnvironment']) ? ReleaseEnvironment::fromValue($data['releaseEnvironment']) : null;
        $instance->billingAgreementStatus = isset($data['billingAgreementStatus']) ? BillingAgreementStatus::fromValue($data['billingAgreementStatus']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'billingAgreementId' => $this->billingAgreementId,
            'creationTimestamp' => $this->creationTimestamp,
            'destination' => $this->destination,
            'checkoutLanguage' => $this->checkoutLanguage,
            'releaseEnvironment' => $this->releaseEnvironment,
            'billingAgreementStatus' => $this->billingAgreementStatus
        ]);
    }
}
