<?php

use StoryblokApi\Client\ContentDeliverySdk;
use StoryblokApi\Client\Endpoint\Params\StoriesParams;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR. "..");
$dotenv->load();

$token = (string)$_ENV['STORYBLOK_TOKEN'];

echo "---" . $token . "###";
$sdk = new ContentDeliverySdk();
$response = $sdk->token($token)->stories()->all();
var_dump($response["stories"]);

echo "---" . $token . "###";
$sdk = new ContentDeliverySdk();
$sdk->regionUs();
$token = (string)$_ENV['STORYBLOK_TOKEN_US'];
$response = $sdk->token($token)->stories()->all();
echo $sdk->getUriString();
var_dump($response);
$response = $sdk->token($token)->stories()->get(
    (new StoriesParams())->versionDraft()->searchTerm("world")
);
var_dump($response);
