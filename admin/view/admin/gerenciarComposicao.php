<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

include_once CONTROLLERPATH . "/controlUsuario.php";
include_once MODELPATH . "/usuario.php";

include_once CONTROLLERPATH . "/seguranca.php";

include_once CONTROLLERPATH . "/controlAdicional.php";
include_once MODELPATH . "/adicional.php";

include_once CONTROLLERPATH . "/controlProduto.php";
include_once MODELPATH . "/produto.php";

include_once CONTROLLERPATH . "/controlIngrediente.php";
include_once MODELPATH . "/ingrediente.php";

$_SESSION['permissaoPagina'] = 0;

protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);

$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle_cardapio = new controlerProduto($_SG['link']);
$itens = $controle_cardapio->selectAll();

//usado para coloração customizada da página selecionada na navbar
$arquivo_pai = basename(__FILE__, '.php');

$controle_ingrediente = new controlerIngrediente($_SG['link']);
$ingredientes = $controle_ingrediente->selectAll();

$ingredientes_produto = NULL;
if (isset($_GET['fk_produto']) && isset($_GET['pk_composicao'])) {
    $fk_produto = $_GET['fk_produto'];
    $pk_composicao = $_GET['pk_composicao'];

    // $ingredientes_produto = $controle_ingrediente->selectByFkComposicao($pk_composicao);

} else {
    $fk_produto = "";
    $pk_composicao = "";
}

//todas composições com os respectivos ingredientes
$arr_pro_ingredientes = [];
foreach ($itens as $key => $item) {
    if ($item->pk_composicao) {
        $arr_pro_ingredientes[$item->pk_composicao] =
            $controle_ingrediente->selectByFkComposicao($item->pk_composicao);
    }
}

// echo "<pre>";
// var_dump($arr_pro_ingredientes);
// exit;
?>

<!DOCTYPE html>

<html class="no-js" lang="pt-br">

<head>

    <?php include VIEWPATH . "/cabecalho.html" ?>

</head>

