<?php

namespace Alexa\Model\UI;

use \JsonSerializable;

final class AskForPermissionsConsentCard extends Card implements JsonSerializable
{
    const TYPE = 'AskForPermissionsConsent';

    /** @var string[] */
    private $permissions = [];

    protected function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string[]
     */
    public function permissions()
    {
        return $this->permissions;
    }

    public static function builder(): AskForPermissionsConsentCardBuilder
    {
        $instance = new self();
        $constructor = function ($permissions) use ($instance): AskForPermissionsConsentCard {
            $instance->permissions = $permissions;
            return $instance;
        };
        return new class($constructor) extends AskForPermissionsConsentCardBuilder
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
        $instance->permissions = [];
        foreach ($data['permissions'] as $item) {
            $element = isset($item) ? ((string) $item) : null;
            if ($element) {
                $instance->permissions[] = $element;
            }
        }
        return $instance;
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => self::TYPE,
            'permissions' => $this->permissions
        ]);
    }
}