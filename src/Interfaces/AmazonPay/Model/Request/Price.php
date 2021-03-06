<?php

namespace Alexa\Model\Interfaces\AmazonPay\Model\Request;

use JsonSerializable;

final class Price extends BaseAmazonPayEntity implements JsonSerializable
{
    const TYPE = 'Price';

    /** @var string|null */
    private $amount = null;

    /** @var string|null */
    private $currencyCode = null;

    protected function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE;
    }

    /**
     * @return string|null
     */
    public function amount()
    {
        return $this->amount;
    }

    /**
     * @return string|null
     */
    public function currencyCode()
    {
        return $this->currencyCode;
    }

    public static function builder(): PriceBuilder
    {
        $instance = new self;
        return new class($constructor = function ($amount, $currencyCode) use ($instance): Price {
            $instance->amount = $amount;
            $instance->currencyCode = $currencyCode;
            return $instance;
        }) extends PriceBuilder {};
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->type = self::TYPE;
        $instance->amount = isset($data['amount']) ? ((string) $data['amount']) : null;
        $instance->currencyCode = isset($data['currencyCode']) ? ((string) $data['currencyCode']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'amount' => $this->amount,
            'currencyCode' => $this->currencyCode
        ]);
    }
}
