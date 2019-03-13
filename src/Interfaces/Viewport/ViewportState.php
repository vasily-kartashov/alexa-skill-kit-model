<?php

namespace Alexa\Model\Interfaces\Viewport;

use \JsonSerializable;

final class ViewportState implements JsonSerializable
{
    /** @var Experience[] */
    private $experiences = [];

    /** @var Shape|null */
    private $shape = null;

    /** @var mixed|null */
    private $pixelWidth = null;

    /** @var mixed|null */
    private $pixelHeight = null;

    /** @var mixed|null */
    private $dpi = null;

    /** @var mixed|null */
    private $currentPixelWidth = null;

    /** @var mixed|null */
    private $currentPixelHeight = null;

    /** @var Touch[] */
    private $touch = [];

    /** @var Keyboard[] */
    private $keyboard = [];

    protected function __construct()
    {
    }

    /**
     * @return Experience[]
     */
    public function experiences()
    {
        return $this->experiences;
    }

    /**
     * @return Shape|null
     */
    public function shape()
    {
        return $this->shape;
    }

    /**
     * @return mixed|null
     */
    public function pixelWidth()
    {
        return $this->pixelWidth;
    }

    /**
     * @return mixed|null
     */
    public function pixelHeight()
    {
        return $this->pixelHeight;
    }

    /**
     * @return mixed|null
     */
    public function dpi()
    {
        return $this->dpi;
    }

    /**
     * @return mixed|null
     */
    public function currentPixelWidth()
    {
        return $this->currentPixelWidth;
    }

    /**
     * @return mixed|null
     */
    public function currentPixelHeight()
    {
        return $this->currentPixelHeight;
    }

    /**
     * @return Touch[]
     */
    public function touch()
    {
        return $this->touch;
    }

    /**
     * @return Keyboard[]
     */
    public function keyboard()
    {
        return $this->keyboard;
    }

    public static function builder(): ViewportStateBuilder
    {
        $instance = new self();
        $constructor = function ($experiences, $shape, $pixelWidth, $pixelHeight, $dpi, $currentPixelWidth, $currentPixelHeight, $touch, $keyboard) use ($instance): ViewportState {
            $instance->experiences = $experiences;
            $instance->shape = $shape;
            $instance->pixelWidth = $pixelWidth;
            $instance->pixelHeight = $pixelHeight;
            $instance->dpi = $dpi;
            $instance->currentPixelWidth = $currentPixelWidth;
            $instance->currentPixelHeight = $currentPixelHeight;
            $instance->touch = $touch;
            $instance->keyboard = $keyboard;
            return $instance;
        };
        return new class($constructor) extends ViewportStateBuilder
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
        $instance->experiences = [];
        foreach ($data['experiences'] as $item) {
            $element = isset($item) ? Experience::fromValue($item) : null;
            if ($element !== null) {
                $instance->experiences[] = $element;
            }
        }
        $instance->shape = isset($data['shape']) ? Shape::fromValue($data['shape']) : null;
        $instance->pixelWidth = $data['pixelWidth'];
        $instance->pixelHeight = $data['pixelHeight'];
        $instance->dpi = $data['dpi'];
        $instance->currentPixelWidth = $data['currentPixelWidth'];
        $instance->currentPixelHeight = $data['currentPixelHeight'];
        $instance->touch = [];
        foreach ($data['touch'] as $item) {
            $element = isset($item) ? Touch::fromValue($item) : null;
            if ($element !== null) {
                $instance->touch[] = $element;
            }
        }
        $instance->keyboard = [];
        foreach ($data['keyboard'] as $item) {
            $element = isset($item) ? Keyboard::fromValue($item) : null;
            if ($element !== null) {
                $instance->keyboard[] = $element;
            }
        }
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'experiences' => $this->experiences,
            'shape' => $this->shape,
            'pixelWidth' => $this->pixelWidth,
            'pixelHeight' => $this->pixelHeight,
            'dpi' => $this->dpi,
            'currentPixelWidth' => $this->currentPixelWidth,
            'currentPixelHeight' => $this->currentPixelHeight,
            'touch' => $this->touch,
            'keyboard' => $this->keyboard
        ]);
    }
}
