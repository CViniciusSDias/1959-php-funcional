<?php

$dados = require 'dados.php';

$contador = count($dados);
echo "Número de países: $contador\n";

function convertePaisParaLetraMaisucula(array $pais) {
    $pais['pais'] = mb_convert_case($pais['pais'], MB_CASE_UPPER);
    return $pais;
}

$dados = array_map('convertePaisParaLetraMaisucula', $dados);

var_dump($dados);
