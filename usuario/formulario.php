<?php
include_once 'Usuario.php';
include_once '../perfil/Perfil.php';

$usuario = new Usuario();
$perfil = new Perfil();

// Recuprando os dados de perfil
$perfis = $perfil->recuperarDados();

if (!empty($_GET['id_usuario'])) {
    $usuario->carregarPorId($_GET['id_usuario']);
}

include_once '../cabecalho.php';
?>

<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuario</h3>
        </div>
    </div>
</div>

<div class="col-md-offset-1 col-md-10 panel">
    <div id="mensagem" role="alert"></div>
    <div class="col-md-12 panel-body" style="padding-bottom:30px;">
        <div class="col-md-12">
            <div class="col-md-offset-1 col-md-10 panel-danger">

            </div>

            <form action="processamento.php?acao=salvar" method="post" class="form-horizontal">
                <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $usuario->getIdUsuario(); ?>"/>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" id="nome" name="nome" required
                           value="<?php echo $usuario->getNome(); ?>">
                    <span class="bar"></span>
                    <label>Nome</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="email" class="form-text" id="email" name="email" required
                           value="<?php echo $usuario->getEmail(); ?>">
                    <span class="bar"></span>
                    <label>E-mail</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" id="senha" name="senha" required
                           value="<?php echo $usuario->getSenha(); ?>">
                    <span class="bar"></span>
                    <label>Senha</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <select class="form-text" name="id_perfil" id="id_perfil">
                        <option value="">--</option>
                        <?php

                        foreach ($perfis as $aperfis){ ?>

                            <?php if ($aperfis['id_perfil'] == $usuario->getPerfilId()){
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            ?>

                            <option value="<?= $aperfis['id_perfil'] ?>" <?=$selected?>><?= $aperfis['nome'] ?></option>

                        <?php } ?>
                    </select>
                    <span class="bar"></span>
                    <label> <i class="icons icon-people"></i> Perfil</label>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success"><span class="fa fa-thumbs-o-up"> </span>
                            Salvar
                        </button>
                        <a class="btn btn-danger" href="index.php"><span class="fa fa-reply"> </span> Voltar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once '../rodape.php';
?>