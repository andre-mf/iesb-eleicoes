<?php
include_once 'Municipio.php';

$municipio = new Municipio();

// incluindo as UFs
include_once '../uf/Uf.php';
$uf = (new uf())->recuperarDados();

// Decidindo se ira atualizar ou inserir
if(!empty($_GET['id_municipio'])){
    $municipio->carregarPorId($_GET['id_municipio']);
}
// Incluindo o inicio da aplicação
include_once '../cabecalho.php';

?>

<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft"><span class="fa icon-location-pin"></span> Município</h3>
        </div>
    </div>
</div>

    <div class="col-md-offset-1 col-md-10 panel">
        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
            <div class="col-md-12">

                <form action="processamento.php?acao=salvar" method="post" class="form-horizontal">

                    <div class="form-group form-animate-text" style="margin-top:40px !important;" hidden>
                        <input type="text" class="form-text" id="id_municipio" name="id_municipio" required
                               value="<?= $municipio->getIdMunicipio(); ?>">
                        <span class="bar"></span>
                        <label>Id_Municipio</label>
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        <input type="text" class="form-text" id="nome" name="nome" required
                               value="<?php echo $municipio->getNome(); ?>">
                        <span class="bar"></span>
                        <label><span class="fa icon-location-pin"></span> Nome</label>
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        <select class="form-text" name="id_uf" id="id_uf">
                            <option value="">--</option>
                            <?php

                            foreach ($uf as $auf) { ?>

                                <option value="<?= $auf['id_uf'] ?>"><?= $auf['nome'] ?></option>

                            <?php } ?>
                        </select>
<!--                        <input type="text" class="form-text" id="id_uf" name="id_uf" required-->
<!--                               value="--><?php //echo $municipio->getIdUf(); ?><!--">-->
                        <span class="bar"></span>
                        <label style="font-size: 18px;"><span class="fa fa-map"></span> UF</label>
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