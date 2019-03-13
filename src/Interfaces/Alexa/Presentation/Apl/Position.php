<?php

namespace Alexa\Model\Interfaces\Alexa\Presentation\Apl;

use \JsonSerializable;

final class Position implements JsonSerializable
{
    /** @var string */
    private $value;

    private static function instances(): array
    {
        static $instances;
        if (!$instances) {
            $instances = [
                'absolute' => new static('absolute'),
                'relative' => new static('relative')
            ];
        }
        return $instances;
    }

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function ABSOLUTE(): self
    {
        return static::instances()['absolute'];
    }

    public static function RELATIVE(): self
    {
        return static::instances()['relative'];
    }

    /**
     * @param string $text
     * @return self|null
     */
    public static function fromValue(string $text)
    {
        return static::instances()[$text] ?? null;
    }

    /**
     * @return self[]
     */
    public static function values()
    {
        return static::instances();
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}