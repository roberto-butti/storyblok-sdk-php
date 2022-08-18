<?php

declare(strict_types=1);

namespace StoryblokApi\Client\Endpoint\Management;

use StoryblokApi\Client\Endpoint\AbstractApi;
use StoryblokApi\Client\Endpoint\Params\StoriesManagementParams;
use StoryblokApi\Client\ManagementSdk;

final class Stories extends AbstractApi
{
    public function __construct(ManagementSdk $sdk)
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
     * @param StoriesManagementParams $params
     * @return array<mixed>
     */
    public function get(StoriesManagementParams $params): array
    {
        $path= $params->getQueryString();
        return $this->getContent('/stories' . $path);
    }
}
