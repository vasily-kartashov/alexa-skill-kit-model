<?php

namespace Alexa\Model\Interfaces\Alexa\Presentation\Apl;

use Alexa\Model\Directive;
use \JsonSerializable;

final class RenderDocumentDirective extends Directive implements JsonSerializable
{
    const TYPE = 'Alexa.Presentation.APL.RenderDocument';

    /** @var string|null */
    private $token = null;

    /** @var array */
    private $document = [];

    /** @var array */
    private $datasources = [];

    /** @var array */
    private $packages = [];

    protected function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE;
    }

    /**
     * @return string|null
     */
    public function token()
    {
        return $this->token;
    }

    /**
     * @return array
     */
    public function document()
    {
        return $this->document;
    }

    /**
     * @return array
     */
    public function datasources()
    {
        return $this->datasources;
    }

    /**
     * @return array
     */
    public function packages()
    {
        return $this->packages;
    }

    public static function builder(): RenderDocumentDirectiveBuilder
    {
        $instance = new self();
        $constructor = function ($token, $document, $datasources, $packages) use ($instance): RenderDocumentDirective {
            $instance->token = $token;
            $instance->document = $document;
            $instance->datasources = $datasources;
            $instance->packages = $packages;
            return $instance;
        };
        return new class($constructor) extends RenderDocumentDirectiveBuilder
        {
            public function __construct(callable $constructor)
            {
                parent::__construct($constructor);
            }
        };
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromValue(array $data)
    {
        $instance = new self();
        $instance->type = self::TYPE;
        $instance->token = isset($data['token']) ? ((string) $data['token']) : null;
        $instance->document = [];
        foreach ($data['document'] as $item) {
            $element = $item;
            if ($element !== null) {
                $instance->document[] = $element;
            }
        }
        $instance->datasources = [];
        foreach ($data['datasources'] as $item) {
            $element = $item;
            if ($element !== null) {
                $instance->datasources[] = $element;
            }
        }
        $instance->packages = [];
        foreach ($data['packages'] as $item) {
            $element = $item;
            if ($element !== null) {
                $instance->packages[] = $element;
            }
        }
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'token' => $this->token,
            'document' => $this->document,
            'datasources' => $this->datasources,
            'packages' => $this->packages
        ]);
    }
}