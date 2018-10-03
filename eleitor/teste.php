<?php
include_once "Eleitor.php";
include_once "../uf/Uf.php";

$uf = new usuario();

$eleitor = new Eleitor();

//print_r($eleitor->existeNome('Maria'));

$ret = $eleitor->existeTitulo(123);

var_dump($ret);

//$ret = $eleitor->recuperarDados();
//echo "<br>";
//print_r($ret);

$teste = $eleitor->carregarPorId(1);
echo $eleitor->getNome();
echo $eleitor->getTelefone();

//print_r("<br>" . $teste);
//
//$testeuf = $uf->existeNome('Bahias');
//var_dump($testeuf);

var_dump($eleitor->existeNome('Maria'));

// incluindo as UFs
include_once '../uf/Uf.php';
$uf = new usuario();

// Recuprando os dados de municipio
$ufs = $uf->recuperarDados();

echo "<pre>";
print_r($ufs);
echo "</pre>";

