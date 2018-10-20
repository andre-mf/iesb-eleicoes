<?php
include_once 'Eleitor.php';

$eleitor = new eleitor();

switch ($_GET['acao']){
    case 'salvar':

        $origem = $_FILES['foto']['tmp_name'];
        $destino = '';

        if(!empty($_POST['id_eleitor'])){
            $eleitor->alterar($_POST);
        } else {
            $eleitor->inserir($_POST);
        }
        break;
    case 'excluir':
        $eleitor->excluir($_GET['id_eleitor']);
        break;
    case 'verificar_titulo':
        $existe = $eleitor->existeTitulo($_GET['titulo']);

        if ($existe){
            echo "<div class='alert' style='background: #2093ee; color: #ffffff'><h2 class='text-center'>O título {$_GET['titulo']} já existe, informe outro.</h2></div>";
        }
        die;
        break;
    case 'verificar_nome':
        $existe = $eleitor->existeNome($_GET['nome']);

            if ($existe){
                if ($existe > 1){
                    echo "<div class='alert' style='background: #2093ee; color: #ffffff'><h3 class='text-center'>Já existem {$existe} eleitores chamados {$_GET['nome']}, informe outro. </h3></div>";
                } else {
                    echo "<div class='alert' style='background: #2093ee; color: #ffffff'><h3 class='text-center'>Já existe {$existe} eleitor chamado {$_GET['nome']}, informe outro.</h3></div>";
                }
            }

        die;
        break;
}

header('location: index.php');