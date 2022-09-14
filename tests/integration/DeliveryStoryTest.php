<?php

use StoryblokApi\Client\ContentDeliverySdk;

function getToken(): string
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR. "../..");
    $dotenv->safeLoad();
    //$dotenv->load();
    return (string)$_ENV['STORYBLOK_TOKEN_TEST'];
}

test('ContentDeliverySdk response first level structure', function () {
    $sdk = new ContentDeliverySdk();
    $response = $sdk->token(getToken())->stories()->all();
    expect($response)->toHaveKey("stories")
        ->and($response)->toHaveKey("cv")
        ->and($response)->toHaveKey("rels")
        ->and($response)->toHaveKey("links");
});
