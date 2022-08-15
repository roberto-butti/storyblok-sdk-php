<?php

declare(strict_types=1);

namespace StoryblokApi\Client\Endpoint\Params;

/**
 * @author Roberto Butti <roberto.butti@gmail.com>
 */
class StoriesParams
{
    /**
     * @var array<string,string>
     */
    private array $params;

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

    public function findBy(string $findBy): self
    {
        $this->params["find_by"] = $findBy;
        return $this;
    }

    public function versionDraft(): self
    {
        return $this->version("draft");
    }

    public function version(string $version): self
    {
        $this->params["version"] = $version;
        return $this;
    }


    public function searchTerm(string $searchTerm): self
    {
        $this->params["search_term"] = $searchTerm;
        return $this;
    }
}
