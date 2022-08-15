<?php

namespace StoryblokApi\Client\HttpClient;

use Http\Client\Common\HttpMethodsClientInterface;
use Psr\Http\Message\UriInterface;

abstract class BaseSdk
{
    protected ClientBuilder $clientBuilder;
    protected Options $options;

    public function getUri(): UriInterface
    {
        return $this->options->getUri();
    }

    public function getUriString(): string
    {
        return $this->options->getUriString();
    }
    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->clientBuilder->getHttpClient();
    }
}
