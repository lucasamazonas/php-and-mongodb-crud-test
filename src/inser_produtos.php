<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$mongoClient = new MongoDB\Client($_ENV['DB']);

/** @var MongoDB\Database $db */
$db = $mongoClient->systock;

if (empty($argv[1])) {
    exit();
}

$produtos = [];

for ($count = 0; $count < $argv[1]; $count++) {
    $produtos[] = [
        "count" => $count,
        "nome" => "Produto " . $count,
        "estoque" => rand() * $count,
        "estoque_seguranca" => rand() * $count,
        "ponto_pedido" => rand() * $count,
        "estoque_maximo" => rand() * $count,
        "id_segmento" => rand(),
        "nome_segmento" => "Segmento " . $count
    ];

    if (count($produtos) >= min($argv[2], $argv[1])) {
        $db->produtos->insertMany($produtos);
        $produtos = [];
    }
}