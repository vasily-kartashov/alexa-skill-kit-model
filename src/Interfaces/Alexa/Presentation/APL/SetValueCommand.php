<?php

namespace Alexa\Model\Interfaces\Alexa\Presentation\APL;

use JsonSerializable;

final class SetValueCommand extends Command implements JsonSerializable
{
    const TYPE = 'SetValue';

    /** @var string|null */
    private $componentId = null;

    /** @var string|null */
    private $property = null;

    /** @var string|null */
    private $value = null;

    protected function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE;
    }

    /**
     * @return string|null
     */
    public function componentId()
    {
        return $this->componentId;
    }

    /**
     * @return string|null
     */
    public function property()
    {
        return $this->property;
    }

    /**
     * @return string|null
     */
    public function value()
    {
        return $this->value;
    }

    public static function builder(): SetValueCommandBuilder
    {
        $instance = new self;
        return new class($constructor = function ($componentId, $property, $value) use ($instance): SetValueCommand {
            $instance->componentId = $componentId;
            $instance->property = $property;
            $instance->value = $value;
            return $instance;
        }) extends SetValueCommandBuilder {};
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->type = self::TYPE;
        $instance->componentId = isset($data['componentId']) ? ((string) $data['componentId']) : null;
        $instance->property = isset($data['property']) ? ((string) $data['property']) : null;
        $instance->value = isset($data['value']) ? ((string) $data['value']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'componentId' => $this->componentId,
            'property' => $this->property,
            'value' => $this->value
        ]);
    }
}
