<?php

namespace Alexa\Model\UI;

use JsonSerializable;

final class PlainTextOutputSpeech extends OutputSpeech implements JsonSerializable
{
    const TYPE = 'PlainText';

    /** @var string|null */
    private $text = null;

    protected function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE;
    }

    /**
     * @return string|null
     */
    public function text()
    {
        return $this->text;
    }

    public static function builder(): PlainTextOutputSpeechBuilder
    {
        $instance = new self;
        return new class($constructor = function ($text) use ($instance): PlainTextOutputSpeech {
            $instance->text = $text;
            return $instance;
        }) extends PlainTextOutputSpeechBuilder {};
    }

    /**
     * @param string $text
     * @return self
     */
    public static function ofText(string $text): PlainTextOutputSpeech
    {
        $instance = new self;
        $instance->text = $text;
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
        $instance->text = isset($data['text']) ? ((string) $data['text']) : null;
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'text' => $this->text
        ]);
    }
}
