<?php
include_once 'Uf.php';

$uf = new uf();
//print_r($_POST);echo'<br>';
//print_r($_GET);die;

switch ($_GET['acao']) {
    case 'salvar':
        if (!empty($_POST['id_uf'])) {
//            print_r($_POST);die;
            $uf->alterar($_POST);
        } else {
//            print_r($_POST);die;
            $uf->inserir($_POST);
        }
        break;
    case 'excluir':
        $uf->excluir($_GET['id_uf']);
        break;
    case 'verificar_sigla':
        $existe = $uf->existeSigla($_GET['id_uf']);

        if ($existe){
            echo "<div class='alert' style='background: #2093ee; color: #ffffff'><h3 class='text-center'>A UF {$_GET['id_uf']} já existe, informe outra.</h3></div>";
        }
        die;
    case 'verificar_nome':
        $existe = $uf->existeNome($_GET['nome']);

        if ($existe){
            echo "<div class='alert' style='background: #2093ee; color: #ffffff'><h3 class='text-center'>O nome {$_GET['nome']} já existe, informe outro.</h3></div>";
        }
        die;
        break;
}

header('location: index.php');