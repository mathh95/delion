<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlAdicional.php";
    include_once MODELPATH."/adicional.php";

    include_once CONTROLLERPATH. "/controlProduto.php";
    include_once MODELPATH. "/produto.php";

    include_once CONTROLLERPATH. "/controlIngrediente.php";
    include_once MODELPATH. "/ingrediente.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle_cardapio = new controlerProduto($_SG['link']);
    $itens = $controle_cardapio->selectAll();

    //usado para coloração customizada da página selecionada na navbar
    $arquivo_pai = basename(__FILE__, '.php');

    $controle_ingrediente = new controlerIngrediente($_SG['link']);
    $ingredientes = $controle_ingrediente->selectAll();
    
    if(isset($_GET['fk_produto'])){
        $fk_produto = $_GET['fk_produto'];
        //$ingredientes_produto = $controle_ingrediente->selectByFkComposicao($fk_produto);
    }

?>

<!DOCTYPE html>

<html class="no-js" lang="pt-br">

<head>

    <?php include VIEWPATH."/cabecalho.html" ?>

</head>

<body>

    <?php include_once "./header.php" ?>

    <div class="container-fluid">

        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/businesComposicao.php">

            <div class="col-md-12">

                <h3>Composição de Produto</h3>
                
                <div class="row">

                    <div class="col-md-5">
                        <h5>Selecione o item do Cardápio:*</h5>

                        <select name="item_cardapio" id="item_cardapio" class="form-control" required>
                        <?php
                            foreach($itens as $item){ ?>
                                <option
                                    value="<?= $item->getPkId(); ?>">
                                    <?= $item->getNome() ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <br>

                <div class="row">
                    
                    <div class="col-md-12 container conjunto-ingredientes">
                    <h5>Selecione os ingredientes:*</h6>

                        <div class="col-md-12 ingrediente-adicionado" data-field_id="0">
                            
                            <div class="col-md-4">
                                <small>Ingrediente*</small>
                                <select name="ingrediente[]" id="ingrediente0" data-field_id="0" class="form-control ingrediente" autofocus required>
                                    <?php
                                    foreach($ingredientes as $ingrediente){ ?>

                                        <option 
                                            value="<?= $ingrediente->getPkId(); ?>"
                                            data-valor="<?= $ingrediente->getValor(); ?>"
                                        >
                                            <?= $ingrediente->getNome();?> (<?= $ingrediente->getUnidade() ?>) </option>

                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <small>Valor</small>
                                <div class="input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input required class="form-control valor" placeholder="0.00" name="valor[]" id="valor0" value="<?=$ingredientes[0]->getValor()?>" type="number" step="0.01" max="9999" readonly>
                                </div>
                            </div>
                                                                                
                            <div class="col-md-3">
                                <small>Quantidade Utilizada*</small>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-edit"></i></span>
                                    <input class="qtd_utilizada form-control" name="qtd_utilizada[]" id="qtd_utilizada0" data-field_id="0" required value="1" min="0" type="number" step="0.01">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <small>Valor Calculado</small>
                                <div class="input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input required class="form-control valor_calc" name="valor_calc[]" value="<?=$ingredientes[0]->getValor()?>" type="number" step="0.01" min="0.01" max="9999" data-valor_base="<?= $ingredientes[0]->getValor(); ?>" id="valor_calc0" readonly>
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
                        <small>Valor Total:</small>
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

                    if (in_array('gerenciar_fornecedor', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                    <?php } ?>

                </div>

                <div class="col-md-3">
                    <button type="reset" class="btn btn-kionux"><i class="fa fa-eraser"></i> Limpar Formulário</button>
                </div>
            </div> 
        </form>
    </div>

    </div>
                
    <?php include VIEWPATH."/rodape.html" ?>

</body>




<script>
    
    //select by param
    $(document).ready(function(){

        var fk = '<?= $fk_produto ?>';
        if(fk){
            $('#item_cardapio').val(fk);
        }
    });

    //Atualiza ingrediente
    $("body").on("input", "#item_cardapio", function(){
        console.log($(this).val());
    });


    //Add Ingrediente
    $("#addIngrediente").click(function() {

        //append novo
        $(".ingrediente-adicionado:last").clone().appendTo(".conjunto-ingredientes");
        $(".ingrediente-adicionado:last").find("select").val("");
        $(".ingrediente-adicionado:last").find("input").val("");

        //get id/posicao do ultimo ingrediente
        $field_id = parseInt($(".ingrediente-adicionado:last").attr("data-field_id"));
        $id_inc = 1 + $field_id;

        //reescreve identificadores do novo item
        $(".ingrediente-adicionado:last").attr("data-field_id", $id_inc);

        $(".ingrediente-adicionado:last").find("#ingrediente"+$field_id).attr(
            "id",
            "ingrediente"+$id_inc
        );
        $(".ingrediente-adicionado:last").find("#ingrediente"+$id_inc).attr(
            "data-field_id",
            $id_inc
        );

        $(".ingrediente-adicionado:last").find("#valor"+$field_id).attr(
            "id",
            "valor"+$id_inc
        );

        $(".ingrediente-adicionado:last").find("#qtd_utilizada"+$field_id).attr(
            "id",
            "qtd_utilizada"+$id_inc
        );
        $(".ingrediente-adicionado:last").find("#qtd_utilizada"+$id_inc).attr(
            "data-field_id",
            $id_inc
        );

        $(".ingrediente-adicionado:last").find("#valor_calc"+$field_id).attr(
            "id",
            "valor_calc"+$id_inc
        );

        atualizaTotal();
    });
    //Remove Ingrediente
    $(document).on('click','.rem-ingrediente', function() {
        $(this).parent('div').parent('div').remove();

        atualizaTotal();
    });

    //Atualiza ingrediente
    $("body").on("input", ".ingrediente", function(){

        $field_id = $(this).attr("data-field_id");

        $id_ingrediente = $(this).val();

        $valor_ingrediente = parseFloat($(this).find(':selected').attr("data-valor"));
        $("#valor"+$field_id).val(parseFloat($valor_ingrediente));
        $("#valor_calc"+$field_id).attr("data-valor_base", $valor_ingrediente);

        $qtd_utilizada = parseFloat($("#qtd_utilizada"+$field_id).val());

        $valor_calc = $valor_ingrediente * $qtd_utilizada;
        $("#valor_calc"+$field_id).val(parseFloat($valor_calc));

        atualizaTotal();
    });

    //Atualiza valor calculado
    $("body").on("input", ".qtd_utilizada", function(){

        $field_id = $(this).attr("data-field_id");

        $qtd_utilizada = parseFloat($(this).val());
        $valor_base = $("#valor_calc"+$field_id).attr("data-valor_base");

        $valor_calc = $valor_base * $qtd_utilizada;

        $("#valor_calc"+$field_id).val(parseFloat($valor_calc));

        atualizaTotal();
    });


    $("#valor_extra").on("input", function(){   
        atualizaTotal();
    });


    function atualizaTotal(){
        $total = 0; 
        $total += parseFloat($("#valor_extra").val());

        $(".ingrediente-adicionado .valor_calc").each(function() {
            $total += parseFloat($(this).val());
        });

        $("#valor_total").val($total);
    }

</script>

</html>