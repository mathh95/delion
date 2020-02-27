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

    $controle_cardapio=new controlerProduto($_SG['link']);
    $itens = $controle_cardapio->selectAll();

    //usado para coloração customizada da página seleciona na navbar
    $arquivo_pai = basename(__FILE__, '.php');

    $controle_ingrediente=new controlerIngrediente($_SG['link']);
    $ingredientes = $controle_ingrediente->selectAll();


?>

<!DOCTYPE html>

<html class="no-js" lang="pt-br">

    <head>

        <?php include VIEWPATH."/cabecalho.html" ?>

    </head>

    <body>

        <!--[if lt IE 8]>

        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>

        <![endif]-->

        <!-- Add your site or application content here -->

        <?php include_once "./header.php" ?>

        <div class="container-fluid">

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/businesPrecoDeCusto.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do Produto a Preço de Custo</h3>

                            <br>

                            <h5>Selecione o item do Cardápio :</h5>
                            <select name="itemCardapio" id="itemCardapio" class="form-control">
                            <?php
                                foreach($itens as $item){ ?>
                                        <option value="<?= $item->getPkId(); ?>" > <?= $item->getNome() ?> </option>
                                <?php } ?>
                            </select>

                            <br>

                            
                            <div class="container campo-ingrediente" style="height:auto; padding-left: 0px; display:flex; flex-direction:column;flex-wrap: nowrap;">
                                <div class="ingredientes-precodecusto" style="display: flex; padding: 10px;">
                                    <h6 style="width: 100px;">Selecione os ingredientes:</h6>
                                    
                                    <br>
                                    
                                    <div style="display: inline-block; margin-right:10px;">
                                        <small>Nome do Ingrediente:</small>
                                        <select name="ingredienteLista" id="ingredienteLista" class="form-control">
                                            <?php
                                                foreach($ingredientes as $ingrediente){ ?>
                                                        <option value="<?= $ingrediente->getPkId(); ?>" > <?= $ingrediente->getNome();?> (<?= $ingrediente->getUnidade() ?>) </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                
                                                <br>
                                                <div style="display: inline-block;  ">
                                                    <small>Valor do ingrediente:</small>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                                        <input required class="form-control" placeholder="Valor da unidade" id="valor" name="valor" value="1.00" type="number" step="0.01" min="1" max="9999" disabled>
                                                    </div>   
                                                </div>
                                                <br>
                                                
                                                <div style="display: inline-block;margin-right:10px;">
                                                    <small>Quantidade utilizada:</small>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fas fa-edit"></i></span>
                                                        <input class="form-control" placeholder="Ex: 100 (gramas) ou 2 (kg)" name="qtdComposicao" required autofocus id ="qtdComposicao" type="number">
                                                    </div>
                                                </div>
                                                <br>

                                                <div style="display: inline-block;  ">
                                                    <small>Valor Calculado:</small>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                                        <input required class="form-control" placeholder="Valor da unidade" id="valorCalc" name="valorCalc" value="0.00" type="number" step="0.01" min="1" max="9999" disabled>
                                                    </div>   
                                                </div>

                                                <button class="remove-button btn btn-danger" type="button" class="btn btn-danger" id="deleteIngrediente" name="deleteIngrediente" style="display: inline-block; margin-top:20px; margin-left: 10px;"><i class="glyphicon glyphicon-trash"></i></button>

                                </div>
                            
                                <div class="mini-divs">
                                    <small>Valor Extra:</small>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                                <input class="form-control" placeholder="Valor da unidade" id="valorExtra" name="valorExtra" value="0.00" type="number" step="0.01" min="0" max="9999">
                                    </div>   
                                </div>

                                <div class="mini-divs">
                                    <small>Valor Total:</small>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                                <input class="form-control" placeholder="Valor da unidade" id="valorTotal" name="valorTotal" value="0.00" type="number" step="0.01" min="0" max="9999" disabled>
                                    </div>   
                                </div>

                            </div>

                            

                            <br>

                            <br>
                            <button type="button" class="btn btn-success" id="addIngrediente" name="addIngrediente">Adicionar ingrediente</button>
                            <br><br>
                        </div>
                        <br>
                       


                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('gerenciar_fornecedor', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                    <button type="reset" class="btn btn-kionux"><i class="fa fa-eraser"></i> Limpar Formulário</button>

                    </div>

                </div>

            </form>

        </div>

        

        <?php include VIEWPATH."/rodape.html" ?>

        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

        <script>

        // $(document).ready(function() {

            
            $("#addIngrediente").click(function() {

                $('.campo-ingrediente:last').before('<div class="container campo-ingrediente" style="padding-left: 0px; display:flex; flex-direction:column;flex-wrap: nowrap;">'+
                        '<div class="ingredientes-precodecusto" style="display: flex; padding: 10px;">'+
                                        '<h6 style="width: 100px;">Selecione os ingredientes:</h6>' +
                                        
                                        '<div style="display: inline-block; margin-right:10px;">' +
                                            '<small>Nome do Ingrediente:</small>'+
                                            '<select name="ingredienteLista" id="ingredienteLista" class="form-control">'+
                                                '<?php foreach($ingredientes as $ingrediente){?>'+
                                                '<option value="<?=$ingrediente->getPkId();?>"> <?= $ingrediente->getNome();?> (<?= $ingrediente->getUnidade() ?>) </option>'+
                                                '<?php } ?>'+
                                            '</select>'+
                                        '</div>'+

                                        '<div style="display: inline-block;  ">'+
                                            '<small>Valor do ingrediente:</small>'+
                                                '<div class="input-group">'+
                                                    '<span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>'+
                                                    '<input class="form-control" placeholder="Valor da unidade" id="valor" name="valor" value="1.00" type="number" step="0.01" min="1" max="9999" disabled>'+
                                                '</div>'+   
                                        '</div>'+
                                        '<div style="display: inline-block;margin-right:10px;">'+
                                            '<small>Quantidade utilizada:</small>'+
                                                '<div class="input-group">'+
                                                    '<span class="input-group-addon"><i class="fas fa-edit"></i></span>'+
                                                    '<input class="form-control" placeholder="Ex: 100 (gramas) ou 2 (kg)" name="qtdComposicao" required autofocus id ="qtdComposicao" type="number">'+
                                                '</div>'+
                                        '</div>'+
                                        
                                        '<div style="display: inline-block;  ">'+
                                            '<small>Valor Calculado:</small>'+
                                                '<div class="input-group">'+
                                                    '<span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>'+
                                                    '<input class="form-control" placeholder="Valor da unidade" id="valorCalc" name="valorCalc" value="0.00" type="number" step="0.01" min="1" max="9999" disabled>'+
                                                '</div>'+   
                                        '</div>'+

                                        '<button class="remove-button btn btn-danger" type="button" class="btn btn-danger" id="deleteIngrediente" name="deleteIngrediente" style="display: inline-block; margin-top:20px; margin-left: 10px;" onclick=console.log("a")><i class="glyphicon glyphicon-trash"></i></button>'+

                                    '</div>'+
                                '</div>');
                                
                    
            });

            $(document).on('click','#deleteIngrediente',function() {
                $(this).parent('div').remove();
            });
            

            tinymce.init({selector: 'textarea', plugins: [

                'advlist autolink lists link image charmap print preview hr anchor pagebreak',

                'searchreplace wordcount visualblocks visualchars code fullscreen',

                'insertdatetime media nonbreaking save table contextmenu directionality',

                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'

                ],

                toolbar1: 'undo redo | insert | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link |  forecolor backcolor '

            });

        </script>

    </body>

</html>