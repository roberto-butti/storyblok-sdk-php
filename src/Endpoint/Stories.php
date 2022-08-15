<?php

declare(strict_types=1);

namespace StoryblokApi\Client\Endpoint;

use StoryblokApi\Client\ContentDeliverySdk;
use StoryblokApi\Client\Endpoint\Params\StoriesParams;

final class Stories extends AbstractApi
{
    public function __construct(ContentDeliverySdk $sdk)
    {
        $this->sdk = $sdk;
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
    public function get(StoriesParams $params): array
    {
        $path= $params->getQueryString();
        return $this->getContent('/stories' . $path);
    }
}
