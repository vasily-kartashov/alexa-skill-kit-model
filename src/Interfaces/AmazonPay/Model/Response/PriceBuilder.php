<?php

namespace Alexa\Model\Interfaces\AmazonPay\Model\Response;

abstract class PriceBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $amount = null;

    /** @var string|null */
    private $currencyCode = null;

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param mixed $amount
     * @return self
     */
    public function withAmount(string $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param mixed $currencyCode
     * @return self
     */
    public function withCurrencyCode(string $currencyCode): self
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

    public function build(): Price
    {
        return ($this->constructor)(
            $this->amount,
            $this->currencyCode
        );
    }
}