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

<html class="no-js" lang="pt-br">

    <head>

        <?php include VIEWPATH."/cabecalho.html" ?>

    </head>

    <body>

        <?php include_once "./header.php" ?>    


        <div class="container">
            <div class="row">
                <div style="margin-top:100px;" class="col-md-12 text-center">
                    <h1>Bom dia, <?=$_SESSION['usuarioNome']?>! 😃☕</h1>
                    <h3>“O verdadeiro heroísmo consiste em persistir por mais um momento, quando tudo parece perdido”. <br>(W. F. Grenfel)</h3>
                </div>    
            </div>  
        </div>

        

        <?php include VIEWPATH."/rodape.html" ?>

    </body>

    <script>

        $(document).ready(function() {

            var dias = '<?= $empresa->getArrDiasSemana(); ?>';
            dias = JSON.parse(dias);
            
            //dia -> 1 == domingo...7 == sábado
            for(let dia of dias){
                // console.log(dia);
                $(":checkbox[value="+dia+"]").prop("checked", "true");
            }
            
        });

    </script>


</html>