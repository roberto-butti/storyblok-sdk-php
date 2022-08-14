<?php

declare(strict_types=1);

namespace StoryblokApi\Client;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\QueryDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\UriFactory;
use StoryblokApi\Client\Endpoint\Stories;
use StoryblokApi\Client\HttpClient\ClientBuilder;

/**
 * SDK for API Storyblok integration with
 * Content Delivery API v2
 * https://www.storyblok.com/docs/api/content-delivery/v2
 *
 */
final class ContentDeliverySdk
{
    private ClientBuilder $clientBuilder;
    private string $token;

    public function __construct(ClientBuilder $clientBuilder = null, UriFactory $uriFactory = null)
    {
        $this->clientBuilder = $clientBuilder ?: new ClientBuilder();
        $uriFactory = $uriFactory ?: Psr17FactoryDiscovery::findUriFactory();

        $this->clientBuilder->addPlugin(
            new BaseUriPlugin($uriFactory->createUri('https://api.storyblok.com/v2/cdn'))
        );
        $this->clientBuilder->addPlugin(
            new HeaderDefaultsPlugin(
                [
                    'User-Agent' => 'PHP Custom SDK',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            )
        );
        $this->clientBuilder->addPlugin(
            new RedirectPlugin()
        );
    }

    public function token(string $token): self
    {
        $this->token = $token;
        $this->clientBuilder->addPlugin(
            new QueryDefaultsPlugin([
                'token' => $this->token,
            ])
        );
        return $this;
    }

    public function stories(): Stories
    {
        return new Endpoint\Stories($this);
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->clientBuilder->getHttpClient();
    }
}
