<?php
include_once 'Uf.php';

$uf = new Uf();

if (!empty($_GET['id_uf'])) {
    $uf->carregarPorId($_GET['id_uf']);
}

include_once '../cabecalho.php';
?>

    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft"><span class="fa fa-map"></span> Unidade Federativa</h3>
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

                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        <input type="text" class="form-text" id="id_uf" name="id_uf" required
                               value="<?= $uf->getIdUf(); ?>">
                        <span class="bar"></span>
                        <label><span class="fa fa-map"></span> Sigla UF</label>
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        <input type="text" class="form-text" id="nome" name="nome" required
                               value="<?php echo $uf->getNome(); ?>">
                        <span class="bar"></span>
                        <label><span class="fa fa-map-o"></span> Nome</label>
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

<script>
    $(function () {

        // $('#id_uf').change(function() {
        //     $uf = $('#id_uf').val();
        //     $.ajax({
        //         url: 'processamento.php?acao=verificar_sigla&id_uf=' + $uf,
        //         success: function (dados) {
        //             if (dados){
        //                 alert(dados);
        //             }
        //         }
        //     });
        // });

        $('#id_uf').change(function () {
            $uf = $('#id_uf').val();
            $('#mensagem').load('processamento.php?acao=verificar_sigla&id_uf=' + $uf.toUpperCase());

        });

        $('#nome').change(function () {
            $('#mensagem').load('processamento.php?acao=verificar_nome&' + $('#nome').serialize());
        })

    })
</script>
