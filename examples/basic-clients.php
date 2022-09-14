<?php

use StoryblokApi\Client\ContentDeliverySdk;
use StoryblokApi\Client\Endpoint\Params\StoriesParams;

require_once __DIR__.'/../vendor/autoload.php';

function print_stories($stories)
{
    foreach ($stories['stories'] as $story) {
        echo $story["id"] . " - " . $story["name"]. " (" . $story["full_slug"] . ")" .  PHP_EOL;
    }
}
function print_title($title)
{
    echo str_pad("", strlen($title)+4, "-") .PHP_EOL;
    echo "# " . $title . " #" . PHP_EOL;
    echo str_pad("", strlen($title)+4, "-") .PHP_EOL;
}

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR. "..");
$dotenv->load();

$token = (string)$_ENV['STORYBLOK_TOKEN'];

print_title("All Published Stories");
$sdk = new ContentDeliverySdk();
$response = $sdk->token($token)->stories()->all();
print_stories($response);

print_title("All draft Stories");
$sdk = new ContentDeliverySdk();
$response = $sdk->token($token)->stories()->get(StoriesParams::make()->versionDraft());
print_stories($response);

$term = "world";
print_title("Stories with term: " . $term);
$response = $sdk->token($token)->stories()->get(
    StoriesParams::make()->versionDraft()->searchTerm($term)
);
print_stories($response);

print_title("Stories in US region");
$sdk = new ContentDeliverySdk();
$sdk->regionUs();
$token = (string)$_ENV['STORYBLOK_TOKEN_US'];
$response = $sdk->token($token)->stories()->all();
echo "# Base URL for US: " . $sdk->getUriString() . PHP_EOL;
print_stories($response);
