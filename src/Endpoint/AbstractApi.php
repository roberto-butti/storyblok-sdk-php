<?php

declare(strict_types=1);

namespace StoryblokApi\Client\Endpoint;

use Http\Client\Exception;
use StoryblokApi\Client\HttpClient\BaseSdk;
use StoryblokApi\Client\HttpClient\Message\ResponseMediator;

/**
 * @author Roberto Butti <roberto.butti@gmail.com>
 */
abstract class AbstractApi
{
    protected BaseSdk $sdk;

    /**
     * @return array<mixed>
     */
    protected function getContent(string $path): array
    {
        try {
            $response = $this->sdk->getHttpClient()->get($path);
            return ResponseMediator::getContent($response);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return [];
    }
}
