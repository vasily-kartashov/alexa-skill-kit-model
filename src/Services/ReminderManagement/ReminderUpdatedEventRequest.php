<?php

namespace Alexa\Model\Services\ReminderManagement;

use Alexa\Model\Request;
use JsonSerializable;

final class ReminderUpdatedEventRequest extends Request implements JsonSerializable
{
    const TYPE = 'Reminders.ReminderUpdated';

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

    public static function builder(): ReminderUpdatedEventRequestBuilder
    {
        $instance = new self;
        return new class($constructor = function ($body) use ($instance): ReminderUpdatedEventRequest {
            $instance->body = $body;
            return $instance;
        }) extends ReminderUpdatedEventRequestBuilder {};
    }

    /**
     * @param Event $body
     * @return self
     */
    public static function ofBody(Event $body): ReminderUpdatedEventRequest
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
