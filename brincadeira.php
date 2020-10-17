<?php

$variavel = 'teste';

function outra(callable $funcao): void
{
    echo 'Execuntando outra função: ';
    echo $funcao();
}

$nomeDaFuncao = function () use ($variavel) {
    echo $variavel;
    return 'Uma outra função';
};
outra($nomeDaFuncao);

var_dump($nomeDaFuncao);
