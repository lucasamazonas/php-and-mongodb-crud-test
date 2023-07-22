<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$mongoClient = new MongoDB\Client($_ENV['DB']);

$db = $mongoClient->systock;

$deletResult = $db->produtos->deleteOne([
    "_id" => new MongoDB\BSON\ObjectId($argv[1])
]);

echo $deletResult->getDeletedCount() . PHP_EOL;