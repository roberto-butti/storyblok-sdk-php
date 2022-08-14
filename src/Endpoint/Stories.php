<?php

declare(strict_types=1);

namespace StoryblokApi\Client\Endpoint;

use StoryblokApi\Client\HttpClient\Message\ResponseMediator;
use StoryblokApi\Client\ContentDeliverySdk;

final class Stories
{
    private ContentDeliverySdk $sdk;

    public function __construct(ContentDeliverySdk $sdk)
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
