<?php

declare(strict_types=1);

namespace StoryblokApi\Client\Endpoint\Params;

/**
 * @author Roberto Butti <roberto.butti@gmail.com>
 */
abstract class BaseParams
{
    /**
     * @var array<string,string>
     */
    protected array $params;

    public function __construct()
    {
        $this->params = [];
    }


    public function getQueryString(): string
    {
        $path = "";
        if (count($this->params) > 0) {
            $path .= '?'.http_build_query($this->params, '', '&', PHP_QUERY_RFC3986);
        }
        return $path;
    }

    public function addParams(string $key, mixed $value): self
    {
        $this->params[$key] = $value;
        return $this;
    }

    public function versionDraft(): self
    {
        return $this->version("draft");
    }

    public function version(string $version): self
    {
        return $this->addParams("version", $version);
    }
}
