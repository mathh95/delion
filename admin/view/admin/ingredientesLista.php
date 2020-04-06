<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    $_SESSION['permissaoPagina']=0;
    protegePagina();
    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    //usado para coloração customizada da página selecionada na navbar
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
        <div class="row">
            <div class="col-lg-12">
                <?php include "../../ajax/ingredientes-tabela.php";?>
            </div>
        </div>
    </div>
    <?php include VIEWPATH."/rodape.php" ?>
    <script src="../../js/alert.js"></script>

    <script type="text/javascript">

       function removeIngrediente(cod){
            msgConfirmacao('Confirmação','Deseja Realmente remover o ingrediente?',
                function(linha){
                    var url ="../../ajax/excluir-ingrediente.php?cod="+cod;
                    $.get(url, function(dataReturn) {
                        
                        if (dataReturn == 1) {
                            msgGenerico("Erro!","Não foi possível excluir o ingrediente!",2,function(){});
                        }else{
                            msgGenerico("Excluir!","Ingrediente excluido com sucesso!",1,function(){});
                            $("#status"+cod).remove();
                            
                        }
                    });  
                },
                function(){}
            );
        }
    </script>
</body>
</html>