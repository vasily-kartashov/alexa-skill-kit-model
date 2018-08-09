<?php

namespace Alexa\Model\Interfaces\Messaging;

use Alexa\Model\Request;
use \JsonSerializable;

final class MessageReceivedRequest extends Request implements JsonSerializable
{
    const TYPE = 'Messaging.MessageReceived';

    /** @var null[] */
    private $message = [];

    protected function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null[]
     */
    public function message()
    {
        return $this->message;
    }

    public static function builder(): MessageReceivedRequestBuilder
    {
        $instance = new self();
        $constructor = function ($message) use ($instance): MessageReceivedRequest {
            $instance->message = $message;
            return $instance;
        };
        return new class($constructor) extends MessageReceivedRequestBuilder
        {
            public function __construct(callable $constructor)
            {
                parent::__construct($constructor);
            }
        };
    }

    public static function fromValue(array $data)
    {
        $instance = new self();
        $instance->type = self::TYPE;
        $instance->message = [];
        foreach ($data['message'] as $item) {
            $element = $item;
            if ($element) {
                $instance->message[] = $element;
            }
        }
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'message' => $this->message
        ]);
    }
}