<?php

namespace Alexa\Model\Services\ListManagement;

abstract class StatusBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $url = null;

    /** @var ListItemState|null */
    private $status = null;

    public function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param string $url
     * @return self
     */
    public function withUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param ListItemState $status
     * @return self
     */
    public function withStatus(ListItemState $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function build(): Status
    {
        return ($this->constructor)(
            $this->url,
            $this->status
        );
    }
}
