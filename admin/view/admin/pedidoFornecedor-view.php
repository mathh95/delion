<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/controlPedidoFornecedor.php";

    include_once MODELPATH."/pedido_fornecedor.php";

    include_once CONTROLLERPATH."/controlFornecedor.php";
    
    include_once MODELPATH."/fornecedor.php";

    include_once CONTROLLERPATH."/seguranca.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle = new controlerPedidoFornecedor($_SG['link']);

    $pedidoFornecedor = $controle->select($_GET['cod'], 2);

    $controltipoFornecedor = new controlerFornecedor($_SG['link']);

    $fornecedores = $controltipoFornecedor->selectAll();

    //usado para coloração customizada da página seleciona na navbar
    $arquivo_pai = basename(__FILE__, '.php');

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
            <!-- Alterar aqui, criar uma classe businesCupom -->
            <form class="form-horizontal" id="form-cadastro-cupom" method="POST" action="../../controler/alteraPedidoFornecedor.php">
            <!-- <form class="form-horizontal"> -->
                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Cadastro de Pedido p/ Fornecedor</h3>


                            <br>
                                <small>*Selecione o tipo de serviço do fornecedor.</small>
                                <select class="form-control" name="tipoFornecedor" id="tipoFornecedor">
                                    <?php
                                        foreach($fornecedores as $fornecedor){ ?>
                                                <option value="<?= $fornecedor->getPkId(); ?>" > <?= $fornecedor->getNome() ?> (<?= ($fornecedor->tipo_fornecedor) ?>) </option>
                                        <?php
                                        }?>
                                </select>

                            <br>



                            <small>*Valor:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

                                <input class="form-control" name="cod" style="display: none;" id ="cod" type="hidden" value="<?=  $pedidoFornecedor->getPkId(); ?>"/>

                                <input required class="form-control" placeholder="Valor do pedido" id="valor" name="valor" value="<?= $pedidoFornecedor->getValor();?>" type="number" step="0.01" min="1" max="9999">

                            </div>     


                            <br>
                                <small>*Selecione a forma de pagamento.</small>
                                <select class="form-control" name="tipoPagamento" id="tipoPagamento">
                                    <option value="dinheiro">Dinheiro</option>
                                    <option value="deposito">Depósito</option>
                                    <option value="debito">Débito</option>
                                    <option value="credito">Crédito</option>
                                    <option value="boleto">Boleto</option>
                                    
                                </select>

                            <br>

                            <small>*Data do Pedido:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>

                                <input required class="form-control" placeholder="" name="data_pedido_fornecedor" value="<?= $pedidoFornecedor->getDtPedido();?>" type="date">

                            </div> 

                            <br>

                            <small>*Descrição (Opcional): </small>

                            <textarea name="descricao" rows="12"><?= html_entity_decode($pedidoFornecedor->getDesc()); ?></textarea>

                            <br>

                            


                        </div>

                    </div>

                </div>

                <div class="col-md-12">

                    <div class="col-md-5" style="padding-left: 0px;">

                        <div class="pull-left">

                        <?php

                        $permissao =  json_decode($usuarioPermissao->getPermissao());

                        if (in_array('gerenciar_fornecedor', $permissao)){ ?>

                            <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o" onclick="confereSenha();"></i> Alterar</button>

                        <?php } ?>

                        </div>

                        <div class="pull-right">

                            <button type="reset" class="btn btn-kionux"><i class="fa fa-eraser"></i> Limpar Formulário</button>

                        </div>
                        

                    </div>

                </div>

            </form>

        </div>

        

        <?php include VIEWPATH."/rodape.html" ?>


        <script type="text/javascript" src="../../js/maskedinput.js"></script>
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>


        <script>


            tinymce.init({selector: 'textarea', plugins: [

            'advlist autolink lists link image charmap print preview hr anchor pagebreak',

            'searchreplace wordcount visualblocks visualchars code fullscreen',

            'insertdatetime media nonbreaking save table contextmenu directionality',

            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'

            ],

            toolbar1: 'undo redo | insert | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link |  forecolor backcolor '

            });



            $(document).ready(function(){
                $("#cnpj").mask("99.999.999/9999-99");
                });

                $("input.telefone").mask("(99) ?9 9999-9999").focusout(function (event) {  

                    var target, phone, element;  
                    target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
                    phone = target.value.replace(/\D/g, '');
                    element = $(target);  
                    element.unmask();  

                    if(phone.length > 10) {  
                        element.mask("(99) 99999-999?9");  
                    } else {  
                        element.mask("(99) 9999-9999?9");  
                    }  
                });

            function confereSenha() {

                if($("#senha1").val().length>5){

                    $("#alteraSenha").submit();

                }else{

                    alertComum('Erro!','Senhas devem conter no mínimo 6 caracteres!',2);

                }

            }
            
            function uniqId() {
                    var ts=String(new Date().getTime()), i = 0, out = '';
                        for(i=0;i<ts.length;i+=4) {        
                        out+=Number(ts.substr(i, 2)).toString(36);    
                    }
                    out = out.toUpperCase();
                return ('D'+out);
            }

            $(function () {
                    $('#gera_cod').on('click', function () {
                        var text = $('#codigo');
                        text.val(uniqId());    
                });
            });

        </script>

    </body>

</html>