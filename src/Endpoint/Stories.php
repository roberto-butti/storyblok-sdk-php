<?php

declare(strict_types=1);

namespace StoryblokApi\Client\Endpoint;

use StoryblokApi\Client\ContentDeliverySdk;
use StoryblokApi\Client\Endpoint\Params\StoriesParams;

final class Stories extends AbstractApi
{
    protected StoriesParams $params;
    public function __construct(ContentDeliverySdk $sdk)
    {
        $this->sdk = $sdk;
        $this->params = new StoriesParams();
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
        return $this->getContent('/stories' . $path);
    }
}
