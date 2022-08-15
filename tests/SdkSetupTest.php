<?php

use StoryblokApi\Client\ContentDeliverySdk;

test('ContentDeliverySdk initialization', function () {
    $s = new ContentDeliverySdk();
    expect($s->getUri()->getHost())->toEqual("api.storyblok.com");
    expect($s->getUriString())->toEqual("https://api.storyblok.com/v2/cdn");

    $s = (new ContentDeliverySdk())->regionUs();

    expect($s->getUri()->getHost())->toEqual("api-us.storyblok.com");
    expect($s->getUriString())->toEqual("https://api-us.storyblok.com/v2/cdn");
});
