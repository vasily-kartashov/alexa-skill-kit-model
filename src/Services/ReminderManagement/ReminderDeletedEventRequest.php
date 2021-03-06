<?php

namespace Alexa\Model\Services\ReminderManagement;

use Alexa\Model\Request;
use JsonSerializable;

final class ReminderDeletedEventRequest extends Request implements JsonSerializable
{
    const TYPE = 'Reminders.ReminderDeleted';

    /** @var ReminderDeletedEvent|null */
    private $body = null;

    protected function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE;
    }

    /**
     * @return ReminderDeletedEvent|null
     */
    public function body()
    {
        return $this->body;
    }

    public static function builder(): ReminderDeletedEventRequestBuilder
    {
        $instance = new self;
        return new class($constructor = function ($body) use ($instance): ReminderDeletedEventRequest {
            $instance->body = $body;
            return $instance;
        }) extends ReminderDeletedEventRequestBuilder {};
    }

    /**
     * @param ReminderDeletedEvent $body
     * @return self
     */
    public static function ofBody(ReminderDeletedEvent $body): ReminderDeletedEventRequest
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
        $instance->body = isset($data['body']) ? ReminderDeletedEvent::fromValue($data['body']) : null;
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
