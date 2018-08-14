<?php

namespace Alexa\Model\Interfaces\AmazonPay\Model\V1;

use \JsonSerializable;

final class BillingAgreementAttributes implements JsonSerializable
{
    /** @var string|null */
    private $platformId = null;

    /** @var string|null */
    private $sellerNote = null;

    /** @var SellerBillingAgreementAttributes|null */
    private $sellerBillingAgreementAttributes = null;

    protected function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function platformId()
    {
        return $this->platformId;
    }

    /**
     * @return string|null
     */
    public function sellerNote()
    {
        return $this->sellerNote;
    }

    /**
     * @return SellerBillingAgreementAttributes|null
     */
    public function sellerBillingAgreementAttributes()
    {
        return $this->sellerBillingAgreementAttributes;
    }

    public static function builder(): BillingAgreementAttributesBuilder
    {
        $instance = new self();
        $constructor = function ($platformId, $sellerNote, $sellerBillingAgreementAttributes) use ($instance): BillingAgreementAttributes {
            $instance->platformId = $platformId;
            $instance->sellerNote = $sellerNote;
            $instance->sellerBillingAgreementAttributes = $sellerBillingAgreementAttributes;
            return $instance;
        };
        return new class($constructor) extends BillingAgreementAttributesBuilder
        {
            public function __construct(callable $constructor)
            {
                parent::__construct($constructor);
            }
        };
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self();
        $instance->platformId = isset($data['platformId']) ? ((string) $data['platformId']) : null;
        $instance->sellerNote = isset($data['sellerNote']) ? ((string) $data['sellerNote']) : null;
        $instance->sellerBillingAgreementAttributes = isset($data['sellerBillingAgreementAttributes']) ? SellerBillingAgreementAttributes::fromValue($data['sellerBillingAgreementAttributes']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'platformId' => $this->platformId,
            'sellerNote' => $this->sellerNote,
            'sellerBillingAgreementAttributes' => $this->sellerBillingAgreementAttributes
        ]);
    }
}
