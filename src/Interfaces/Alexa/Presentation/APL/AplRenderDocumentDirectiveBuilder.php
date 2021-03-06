<?php

namespace Alexa\Model\Interfaces\Alexa\Presentation\APL;

abstract class AplRenderDocumentDirectiveBuilder
{
    /** @var callable */
    private $constructor;

    /** @var string|null */
    private $token = null;

    /** @var array */
    private $document = [];

    /** @var array */
    private $datasources = [];

    /** @var array */
    private $packages = [];

    public function __construct(callable $constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @param string $token
     * @return self
     */
    public function withToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param array $document
     * @return self
     */
    public function withDocument(array $document): self
    {
        $this->document = $document;
        return $this;
    }

    /**
     * @param array $datasources
     * @return self
     */
    public function withDatasources(array $datasources): self
    {
        $this->datasources = $datasources;
        return $this;
    }

    /**
     * @param array $packages
     * @return self
     */
    public function withPackages(array $packages): self
    {
        $this->packages = $packages;
        return $this;
    }

    public function build(): AplRenderDocumentDirective
    {
        return ($this->constructor)(
            $this->token,
            $this->document,
            $this->datasources,
            $this->packages
        );
    }
}
