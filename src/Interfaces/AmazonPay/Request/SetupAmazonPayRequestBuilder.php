<?php

namespace Alexa\Model\Interfaces\AmazonPay\Request;

use Alexa\Model\Interfaces\AmazonPay\Model\Request\BillingAgreementAttributes;

abstract class SetupAmazonPayRequestBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $sellerId = null;

    /** @var string|null */
    private $countryOfEstablishment = null;

    /** @var string|null */
    private $ledgerCurrency = null;

    /** @var string|null */
    private $checkoutLanguage = null;

    /** @var BillingAgreementAttributes|null */
    private $billingAgreementAttributes = null;

    /** @var bool|null */
    private $needAmazonShippingAddress = null;

    /** @var bool|null */
    private $sandboxMode = null;

    /** @var string|null */
    private $sandboxCustomerEmailId = null;

    public function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param string $sellerId
     * @return self
     */
    public function withSellerId(string $sellerId): self
    {
        $this->sellerId = $sellerId;
        return $this;
    }

    /**
     * @param string $countryOfEstablishment
     * @return self
     */
    public function withCountryOfEstablishment(string $countryOfEstablishment): self
    {
        $this->countryOfEstablishment = $countryOfEstablishment;
        return $this;
    }

    /**
     * @param string $ledgerCurrency
     * @return self
     */
    public function withLedgerCurrency(string $ledgerCurrency): self
    {
        $this->ledgerCurrency = $ledgerCurrency;
        return $this;
    }

    /**
     * @param string $checkoutLanguage
     * @return self
     */
    public function withCheckoutLanguage(string $checkoutLanguage): self
    {
        $this->checkoutLanguage = $checkoutLanguage;
        return $this;
    }

    /**
     * @param BillingAgreementAttributes $billingAgreementAttributes
     * @return self
     */
    public function withBillingAgreementAttributes(BillingAgreementAttributes $billingAgreementAttributes): self
    {
        $this->billingAgreementAttributes = $billingAgreementAttributes;
        return $this;
    }

    /**
     * @param bool $needAmazonShippingAddress
     * @return self
     */
    public function withNeedAmazonShippingAddress(bool $needAmazonShippingAddress): self
    {
        $this->needAmazonShippingAddress = $needAmazonShippingAddress;
        return $this;
    }

    /**
     * @param bool $sandboxMode
     * @return self
     */
    public function withSandboxMode(bool $sandboxMode): self
    {
        $this->sandboxMode = $sandboxMode;
        return $this;
    }

    /**
     * @param string $sandboxCustomerEmailId
     * @return self
     */
    public function withSandboxCustomerEmailId(string $sandboxCustomerEmailId): self
    {
        $this->sandboxCustomerEmailId = $sandboxCustomerEmailId;
        return $this;
    }

    public function build(): SetupAmazonPayRequest
    {
        return ($this->constructor)(
            $this->sellerId,
            $this->countryOfEstablishment,
            $this->ledgerCurrency,
            $this->checkoutLanguage,
            $this->billingAgreementAttributes,
            $this->needAmazonShippingAddress,
            $this->sandboxMode,
            $this->sandboxCustomerEmailId
        );
    }
}
