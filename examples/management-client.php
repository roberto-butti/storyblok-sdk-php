<?php

use StoryblokApi\Client\ManagementSdk;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR. "..");
$dotenv->load();

$token = (string)$_ENV['STORYBLOK_ACCESS_TOKEN'];

$sdk = ManagementSdk::make($token);
// https://www.storyblok.com/docs/api/management#core-resources/spaces/spaces
$spaces = $sdk->spaces()->all();

$space = [];
foreach ($spaces["spaces"] as $space) {
    echo str_pad($space["id"], 10, " ", STR_PAD_LEFT) . " " . $space["name"] . PHP_EOL;
}

$spaces = $sdk->spaces()->space('74054')->get();
