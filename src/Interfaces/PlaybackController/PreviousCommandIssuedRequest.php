<?php

namespace Alexa\Model\Interfaces\PlaybackController;

use Alexa\Model\Request;
use \JsonSerializable;

final class PreviousCommandIssuedRequest extends Request implements JsonSerializable
{
    const TYPE = 'PlaybackController.PreviousCommandIssued';

    protected function __construct()
    {
        parent::__construct();
    }

    public static function builder(): PreviousCommandIssuedRequestBuilder
    {
        $instance = new self();
        $constructor = function () use ($instance): PreviousCommandIssuedRequest {
            return $instance;
        };
        return new class($constructor) extends PreviousCommandIssuedRequestBuilder
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
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE
        ]);
    }
}