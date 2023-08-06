<?php

use StoryblokApi\Client\ContentDeliverySdk;
use StoryblokApi\Client\Endpoint\Params\StoriesParams;

test('ContentDeliverySdk initialization', function () {
    $s = new ContentDeliverySdk();
    expect($s->getUri()->getHost())->toEqual("api.storyblok.com");
    expect($s->getUriString())->toEqual("https://api.storyblok.com/v2/cdn");
    expect($s->getUserAgent())->toEqual("PHP Custom SDK");
    expect($s->getHttpClient())->toBeInstanceOf(\Http\Client\Common\HttpMethodsClient::class);


    $s = ContentDeliverySdk::make()->regionUs();
    expect($s->getUri()->getHost())->toEqual("api-us.storyblok.com");
    expect($s->getUriString())->toEqual("https://api-us.storyblok.com/v2/cdn");
});

test("token", function () {
    $sdk = ContentDeliverySdk::make("aaa")->regionUs();
    $sdk->stories()->get();

    expect($sdk->getUri()->getHost())->toEqual("api-us.storyblok.com");
    expect($sdk->getUriString())->toEqual("https://api-us.storyblok.com/v2/cdn");
});

test('ContentDeliverySdk Params', function () {
    $params = StoriesParams::make()
        ->searchTerm("test");
    expect($params->getQueryString())->toContain("search_term=test");

    $params = StoriesParams::make()
        ->searchTerm("test")
        ->versionDraft();
    expect($params->getQueryString())->toContain("search_term=test&version=draft");
    expect($params->getQueryString())->toEqual("?search_term=test&version=draft");

    $params = StoriesParams::make()
        ->findBy("uuid-example-value")
        ->versionDraft();

    expect($params->getQueryString())->toEqual("?find_by=uuid-example-value&version=draft");
});
