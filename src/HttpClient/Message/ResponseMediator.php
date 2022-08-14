<?php

declare(strict_types=1);

namespace StoryblokApi\Client\HttpClient\Message;

use Psr\Http\Message\ResponseInterface;

final class ResponseMediator
{
    /**
     * @return array<mixed>
     */
    public static function getContent(ResponseInterface $response): array
    {
        return (array)json_decode($response->getBody()->getContents(), true);
    }
}
