<?php

namespace Alexa\Model\Interfaces\CustomInterfaceController;

use Alexa\Model\Directive;
use JsonSerializable;

final class StopEventHandlerDirective extends Directive implements JsonSerializable
{
    const TYPE = 'CustomInterfaceController.StopEventHandler';

    /** @var string|null */
    private $token = null;

    protected function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE;
    }

    /**
     * @return string|null
     */
    public function token()
    {
        return $this->token;
    }

    public static function builder(): StopEventHandlerDirectiveBuilder
    {
        $instance = new self;
        return new class($constructor = function ($token) use ($instance): StopEventHandlerDirective {
            $instance->token = $token;
            return $instance;
        }) extends StopEventHandlerDirectiveBuilder {};
    }

    /**
     * @param string $token
     * @return self
     */
    public static function ofToken(string $token): StopEventHandlerDirective
    {
        $instance = new self;
        $instance->token = $token;
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
        $instance->token = isset($data['token']) ? ((string) $data['token']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'token' => $this->token
        ]);
    }
}
