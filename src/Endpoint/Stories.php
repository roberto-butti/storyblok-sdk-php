<?php

declare(strict_types=1);

namespace StoryblokApi\Client\Endpoint;

use StoryblokApi\Client\ContentDeliverySdk;
use StoryblokApi\Client\Endpoint\Params\Sort;
use StoryblokApi\Client\Endpoint\Params\SortAttribute;
use StoryblokApi\Client\Endpoint\Params\StoriesParams;

final class Stories extends AbstractApi
{
    protected StoriesParams $params;
    protected Sort $sorts;

    public function __construct(ContentDeliverySdk $sdk)
    {
        $this->sdk = $sdk;
        $this->params = new StoriesParams();
        $this->sorts = new Sort();
    }

    public function language(string $language): self
    {
        $this->params->language($language);
        return $this;
    }

    public function searchTerm(string $term): self
    {
        $this->params->searchTerm($term);
        return $this;
    }


    public function draft(): self
    {
        $this->params->versionDraft();
        return $this;
    }
    /**
     * @return array<mixed>
     */
    public function all(): array
    {
        return $this->getContent('/stories');
    }

    /**
     * @param StoriesParams $params
     * @return array<mixed>
     */
    public function get(StoriesParams|null $params = null): array
    {
        $path= $this->params->merge($params)->getQueryString();
        $sorting = $this->sorts->getQueryString();
        if ($sorting != "") {
            $path = $path . (($path == "") ? "?" : "&") .
                "sort_by=" . $this->sorts->getQueryString();
        }
        echo PHP_EOL. $path . PHP_EOL;
        return $this->getContent('/stories' . $path);
    }

    public function sortBy(
        string $fieldname,
        string $direction = SortAttribute::ASCENDING,
        string $type = SortAttribute::SORT_TYPE_DEFAULT
    ): self {
        $this->sorts->sortBy($fieldname, $direction, $type);
        return $this;
    }
}
