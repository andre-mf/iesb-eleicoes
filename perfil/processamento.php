<?php
include_once 'Perfil.php';

$perfil = new Perfil();

switch ($_GET['acao']) {
    case 'salvar':
        if (!empty($_POST['id_perfil'])) {
            $perfil->alterar($_POST);
        } else {
            $perfil->inserir($_POST);
        }
        break;
    case 'excluir':
        $perfil->excluir($_GET['id_perfil']);
        break;
}

header('location: index.php');