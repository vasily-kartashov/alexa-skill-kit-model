<?php

namespace Alexa\Model\ER\Dynamic;

use JsonSerializable;

final class Entity implements JsonSerializable
{
    /** @var string|null */
    private $id = null;

    /** @var EntityValueAndSynonyms|null */
    private $name = null;

    protected function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return EntityValueAndSynonyms|null
     */
    public function name()
    {
        return $this->name;
    }

    public static function builder(): EntityBuilder
    {
        $instance = new self;
        return new class($constructor = function ($id, $name) use ($instance): Entity {
            $instance->id = $id;
            $instance->name = $name;
            return $instance;
        }) extends EntityBuilder {};
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->id = isset($data['id']) ? ((string) $data['id']) : null;
        $instance->name = isset($data['name']) ? EntityValueAndSynonyms::fromValue($data['name']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'id' => $this->id,
            'name' => $this->name
        ]);
    }
}
