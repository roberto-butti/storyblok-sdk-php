<?php

declare(strict_types=1);

namespace StoryblokApi\Client\HttpClient;

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 *
 */
final class Options
{
    /**
     * @var array<mixed>
     */
    private array $options;

    /**
     * @param array<mixed> $options
     */
    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    /**
     * @param OptionsResolver $resolver
     * @return void
     */
    private function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'client_builder' => new ClientBuilder(),
                'uri_factory' => Psr17FactoryDiscovery::findUriFactory(),
                'uri' => 'https://api.storyblok.com/v2/cdn',
            ]
        );

        $resolver->setAllowedTypes('uri', 'string');
        $resolver->setAllowedTypes('client_builder', ClientBuilder::class);
        $resolver->setAllowedTypes('uri_factory', UriFactoryInterface::class);
    }

    /**
     * @return ClientBuilder
     */
    public function getClientBuilder(): ClientBuilder
    {
        return $this->options['client_builder'];
    }

    /**
     * @return UriFactoryInterface
     */
    public function getUriFactory(): UriFactoryInterface
    {
        return $this->options['uri_factory'];
    }

    /**
     * @return UriInterface
     */
    public function getUri(): UriInterface
    {
        return $this->getUriFactory()->createUri($this->options['uri']);
    }
    /**
     * @return string
     */
    public function getUriString(): string
    {
        return $this->options['uri'];
    }

    public function setUriString(string $string): void
    {
        $this->options['uri'] = $string;
    }
}
