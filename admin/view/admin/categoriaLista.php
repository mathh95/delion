<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once CONTROLLERPATH . "/controlUsuario.php";
include_once MODELPATH . "/usuario.php";
include_once CONTROLLERPATH . "/seguranca.php";
include_once CONTROLLERPATH . "/controlCategoria.php";
include_once MODELPATH . "/categoria.php";
$_SESSION['permissaoPagina'] = 0;
protegePagina();
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

//usado para coloração customizada da página seleciona na navbar
$arquivo_pai = basename(__FILE__, '.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include VIEWPATH . "/cabecalho.html" ?>
</head>

<body>

    <?php include_once "./header.php" ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include "../../ajax/categoria-tabela.php"; ?>
            </div>
        </div>
    </div>

    <?php include VIEWPATH . "/rodape.html" ?>

    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
        function removeCategoria(categoria, icone) {
            msgConfirmacao('Confirmação', 'Deseja Realmente remover o categoria?',
                function(linha) {
                    
                    var url = '../../ajax/excluir-categoria.php?categoria=' + categoria + '&icone=' + icone;
                    
                    $.get(url, function(dataReturn) {
                        if (dataReturn > 0) {
                            msgGenerico("Excluir!", "Categoria excluído com sucesso!", 1, function() {});
                            $("#status" + categoria).remove();
                        } else {
                            msgGenerico("Erro!", "Não foi possível excluir a categoria!", 2, function() {});
                        }
                    });
                },
                function() {}
            );
        }
    </script>
</body>
</html>