<?php

namespace Alexa\Model\Services\Directive;

use JsonSerializable;

final class SpeakDirective extends Directive implements JsonSerializable
{
    const TYPE = 'VoicePlayer.Speak';

    /** @var string|null */
    private $speech = null;

    protected function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE;
    }

    /**
     * @return string|null
     */
    public function speech()
    {
        return $this->speech;
    }

    public static function builder(): SpeakDirectiveBuilder
    {
        $instance = new self;
        return new class($constructor = function ($speech) use ($instance): SpeakDirective {
            $instance->speech = $speech;
            return $instance;
        }) extends SpeakDirectiveBuilder {};
    }

    /**
     * @param string $speech
     * @return self
     */
    public static function ofSpeech(string $speech): SpeakDirective
    {
        $instance = new self;
        $instance->speech = $speech;
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
        $instance->speech = isset($data['speech']) ? ((string) $data['speech']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'speech' => $this->speech
        ]);
    }
}
