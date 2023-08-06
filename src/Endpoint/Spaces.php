<?php

declare(strict_types=1);

namespace StoryblokApi\Client\Endpoint;

use StoryblokApi\Client\ContentDeliverySdk;

final class Spaces extends AbstractApi
{
    public function __construct(ContentDeliverySdk $sdk)
    {
        $this->sdk = $sdk;
    }

    /**
     * @return array<mixed>
     */
    public function all(): array
    {
        return $this->getContent('/spaces');
    }

    /**
     * @return array<mixed>
     */
    public function get(): array
    {
        return $this->getContent('/spaces/me');
    }


}
