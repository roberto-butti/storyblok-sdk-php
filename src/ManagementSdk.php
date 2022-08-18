<?php

declare(strict_types=1);

namespace StoryblokApi\Client;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\LoggerPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\Formatter\FullHttpMessageFormatter;
use Http\Message\UriFactory;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use StoryblokApi\Client\Endpoint\Management\Spaces;
use StoryblokApi\Client\Endpoint\Management\Stories;
use StoryblokApi\Client\HttpClient\BaseSdk;
use StoryblokApi\Client\HttpClient\ClientBuilder;

/**
 * SDK for API Storyblok integration with
 * Management API v1
 * https://www.storyblok.com/docs/api/management
 *
 */
final class ManagementSdk extends BaseSdk
{
    public function __construct(ClientBuilder $clientBuilder = null, UriFactory $uriFactory = null)
    {
        $this->clientBuilder = $clientBuilder ?: new ClientBuilder();
        $uriFactory = $uriFactory ?: Psr17FactoryDiscovery::findUriFactory();

        $this->clientBuilder->addPlugin(
            new BaseUriPlugin($uriFactory->createUri('https://mapi.storyblok.com/v1'))
        );
        $this->clientBuilder->addPlugin(
            new HeaderDefaultsPlugin(
                [
                    'User-Agent' => $this->getUserAgent(),
                    'Content-Type' => 'application/json'
                ]
            )
        );
        $this->clientBuilder->addPlugin(
            new RedirectPlugin()
        );
        $logger = new Logger('http');
        $logger->pushHandler(new StreamHandler('my.log', Logger::DEBUG));
        $this->clientBuilder->addPlugin(
            new LoggerPlugin($logger, new FullHttpMessageFormatter())
        );
    }

    public static function make(): self
    {
        return new self();
    }

    public function token(string $token): self
    {
        // We don't need to set a Bearer, because the documentation says
        // that the token is set in the Authorization header.
        // $authentication = new Bearer($this->token);
        // https://www.storyblok.com/docs/api/management#topics/authentication
        $this->clientBuilder->addPlugin(
            new HeaderDefaultsPlugin(
                [
                    'Authorization' => $token,
                ]
            )
        );
        return $this;
    }

    public function stories(): Stories
    {
        return new Stories($this);
    }
    public function spaces(): Spaces
    {
        return new Spaces($this);
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->clientBuilder->getHttpClient();
    }
}
