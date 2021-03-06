<?php

namespace Alexa\Model\Dialog;

use Alexa\Model\Intent;

abstract class ConfirmIntentDirectiveBuilder
{
    /** @var callable */
    private $constructor;

    /** @var Intent|null */
    private $updatedIntent = null;

    public function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param Intent $updatedIntent
     * @return self
     */
    public function withUpdatedIntent(Intent $updatedIntent): self
    {
        $this->updatedIntent = $updatedIntent;
        return $this;
    }

    public function build(): ConfirmIntentDirective
    {
        return ($this->constructor)(
            $this->updatedIntent
        );
    }
}
