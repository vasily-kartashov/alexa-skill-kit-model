<?php

namespace Alexa\Model;

use Alexa\Model\Dialog\ConfirmIntentDirective;
use Alexa\Model\Dialog\ConfirmSlotDirective;
use Alexa\Model\Dialog\DelegateDirective;
use Alexa\Model\Dialog\ElicitSlotDirective;
use Alexa\Model\Interfaces\Alexa\Presentation\Apl\ExecuteCommandsDirective;
use Alexa\Model\Interfaces\Alexa\Presentation\Apl\RenderDocumentDirective;
use Alexa\Model\Interfaces\AudioPlayer\ClearQueueDirective;
use Alexa\Model\Interfaces\AudioPlayer\PlayDirective;
use Alexa\Model\Interfaces\AudioPlayer\StopDirective;
use Alexa\Model\Interfaces\Connections\SendRequestDirective;
use Alexa\Model\Interfaces\Connections\SendResponseDirective;
use Alexa\Model\Interfaces\Display\HintDirective;
use Alexa\Model\Interfaces\Display\RenderTemplateDirective;
use Alexa\Model\Interfaces\GadgetController\SetLightDirective;
use Alexa\Model\Interfaces\GameEngine\StartInputHandlerDirective;
use Alexa\Model\Interfaces\GameEngine\StopInputHandlerDirective;
use Alexa\Model\Interfaces\VideoApp\LaunchDirective;
use \JsonSerializable;

abstract class Directive implements JsonSerializable
{
    /** @var string|null */
    protected $type = null;

    protected function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @param array $data
     * @return self|null
     */
    public static function fromValue(array $data)
    {
        if (!isset($data['type'])) {
            return null;
        }
        switch ($data['type']) {
            case StopDirective::TYPE:
                return StopDirective::fromValue($data);
            case ConfirmSlotDirective::TYPE:
                return ConfirmSlotDirective::fromValue($data);
            case PlayDirective::TYPE:
                return PlayDirective::fromValue($data);
            case ExecuteCommandsDirective::TYPE:
                return ExecuteCommandsDirective::fromValue($data);
            case SendRequestDirective::TYPE:
                return SendRequestDirective::fromValue($data);
            case RenderTemplateDirective::TYPE:
                return RenderTemplateDirective::fromValue($data);
            case SetLightDirective::TYPE:
                return SetLightDirective::fromValue($data);
            case DelegateDirective::TYPE:
                return DelegateDirective::fromValue($data);
            case HintDirective::TYPE:
                return HintDirective::fromValue($data);
            case ConfirmIntentDirective::TYPE:
                return ConfirmIntentDirective::fromValue($data);
            case StartInputHandlerDirective::TYPE:
                return StartInputHandlerDirective::fromValue($data);
            case LaunchDirective::TYPE:
                return LaunchDirective::fromValue($data);
            case StopInputHandlerDirective::TYPE:
                return StopInputHandlerDirective::fromValue($data);
            case RenderDocumentDirective::TYPE:
                return RenderDocumentDirective::fromValue($data);
            case SendResponseDirective::TYPE:
                return SendResponseDirective::fromValue($data);
            case ElicitSlotDirective::TYPE:
                return ElicitSlotDirective::fromValue($data);
            case ClearQueueDirective::TYPE:
                return ClearQueueDirective::fromValue($data);
            default:
                return null;
        }
    }
}
