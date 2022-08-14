<?php

use StoryblokApi\Client\ContentDeliverySdk;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR. "..");
$dotenv->load();

$token = (string)$_ENV['STORYBLOK_TOKEN'];

echo "---" . $token . "###";
$sdk = new ContentDeliverySdk();
$response = $sdk->token($token)->stories()->all();
var_dump($response["stories"]);
