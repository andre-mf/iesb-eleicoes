<?php
include_once 'Pagina.php';

$pagina = new Pagina();

if (!empty($_GET['id_pagina'])) {
    $pagina->carregarPorId($_GET['id_pagina']);
}

include_once '../perfil/Perfil.php';
$perfis = (new Perfil())->recuperarDados();

include_once '../cabecalho.php';
?>

    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft"><span class="fa fa-list-alt"></span> Página</h3>
            </div>
        </div>
    </div>

    <div class="col-md-offset-1 col-md-10 panel">
        <div id="mensagem"></div>

        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
            <div class="col-md-12">
                <form action="processamento.php?acao=salvar" method="post" class="form-horizontal">

                    <!-- id_pagina -->
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        <input type="hidden" class="form-text" id="id_pagina" name="id_pagina" required
                               value="<?= $pagina->getIdPagina(); ?>">
                    </div>
                    <!-- Nome -->
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        <input type="text" class="form-text" id="nome" name="nome" required
                               value="<?= $pagina->getNome(); ?>">
                        <span class="bar"></span>
                        <label><span class="icon-book-open"></span> Nome</label>
                    </div>
                    <!-- Caminho -->
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        <input type="text" class="form-text" id="caminho" name="caminho" required
                               value="<?= $pagina->getCaminho(); ?>">
                        <span class="bar"></span>
                        <label><span class="icon-direction"></span> Caminho</label>
                    </div>
                    <!-- Pública -->
                    <div class="form-group form-animate-radio" style="margin-top:40px !important;">
                        <fieldset>
                            <legend style="color: #999999; font-size: 18px;"><span class="icon-lock-open"></span> Pública?</legend>
                            <label class="radio">
                                <input id="radio1" type="radio" name="publica"
                                       value="1" <?= ("1" == $pagina->getPublica()) ? "checked": ""; ?>/>
                                <span class="outer">
                              <span class="inner"></span></span> Sim
                            </label>
                            <label class="radio">
                                <input id="radio1" type="radio" name="publica" value="0" <?= ("0" == $pagina->getPublica()) ? "checked": ""; ?>/>
                                <span class="outer">
                              <span class="inner"></span></span> Não
                            </label>
                        </fieldset>
                    </div>
                    <!-- Permissão à pagina -->
                    <div class="form-group">
                        <fieldset>
                            <legend style="color: #999999; font-size: 18px;"><span class="fa icon-people"></span> Perfis com permissão à esta página</legend>
                        </fieldset>
                    </div>
                    <?php foreach ($perfis as $aperfil) { ?>
                        <div class="form-group form-animate-checkbox">
                            <input type="checkbox" class="checkbox" value="<?= $aperfil['id_perfil'] ?>"
                                   name="id_perfil[]">
                            <label><?= $aperfil['nome'] ?></label>
                        </div>
                    <?php } ?>
                    <!-- Enviando ou cancelando o Envio -->
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
include_once '../rodape.php'; ?>