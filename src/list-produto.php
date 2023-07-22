<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$mongoClient = new MongoDB\Client($_ENV['DB']);

$db = $mongoClient->systock;

$produto = $db->produtos->findOne([
    '_id' => new MongoDB\BSON\ObjectId($argv[1])
]);

echo "Produto: " . PHP_EOL;
echo "  _id: " . $produto->_id . PHP_EOL;
echo "  Nome: " . $produto->nome . PHP_EOL;
echo "  Estoque: " . $produto->nome . PHP_EOL;
echo "  Estoque Seguranca: " . $produto->estoque_seguranca . PHP_EOL;
echo "  Ponto Pedido: " . $produto->ponto_pedido . PHP_EOL;
echo "  Estoque Máximo: " . $produto->estoque_maximo . PHP_EOL;