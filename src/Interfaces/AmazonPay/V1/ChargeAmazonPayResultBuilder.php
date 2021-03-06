<?php

namespace Alexa\Model\Interfaces\AmazonPay\V1;

use Alexa\Model\Interfaces\AmazonPay\Model\V1\AuthorizationDetails;

abstract class ChargeAmazonPayResultBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $amazonOrderReferenceId = null;

    /** @var AuthorizationDetails|null */
    private $authorizationDetails = null;

    public function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param string $amazonOrderReferenceId
     * @return self
     */
    public function withAmazonOrderReferenceId(string $amazonOrderReferenceId): self
    {
        $this->amazonOrderReferenceId = $amazonOrderReferenceId;
        return $this;
    }

    /**
     * @param AuthorizationDetails $authorizationDetails
     * @return self
     */
    public function withAuthorizationDetails(AuthorizationDetails $authorizationDetails): self
    {
        $this->authorizationDetails = $authorizationDetails;
        return $this;
    }

    public function build(): ChargeAmazonPayResult
    {
        return ($this->constructor)(
            $this->amazonOrderReferenceId,
            $this->authorizationDetails
        );
    }
}
