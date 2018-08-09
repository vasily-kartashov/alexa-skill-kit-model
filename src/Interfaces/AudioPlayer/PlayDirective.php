<?php

namespace Alexa\Model\Interfaces\AudioPlayer;

use Alexa\Model\Directive;
use \JsonSerializable;

final class PlayDirective extends Directive implements JsonSerializable
{
    const TYPE = 'AudioPlayer.Play';

    /** @var PlayBehavior|null */
    private $playBehavior = null;

    /** @var AudioItem|null */
    private $audioItem = null;

    protected function __construct()
    {
        parent::__construct();
    }

    /**
     * @return PlayBehavior|null
     */
    public function playBehavior()
    {
        return $this->playBehavior;
    }

    /**
     * @return AudioItem|null
     */
    public function audioItem()
    {
        return $this->audioItem;
    }

    public static function builder(): PlayDirectiveBuilder
    {
        $instance = new self();
        $constructor = function ($playBehavior, $audioItem) use ($instance): PlayDirective {
            $instance->playBehavior = $playBehavior;
            $instance->audioItem = $audioItem;
            return $instance;
        };
        return new class($constructor) extends PlayDirectiveBuilder
        {
            public function __construct(callable $constructor)
            {
                parent::__construct($constructor);
            }
        };
    }

    public static function fromValue(array $data)
    {
        $instance = new self();
        $instance->type = self::TYPE;
        $instance->playBehavior = isset($data['playBehavior']) ? PlayBehavior::fromValue($data['playBehavior']) : null;
        $instance->audioItem = isset($data['audioItem']) ? AudioItem::fromValue($data['audioItem']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'playBehavior' => $this->playBehavior,
            'audioItem' => $this->audioItem
        ]);
    }
}
