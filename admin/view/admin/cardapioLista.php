<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlCardapio.php";
    include_once MODELPATH."/cardapio.php";
    $_SESSION['permissaoPagina']=0;
    protegePagina();
    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include VIEWPATH."/cabecalho.html" ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1>Área Administrativa <?= EMPRESA ?></h1>
                </div>
                <div class="col-md-2">
                    <div class="pull-right">
                        <h3>
                        <img src="../../img/person.png" alt="" />
                        <span>Bom dia <?php echo  $_SESSION['usuarioNome'] ?></span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="navbar" class="collapse navbar-collapse pull-left">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuários <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="usuario.php">Cadastro</a></li>
                                        <li><a href="usuariosLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empresa <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="empresa.php">Alterar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Banners <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="banner.php">Cadastro</a></li>
                                        <li><a href="bannerLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Avaliacao <span class="caret"></span></a>

                                    <ul class="dropdown-menu">

                                        <li><a href="tipoAvaliacao.php">Cadastro</a></li>

                                        <li><a href="tipoAvaliacaoLista.php">Listar</a></li>

                                        <li><a href="mediaAvaliacao.php">Médias</a></li>

                                    </ul>

                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Imagens <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="imagem.php">Cadastro</a></li>
                                        <li><a href="imagemLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Evento <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="evento.php">Cadastro</a></li>
                                        <li><a href="eventoLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categoria <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="categoria.php">Cadastro</a></li>
                                        <li><a href="categoriaLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown active">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cardápio <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cardapio.php">Cadastro</a></li>
                                        <li><a href="cardapioLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mini banner <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="miniBanner.php">Cadastro</a></li>
                                        <li><a href="miniBannerLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">    
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cliente <span class="caret"></span></a>  
                                    <ul class="dropdown-menu">                                        
                                        <li><a href="cliente.php">Cadastro</a></li>                                            
                                        <li><a href="clienteLista.php">Listar</a></li>                                        
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="pedidoLista.php">Pedido</a>
                                </li>
                                <li class="dropdown">
                                    <a href="comboLista.php">Combo</a>
                                </li>
                                <li class="dropdown">
                                        <a href="/home/avaliacao.php">Avaliar</a>
                                </li>          
                            </ul>
                        </div><!--/.nav-collapse -->
                        <div class="pull-right">
                            <h2><a href="alteraSenha.php"> ALTERAR SENHA |</a>
                            <a href="../../controler/logout.php"> SAIR &nbsp;</a></h2>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
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
        
            $('#pesquisa,#flag,#delivery,#prioridade').on('change paste keyup', function(){
            var nome = $("#pesquisa").val();
            var flag = $("#flag").val();
            var delivery = $("#delivery").val();
            var prioridade = $("#prioridade").val();
            var url = '../../ajax/cardapio-tabela.php';
            $.ajax({
                type: 'POST',

                url: url,

                data: {nome:nome, flag:flag, delivery:delivery, prioridade:prioridade},

                success:function(res){
                    $("#tabela-cardapio").html(res);
                }
            });
        });
    </script>
</body>
</html>