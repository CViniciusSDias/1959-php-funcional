<?php

$dados = require 'dados.php';

$contador = count($dados);
echo "Número de países: $contador\n";

function convertePaisParaLetraMaisucula(array $pais): array {
    $pais['pais'] = mb_convert_case($pais['pais'], MB_CASE_UPPER);
    return $pais;
}

function verificaSePaisTemEspacoNoNome(array $pais): bool
{
    return strpos($pais['pais'], ' ') !== false;
}

$dados = array_map('convertePaisParaLetraMaisucula', $dados);
$dados = array_filter($dados, 'verificaSePaisTemEspacoNoNome');

var_dump($dados);
