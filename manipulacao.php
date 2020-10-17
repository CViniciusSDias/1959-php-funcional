<?php

require_once 'vendor/autoload.php';

$dados = require 'dados.php';

$contador = count($dados);
echo "Número de países: $contador\n";

$somaMedalhas = fn (int $medalhasAcumuladas, int $medalhas) => $medalhasAcumuladas + $medalhas;

function convertePaisParaLetraMaisucula(array $pais): array {
    $pais['pais'] = mb_convert_case($pais['pais'], MB_CASE_UPPER);
    return $pais;
}

$verificaSePaisTemEspacoNoNome = fn (array $pais): bool => strpos($pais['pais'], ' ') !== false;

$comparaMedalhas = fn (array $medalhasPais1, array $medalhasPais2): callable
    => fn (string $modalidade): int => $medalhasPais2[$modalidade] <=> $medalhasPais1[$modalidade];

$nomesDePaisesEmMaisuculo = fn ($dados) => array_map('convertePaisParaLetraMaisucula', $dados);
$filtraPaisesSemEspacoNoNome = fn ($dados) => array_filter($dados, $verificaSePaisTemEspacoNoNome);

$funcoes = \igorw\pipeline(
    $nomesDePaisesEmMaisuculo,
    $filtraPaisesSemEspacoNoNome,
);
$dados = $funcoes($dados);

$medalhas = array_reduce(
    array_map(
        fn (array $medalhas): int => array_reduce($medalhas, $somaMedalhas, 0),
        array_column($dados, 'medalhas')
    ),
    $somaMedalhas,
    0
);

usort($dados, function (array $pais1, array $pais2) use ($comparaMedalhas) {
    $medalhasPais1 = $pais1['medalhas'];
    $medalhasPais2 = $pais2['medalhas'];
    $comparador = $comparaMedalhas($medalhasPais1, $medalhasPais2);

    return $comparador('ouro') !== 0 ? $comparador('ouro')
        : ($comparador('prata') !== 0 ? $comparador('prata')
        : $comparador('bronze'));
});

var_dump($dados);

echo $medalhas;
