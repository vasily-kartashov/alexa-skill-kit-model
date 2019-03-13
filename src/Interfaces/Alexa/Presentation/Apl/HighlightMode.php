<?php

namespace Alexa\Model\Interfaces\Alexa\Presentation\Apl;

use \JsonSerializable;

final class HighlightMode implements JsonSerializable
{
    /** @var string */
    private $value;

    private static function instances(): array
    {
        static $instances;
        if (!$instances) {
            $instances = [
                'block' => new static('block'),
                'line' => new static('line')
            ];
        }
        return $instances;
    }

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function BLOCK(): self
    {
        return static::instances()['block'];
    }

    public static function LINE(): self
    {
        return static::instances()['line'];
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
