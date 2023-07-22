<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$mongoClient = new MongoDB\Client($_ENV['DB']);

$db = $mongoClient->systock;

$cursor = $db->produtos->find([
    $argv[1] => new MongoDB\BSON\Regex($argv[2], 'i')
]);

foreach ($cursor as $item) {
    echo "Produto: " . PHP_EOL;
    echo "  _id: " . $item->_id . PHP_EOL;
    echo "  Nome: " . $item->nome . PHP_EOL;
    echo PHP_EOL;
}