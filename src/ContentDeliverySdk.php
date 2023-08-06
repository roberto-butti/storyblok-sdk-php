<?php

declare(strict_types=1);

namespace StoryblokApi\Client;

use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\QueryDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use StoryblokApi\Client\Endpoint\Spaces;
use StoryblokApi\Client\Endpoint\Stories;
use StoryblokApi\Client\HttpClient\BaseSdk;
use StoryblokApi\Client\HttpClient\Options;

/**
 * SDK for API Storyblok integration with
 * Content Delivery API v2
 * https://www.storyblok.com/docs/api/content-delivery/v2
 *
 */
final class ContentDeliverySdk extends BaseSdk
{
    public function __construct(string $token = null, Options $options = null)
    {
        $this->options = $options ?? new Options();
        $this->clientBuilder = $this->options->getClientBuilder();
        $this->clientBuilder->addPlugin(new BaseUriPlugin($this->options->getUri()));
        $this->clientBuilder->addPlugin(
            new HeaderDefaultsPlugin(
                [
                    'User-Agent' => $this->getUserAgent(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            )
        );
        $this->clientBuilder->addPlugin(
            new RedirectPlugin()
        );
        if ($token) {
            $this->token($token);
        }
    }

    public static function make(string|null $token = null): self
    {
        return new self($token);
    }

    public function regionUs(): self
    {
        return $this->region("us");
    }
    public function regionEu(): self
    {
        return $this->region("eu");
    }


    public function region(string $region = ""): self
    {
        $hostNamePrefix = "api";
        if (strtolower($region) === "us") {
            $hostNamePrefix = "api-us";
        }
        $uriPrefix = 'https://' . $hostNamePrefix . '.storyblok.com/v2/cdn';
        $this->clientBuilder->removePlugin(BaseUriPlugin::class);
        $this->clientBuilder->addPlugin(
            new BaseUriPlugin($this->options->getUriFactory()->createUri($uriPrefix))
        );
        $this->options->setUriString($uriPrefix);
        return $this;
    }
    public function token(string $token): self
    {
        $this->clientBuilder->addPlugin(
            new QueryDefaultsPlugin([
                'token' => $token,
            ])
        );
        return $this;
    }

    public function stories(): Stories
    {
        return new Endpoint\Stories($this);
    }

    public function spaces(): Spaces
    {
        return new Endpoint\Spaces($this);
    }
}
