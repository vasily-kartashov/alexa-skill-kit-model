<?php

namespace Alexa\Model\Services\ReminderManagement;

use Alexa\Model\Request;
use JsonSerializable;

final class ReminderStartedEventRequest extends Request implements JsonSerializable
{
    const TYPE = 'Reminders.ReminderStarted';

    /** @var Event|null */
    private $body = null;

    protected function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE;
    }

    /**
     * @return Event|null
     */
    public function body()
    {
        return $this->body;
    }

    public static function builder(): ReminderStartedEventRequestBuilder
    {
        $instance = new self;
        return new class($constructor = function ($body) use ($instance): ReminderStartedEventRequest {
            $instance->body = $body;
            return $instance;
        }) extends ReminderStartedEventRequestBuilder {};
    }

    /**
     * @param Event $body
     * @return self
     */
    public static function ofBody(Event $body): ReminderStartedEventRequest
    {
        $instance = new self;
        $instance->body = $body;
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
        $instance->body = isset($data['body']) ? Event::fromValue($data['body']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'body' => $this->body
        ]);
    }
}
