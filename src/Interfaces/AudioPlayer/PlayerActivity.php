<?php

namespace Alexa\Model\Interfaces\AudioPlayer;

use \JsonSerializable;
use \RuntimeException;

final class PlayerActivity implements JsonSerializable
{
    /** @var string */
    private $value;

    private static function instances(): array
    {
        static $instances;
        if (!$instances) {
            $instances = [
                'PLAYING' => new static('PLAYING'),
                'PAUSED' => new static('PAUSED'),
                'FINISHED' => new static('FINISHED'),
                'BUFFER_UNDERRUN' => new static('BUFFER_UNDERRUN'),
                'IDLE' => new static('IDLE'),
                'STOPPED' => new static('STOPPED')
            ];
        }
        return $instances;
    }

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function PLAYING(): self
    {
        return static::instances()['PLAYING'];
    }

    public static function PAUSED(): self
    {
        return static::instances()['PAUSED'];
    }

    public static function FINISHED(): self
    {
        return static::instances()['FINISHED'];
    }

    public static function BUFFER_UNDERRUN(): self
    {
        return static::instances()['BUFFER_UNDERRUN'];
    }

    public static function IDLE(): self
    {
        return static::instances()['IDLE'];
    }

    public static function STOPPED(): self
    {
        return static::instances()['STOPPED'];
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