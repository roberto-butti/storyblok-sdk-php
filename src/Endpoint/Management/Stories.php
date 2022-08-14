<?php

declare(strict_types=1);

namespace StoryblokApi\Client\Endpoint\Management;

use StoryblokApi\Client\HttpClient\Message\ResponseMediator;
use StoryblokApi\Client\ManagementSdk;

final class Stories
{
    private ManagementSdk $sdk;

    public function __construct(ManagementSdk $sdk)
    {
        $this->sdk = $sdk;
    }

    /**
     * @return array<mixed>
     */
    public function all(): array
    {
        $response = $this->sdk->getHttpClient()->get('/stories');

        return ResponseMediator::getContent($response);
    }
}
