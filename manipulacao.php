<?php

$dados = require 'dados.php';

$contador = count($dados);
echo "Número de países: $contador\n";

function somaMedalhas(int $medalhasAcumuladas, int $medalhas) {
    return $medalhasAcumuladas + $medalhas;
}

function convertePaisParaLetraMaisucula(array $pais): array {
    $pais['pais'] = mb_convert_case($pais['pais'], MB_CASE_UPPER);
    return $pais;
}

function verificaSePaisTemEspacoNoNome(array $pais): bool
{
    return strpos($pais['pais'], ' ') !== false;
}

function medalhasAcumuladas(int $medalhasAcumuladas, array $pais): int {
    return $medalhasAcumuladas + array_reduce($pais['medalhas'], 'somaMedalhas', 0);
}

$dados = array_map('convertePaisParaLetraMaisucula', $dados);
$dados = array_filter($dados, 'verificaSePaisTemEspacoNoNome');

var_dump($dados);

echo array_reduce($dados, 'medalhasAcumuladas', 0);