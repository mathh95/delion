<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlTipoFornecedor.php";
    
    include_once MODELPATH."/tipo_fornecedor.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controltipoFornecedor = new controlerTipoFornecedor($_SG['link']);
    $tipo_fornecedores = $controltipoFornecedor->selectAll();

    //usado para coloração customizada da página selecionada na navbar
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
            <form class="form-horizontal" id="form-cadastro-cupom" method="POST" action="../../controler/businesFornecedor.php">
            <!-- <form class="form-horizontal"> -->
                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Cadastro de Fornecedor</h3>

                            <br>

                            <small>*Nome: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-user"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text">

                            </div>

                            <br>


                            <small>Endereço *: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-home"></i></span>

                                <input class="form-control" placeholder="Endereço" name="endereco" required autofocus id ="endereco" type="text">

                            </div>

                            <br>

                            <small>Referência *: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-home"></i></span>

                                <input class="form-control" placeholder="Referência" name="referencia" type="text">

                            </div>

                            <br>

                            <small>*CNPJ</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-user"></i></span>

                                <input required class="form-control" placeholder="99.999.999/9999-99" id="cnpj" name="cnpj" type="text">

                            </div> 

                            <br>



                            <small>*Telefone</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-phone"></i></span>

                                <input class="form-control telefone" name="telefone" type="text" minlength="15" maxlength="15" required placeholder="(45) 9999-9999">
                            </div> 

                            <br>

                            <small>*Quantidade de Dias para o Vencimento</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>

                                <input required class="form-control" placeholder="Número de dias" id="qtddias" name="qtddias" value="1" type="number">

                            </div> 

                            <br>
                                <small>*Selecione o tipo de serviço do fornecedor.</small>
                                <select class="form-control" name="tipoFornecedor" id="tipoFornecedor">
                                    <?php
                                        foreach($tipo_fornecedores as $tipo_fornecedor){
                                            if($tipo_fornecedor->getFlag_ativo() == 1) { ?>
                                                <option value="<?= $tipo_fornecedor->getPkId(); ?>" > <?= $tipo_fornecedor->getNome() ?> </option>
                                        <?php }
                                        }?>
                                </select>

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

                            <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o" onclick="confereSenha();"></i> Salvar</button>

                        <?php } ?>

                        </div>

                        <div class="pull-right">

                            <button type="reset" class="btn btn-kionux"><i class="fa fa-eraser"></i> Limpar Formulário</button>

                        </div>
                        

                    </div>

                </div>

            </form>

        </div>

        

        <?php include VIEWPATH."/rodape.php" ?>


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