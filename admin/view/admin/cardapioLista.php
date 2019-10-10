<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlCardapio.php";
    include_once CONTROLLERPATH."/controlCategoria.php";
    include_once MODELPATH."/cardapio.php";
    $_SESSION['permissaoPagina']=0;
    protegePagina();
    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);
    $controleCategoria = new controlerCategoria($_SG['link']);
    $categorias = $controleCategoria->selectAll();

    //usado para coloração customizada da página seleciona na navbar
    $arquivo_pai = basename(__FILE__, '.php');
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include VIEWPATH."/cabecalho.html" ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
    
    <?php include_once "./header.php" ?>

    <div class="container-fluid">
        <div class="searchbar">
            <div class="mini-divs"> 
                <label>Filtro por nome: </label>
                <input id="pesquisa" class="form-control" type="text" required placeholder="Nome para pesquisa">
            </div>
            <div class="mini-divs"> 
                <label> Situação </label>
                <select class="form-control" id="flag">
                    <option value=''>TODOS</option>
                    <option value='0'>INATIVO</option>
                    <option value='1'>ATIVO</option>
                </select>
            </div>
            <div class="mini-divs"> 
                <label> Em produção </label>
                <select class="form-control" id="producao">
                    <option value=''>TODOS</option>
                    <option value='0'>PAUSADO</option>
                    <option value='1'>SERVINDO</option>
                </select>
            </div>
            <div class="mini-divs"> 
                <label> Delivery </label>
                <select class="form-control" id="delivery">
                    <option value=''>TODOS</option>
                    <option value='0'>INDISPONÍVEL</option>
                    <option value='1'>DISPONÍVEL</option>
                </select>
            </div>
            <div class="mini-divs"> 
                <label> Prioridade </label>
                <select class="form-control" id="prioridade">
                    <option value=''>TODOS</option>
                    <option value='0'>NÃO PRIORITÁRIO</option>
                    <option value='1'>PRIORITÁRIO</option>
                </select>
            </div>
            <div class="mini-divs"> 
                <label> Categoria </label>
                <select class="form-control" id="categoria">
                    <option value=''>TODOS</option>
                    <?php
                    foreach ($categorias as $categoria) {
                        $nome = $categoria->getNome();
                        echo "<option value=".$nome.">".$nome."</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
            <div class="row">
                <div id="tabela-cardapio" class="col-lg-12">
                    <?php include "../../ajax/cardapio-tabela.php";?>
                </div>
            </div>
    </div>
    <?php include VIEWPATH."/rodape.html" ?>
    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
        function removeCardapio(cardapio,foto){
            msgConfirmacao('Confirmação','Deseja Realmente remover o item cardápio?',
                function(linha){
                    var url ='../../ajax/excluir-cardapio.php?cardapio='+cardapio+'&foto='+foto;
                    $.get(url, function(dataReturn) {
                        if (dataReturn > 0) {
                            msgGenerico("Excluir!","Item do cardápio excluido com sucesso!",1,function(){});
                            $("#status"+cardapio).remove();
                        }else{
                            msgGenerico("Erro!","Não foi possível excluir a cardapio!",2,function(){});
                        }
                    });  
                },
                function(){}
            );
        }
        
        $('#pesquisa,#flag,#producao,#delivery,#prioridade,#categoria').on('change paste keyup', function(){
            var nome = $("#pesquisa").val();
            var flag = $("#flag").val();
            var producao = $("#producao").val();
            var delivery = $("#delivery").val();
            var prioridade = $("#prioridade").val();
            var categoria = $("#categoria").val();
            var url = '../../ajax/cardapio-tabela.php';
            $.ajax({
                type: 'POST',

                url: url,

                data: {nome:nome, flag:flag, producao:producao ,delivery:delivery, prioridade:prioridade, categoria:categoria},

                success:function(res){
                    $("#tabela-cardapio").html(res);
                }
            });
        });
    </script>
</body>
</html>