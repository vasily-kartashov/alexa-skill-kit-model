<?php

namespace Alexa\Model\Services\Monetization;

use JsonSerializable;

final class Metadata implements JsonSerializable
{
    /** @var ResultSet|null */
    private $resultSet = null;

    protected function __construct()
    {
    }

    /**
     * @return ResultSet|null
     */
    public function resultSet()
    {
        return $this->resultSet;
    }

    public static function builder(): MetadataBuilder
    {
        $instance = new self;
        return new class($constructor = function ($resultSet) use ($instance): Metadata {
            $instance->resultSet = $resultSet;
            return $instance;
        }) extends MetadataBuilder {};
    }

    /**
     * @param ResultSet $resultSet
     * @return self
     */
    public static function ofResultSet(ResultSet $resultSet): Metadata
    {
        $instance = new self;
        $instance->resultSet = $resultSet;
        return $instance;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self;
        $instance->resultSet = isset($data['resultSet']) ? ResultSet::fromValue($data['resultSet']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'resultSet' => $this->resultSet
        ]);
    }
}
