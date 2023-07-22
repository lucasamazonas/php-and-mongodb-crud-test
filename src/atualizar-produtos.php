<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$mongoClient = new MongoDB\Client($_ENV['DB']);

$db = $mongoClient->systock;

$filtro = ["_id" => new MongoDB\BSON\ObjectId($argv[1])];

$resulto = $db->produtos->updateOne(
    $filtro,
    ['$set' => [
        "nome" => $argv[2]
    ]],
);
