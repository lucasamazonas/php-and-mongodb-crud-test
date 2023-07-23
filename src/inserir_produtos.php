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
        "estoque" => rand(0, 1) * $count,
        "estoque_seguranca" => rand(0, 1) * $count,
        "ponto_pedido" => rand(0, 1) * $count,
        "estoque_maximo" => rand(0, 1) * $count,
        "id_segmento" => rand(0, 1),
        "nome_segmento" => "Segmento " . $count
    ];

    if (count($produtos) >= min($argv[2], $argv[1])) {
        $db->produtos->insertMany($produtos);
        $produtos = [];
    }
}