<body>

    <?php include_once "./header.php" ?>

    <div class="container-fluid">

        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/businesComposicao.php">

            <div class="col-md-12">

                <h3>Gerenciar Composição de Produtos</h3>

                <div class="row">

                    <div class="col-md-5">
                        <h5>Selecione o item do Cardápio:*</h5>

                        <select name="item_cardapio" id="item_cardapio" class="form-control" required>
                            <option value="">Selecione o Produto</option>
                            <?php
                            foreach ($itens as $item) { ?>
                                <option value="<?= $item->getPkId(); ?>" data-pk_composicao="<?= $item->pk_composicao ?>">
                                    <?= $item->getNome() ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <br>

                <div class="row">

                    <div class="col-md-12 container conjunto-ingredientes">
                        <h5>Selecione os ingredientes:*</h6>

                            <!-- Default field for clone Purpose -->
                            <div style="display:none" ; class="col-md-12 ingrediente-adicionado" id="igr_field_0" data-igr_field_id="0">

                                <div class="col-md-4">
                                    <small>Ingrediente*</small>
                                    <select name="ingrediente[]" id="ingrediente0" data-field_id="0" class="form-control ingrediente" autofocus>
                                        <?php

                                        echo '<option value="">Selecione um Ingrediente</option>';

                                        foreach ($ingredientes as $ingrediente) { ?>

                                            <option value="<?= $ingrediente->getPkId(); ?>" data-valor="<?= $ingrediente->getValor(); ?>">
                                                <?= $ingrediente->getNome(); ?> (<?= $ingrediente->getUnidade() ?>)
                                            </option>

                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <small>Valor</small>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input required class="form-control valor_base" placeholder="0.00" name="valor[]" value="0" type="number" step="0.01" max="9999" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <small>Quantidade Utilizada*</small>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-edit"></i></span>
                                        <input class="form-control qtde_utilizada" name="qtde_utilizada[]" value="1" min="0" type="number" step="0.01" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <small>Valor Calculado</small>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input required class="form-control valor_calc" name="valor_calc[]" value="0" type="number" step="0.01" min="0.01" max="9999" readonly>
                                    </div>
                                </div>

                                <div class="col-md-1">

                                    <button class="rem-ingrediente remove-button btn btn-danger" type="button" class="btn btn-danger" style="display: inline-block; margin-top:20px; margin-left: 10px;"><i class="glyphicon glyphicon-trash"></i></button>
                                </div>

                            </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-success" id="addIngrediente" name="addIngrediente">Adicionar Ingrediente</button>
                    </div>
                </div>

                <hr>

                <div class="row">

                    <div class="col-md-2">
                        <small>Valor Extra:</small>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input class="form-control" placeholder="Valor da unidade" id="valor_extra" name="valor_extra" value="0.00" type="number" step="0.01" min="0" max="999">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <small>Valor Total / Preço de Custo*:</small>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input class="form-control" placeholder="Valor da unidade" id="valor_total" name="valor_total" value="0.00" type="number" step="0.01" min="0" max="9999" readonly>
                        </div>
                    </div>

                </div>

                <br>
                <br>

                <div class="row">
                    <div class="col-md-2">

                        <?php

                        $permissao =  json_decode($usuarioPermissao->getPermissao());

                        if (in_array('gerenciar_fornecedor', $permissao)) { ?>

                            <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                        <?php } ?>

                    </div>

                    <div class="col-md-3">
                        <a href="composicaoLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Sair</a>
                    </div>
                </div>
        </form>
    </div>

    </div>

    <?php include VIEWPATH . "/rodape.php" ?>

</body>




<script>
    let aux = '<?= json_encode($arr_pro_ingredientes) ?>';
    const arr_pro_ingredientes = JSON.parse(aux);
    // console.log(arr_pro_ingredientes);

    //select Composição by GET param / edit call
    $(document).ready(function() {
        let fk_produto = '<?= $fk_produto ?>';
        let pk_composicao = '<?= $pk_composicao ?>';

        setComposicao(arr_pro_ingredientes[pk_composicao], fk_produto);
    });


    //select Composição ao atualizar Produto
    $("body").on("input", "#item_cardapio", function() {
        let fk_produto = $(this).val();
        let pk_composicao = $(this).find(':selected').data("pk_composicao");

        //rm todos ingredientes exceto o default/clone
        $('.conjunto-ingredientes > .ingrediente-adicionado:gt(0)').remove();

        $('.conjunto-ingrediente > div:gt(0)').remove();

        //mantêm apenas div default
        // $('.conjunto-ingredientes').find(".").slice(1, 4).remove();

        setComposicao(arr_pro_ingredientes[pk_composicao], fk_produto);
    });

    //Add Ingrediente
    $("#addIngrediente").click(function() {

        novoIngrediente();

        atualizaTotal();
    });
    //Remove Ingrediente
    $(document).on('click', '.rem-ingrediente', function() {
        $(this).parent('div').parent('div').remove();

        atualizaTotal();
    });

    //Atualiza ingrediente
    $("body").on("input", ".ingrediente", function() {

        let igr_field = $(this).parent("div").parent("div");
        let id = "#" + igr_field.attr("id");
        let id_ingrediente = $(this).val();

        let valor_ingrediente = parseFloat($(this).find(':selected').attr("data-valor"));
        $(id + " .valor_base").attr("value", parseFloat(valor_ingrediente));

        let qtde_utilizada = parseFloat($(id + " .qtde_utilizada").val());

        let valor_calc = valor_ingrediente * qtde_utilizada;
        $(id + " .valor_calc").attr("value", parseFloat(valor_calc));

        atualizaTotal();
    });

    //Atualiza valor calculado
    $("body").on("input", ".qtde_utilizada", function() {

        let igr_field = $(this).parent("div").parent("div").parent("div");
        let id = "#" + igr_field.attr("id");

        let qtde_utilizada = parseFloat($(this).val());
        let valor_base = parseFloat($(id + " .valor_base").val());

        let valor_calc = valor_base * qtde_utilizada;

        $(id + " .valor_calc").val(parseFloat(valor_calc));

        atualizaTotal();
    });


    $("#valor_extra").on("input", function() {
        atualizaTotal();
    });

    function novoIngrediente() {
        //append novo
        $(".ingrediente-adicionado:last").clone().show().appendTo(".conjunto-ingredientes");

        //get id/posicao do ultimo ingrediente
        field_id = parseInt($(".ingrediente-adicionado:last").attr("data-igr_field_id"));
        id_inc = 1 + field_id;

        //reescreve identificadores do novo item
        $(".ingrediente-adicionado:last").attr("data-igr_field_id", id_inc);
        $(".ingrediente-adicionado:last").attr("id", "igr_field_" + id_inc);
    }

    function setComposicao(ingredientes, fk_produto) {

        if (ingredientes && fk_produto) {
            //set Produto
            $('#item_cardapio').val(fk_produto);

            //display ingredientes associados a Composição
            for (var k in ingredientes) {

                novoIngrediente();

                let valor_base = parseFloat(ingredientes[k]['igr_valor']);
                let qtde_utilizada = parseFloat(ingredientes[k]['coig_qtde_utilizada']);
                let valor_calc = qtde_utilizada * valor_base;
                let valor_extra = parseFloat(ingredientes[k]['com_valor_extra']);

                //set valores
                $(".ingrediente-adicionado:last").find("select").val(
                    ingredientes[k]['igr_pk_id']
                );
                $(".ingrediente-adicionado:last .valor_base").attr(
                    "value",
                    valor_base
                );
                $(".ingrediente-adicionado:last .qtde_utilizada").attr(
                    "value",
                    qtde_utilizada
                );
                $(".ingrediente-adicionado:last .valor_calc").attr(
                    "value",
                    valor_calc
                );
                $("#valor_extra").attr(
                    "value",
                    valor_extra
                );
            }
        }
        atualizaTotal();
    }

    function atualizaTotal() {
        total = 0;
        total += parseFloat($("#valor_extra").val());

        $(".ingrediente-adicionado .valor_calc").each(function() {
            total += parseFloat($(this).val());
        });

        // console.log(total);
        if (total) {
            $("#valor_total").attr("value", parseFloat(total));
        }
    }
</script>

</html>