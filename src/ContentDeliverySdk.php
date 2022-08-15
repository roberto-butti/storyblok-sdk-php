<?php

declare(strict_types=1);

namespace StoryblokApi\Client;

use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\QueryDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
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
    public function __construct(Options $options = null)
    {
        $this->options = $options ?? new Options();
        $this->clientBuilder = $this->options->getClientBuilder();
        $this->clientBuilder->addPlugin(new BaseUriPlugin($this->options->getUri()));
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

    public function regionUs(): self
    {
        return $this->region("us");
    }

    public function region(string $region): self
    {
        $this->clientBuilder->removePlugin(BaseUriPlugin::class);
        $this->clientBuilder->addPlugin(
            new BaseUriPlugin($this->options->getUriFactory()->createUri('https://api-' . $region . '.storyblok.com/v2/cdn'))
        );
        $this->options->setUriString('https://api-' . $region . '.storyblok.com/v2/cdn');
        return $this;
    }
    public function token(string $token): self
    {
        //$this->token = $token;
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
}
