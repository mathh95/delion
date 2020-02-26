<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlFornecedor.php";

    include_once MODELPATH."/fornecedor.php";

    include_once CONTROLLERPATH."/controlTipoFornecedor.php";
    
    include_once MODELPATH."/tipo_fornecedor.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle=new controlerFornecedor($_SG['link']);

    $fornecedor = $controle->select($_GET['cod'], 2);

    $controltipoFornecedor = new controlerTipoFornecedor($_SG['link']);
    $tipo_fornecedores = $controltipoFornecedor->selectAll();

    //usado para coloração customizada da página seleciona na navbar
    $arquivo_pai = basename(__FILE__, '.php');

?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <?php include VIEWPATH."/cabecalho.html" ?>

    </head>

    <body>

        <?php include_once "./header.php" ?>


        <div class="container-fluid">

            <form class="form-horizontal" id="form-cadastro-usuario" method="POST" enctype="multipart/form-data" action="../../controler/alteraFornecedor.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do Fornecedor</h3>

                            <br>

                            <small>Nome: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" value="<?=  $fornecedor->getNome(); ?>"/>

                                <input class="form-control" name="cod" style="display: none;" id ="cod" type="hidden" value="<?=  $fornecedor->getPkId(); ?>"/>

                            </div>

                            <br>

                            <small>Endereço *: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-home"></i></span>

                                <input class="form-control" placeholder="Endereço" name="endereco" required autofocus id ="endereco" type="text" value="<?= $fornecedor->getTxtEndereco(); ?>">

                            </div>

                            <br>

                            <small>Referência *: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-home"></i></span>

                                <input class="form-control" placeholder="Referência" name="referencia" id ="referencia" type="text" value="<?= $fornecedor->getEndRef(); ?>">

                            </div>

                            <br>
                            
                            <small>*CNPJ</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-user"></i></span>

                                <input required class="form-control" placeholder="99.999.999/9999-99" id="cnpj" name="cnpj" type="text" value="<?= $fornecedor->getCnpj();?>">

                            </div> 

                            <br>



                            <small>*Telefone</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-phone"></i></span>

                                <input class="form-control telefone" name="telefone" type="text" minlength="15" maxlength="15" required placeholder="(45) 9999-9999" value="<?= $fornecedor->getFone();?>">
                            </div> 

                            <br>

                            <small>*Quantidade de Dias para o Vencimento</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>

                                <input required class="form-control" placeholder="Número de dias" id="qtddias" name="qtddias" value="<?= $fornecedor->getQtdDias();?>" type="number">

                            </div> 

                            <br>
                            <small>*Selecione o tipo de serviço do fornecedor.</small>
                                <select class="form-control" name="tipoFornecedor" id="tipoFornecedor">
                                    <?php
                                        foreach($tipo_fornecedores as $tipo_fornecedor){ ?>
                                                <option value="<?= $tipo_fornecedor->getPkId(); ?>" > <?= $tipo_fornecedor->getNome() ?> </option>
                                        <?php } ?>
                                </select>

                            <br>

                        </div> 

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('gerenciar_fornecedor', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                        <a href="fornecedoresLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Voltar</a>

                    </div>

                </div>

            </form>

        </div>

        

        <?php include VIEWPATH."/rodape.html" ?>

        <script type="text/javascript" src="../../js/maskedinput.js"></script>
        
        <script>


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
        
        $(document).ready(function() {
        
        var tipoFornecedor = '<?= $fornecedor->getPkTipoFornecedor() ?>';

        if(tipoFornecedor) $('#' +tipoFornecedor).attr('selected', true);
        
        });
        
        
        </script>


    </body>

</html>