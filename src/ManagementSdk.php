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
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use StoryblokApi\Client\Endpoint\Management\Spaces;
use StoryblokApi\Client\Endpoint\Management\Stories;
use StoryblokApi\Client\HttpClient\BaseSdk;
use StoryblokApi\Client\HttpClient\Options;

/**
 * SDK for API Storyblok integration with
 * Management API v1
 * https://www.storyblok.com/docs/api/management
 *
 */
final class ManagementSdk extends BaseSdk
{
    public function __construct(string $oauth_token = null, Options $options = null)
    {
        $this->options = $options ?? new Options();
        $this->clientBuilder = $this->options->getClientBuilder();
        $this->clientBuilder->addPlugin(new BaseUriPlugin($this->options->getUri()));
        $uriFactory = Psr17FactoryDiscovery::findUriFactory();
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
        if ($oauth_token) {
            $this->token($oauth_token);
        }

    }

    public static function make(string $token): self
    {
        $sdk = new self();
        if ($token) {
            $sdk->token($token);
        }
        return $sdk;
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
