<?php

function outra(callable $funcao): void
{
    echo 'Execuntando outra função: ';
    echo $funcao();
}

$nomeDaFuncao = function () {
    return 'Uma outra função';
};
outra($nomeDaFuncao);
