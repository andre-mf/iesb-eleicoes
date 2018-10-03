<?php
include_once 'Usuario.php';

$usuario = new usuario();

switch ($_GET['acao']) {
    case 'salvar':
        if (!empty($_POST['id_usuario'])) {
            $usuario->alterar($_POST);
        } else {
            $usuario->inserir($_POST);
        }
        break;
    case 'excluir':
        $usuario->excluir($_GET['id_usuario']);
        break;
}

header('location: index.php');