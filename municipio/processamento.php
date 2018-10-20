<?php
include_once 'Municipio.php';

$municipio = new Municipio();

switch ($_GET['acao']){
    case 'salvar':
        if(!empty($_POST['id_municipio'])){
            $municipio->alterar($_POST);
        } else {
            $municipio->inserir($_POST);
        }
        break;
    case 'excluir':
        $municipio->excluir($_GET['id_municipio']);
        break;
    case 'preenche_combo':
        $municipios = (new Municipio())->recuperarDados($_GET['id_uf']);
        echo json_encode($municipios);
        die;
        break;
}

header('location: index.php');