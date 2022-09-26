<?php

namespace StoryblokApi\Client\HttpClient;

use Http\Client\Common\HttpMethodsClientInterface;
use Psr\Http\Message\UriInterface;

abstract class BaseSdk
{
    protected ClientBuilder $clientBuilder;
    protected Options $options;

    /**
     * Get the UriInterface of the current endpoint
     * @return UriInterface
     */
    public function getUri(): UriInterface
    {
        return $this->options->getUri();
    }

    /**
     * Return the URI (string) of the current endpoint
     * For example:
     * - https://api-us.storyblok.com/v2/cdn
     * - https://api.storyblok.com/v2/cdn
     * @return string
     */
    public function getUriString(): string
    {
        return $this->options->getUriString();
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->clientBuilder->getHttpClient();
    }

    /**
     * Returns the user agent
     * @return string
     */
    public function getUserAgent(): string
    {
        return 'PHP Custom SDK';
    }
}
