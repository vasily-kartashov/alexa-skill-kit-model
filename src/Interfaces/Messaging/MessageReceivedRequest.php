<?php

namespace Alexa\Model\Interfaces\Messaging;

use Alexa\Model\Request;
use JsonSerializable;

final class MessageReceivedRequest extends Request implements JsonSerializable
{
    const TYPE = 'Messaging.MessageReceived';

    /** @var array */
    private $message = [];

    protected function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE;
    }

    /**
     * @return array
     */
    public function message()
    {
        return $this->message;
    }

    public static function builder(): MessageReceivedRequestBuilder
    {
        $instance = new self;
        return new class($constructor = function ($message) use ($instance): MessageReceivedRequest {
            $instance->message = $message;
            return $instance;
        }) extends MessageReceivedRequestBuilder {};
    }

    /**
     * @param array $message
     * @return self
     */
    public static function ofMessage(array $message): MessageReceivedRequest
    {
        $instance = new self;
        $instance->message = $message;
        return $instance;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->type = self::TYPE;
        $instance->message = [];
        if (isset($data['message'])) {
            foreach ($data['message'] as $item) {
                $element = $item;
                if ($element !== null) {
                    $instance->message[] = $element;
                }
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
