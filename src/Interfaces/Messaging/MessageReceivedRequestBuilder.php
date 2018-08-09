<?php

namespace Alexa\Model\Interfaces\Messaging;

use Alexa\Model\Request;

abstract class MessageReceivedRequestBuilder
{
    /** @var callable */
    private $constructor;

    /** @var null[] */
    private $message = [];

    protected function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param null[] $message
     * @return self
     */
    public function withMessage(array $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function build(): MessageReceivedRequest
    {
        return ($this->constructor)(
            $this->message
        );
    }
}
