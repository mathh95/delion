<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    $_SESSION['permissaoPagina']=0;
    protegePagina();
    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include VIEWPATH."/cabecalho.html" ?>
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
                                <li class="dropdown ">
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
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cardápio <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cardapio.php">Cadastro</a></li>
                                        <li><a href="cardapioLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">

                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Adicional <span class="caret"></span></a>

                                        <ul class="dropdown-menu">

                                            <li><a href="adicional.php">Cadastro</a></li>

                                            <li><a href="adicionalLista.php">Listar</a></li>
                                            
                                        </ul>

                                </li>   
                                <li class="dropdown ">
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
                                <li class="dropdown active ">
                                    <a href="pedidoLista.php">Pedido</a>
                                </li>
                                <li class="dropdown">
                                    <a href="comboLista.php">Combo</a>
                                </li>
                                <li class="dropdown">
                                    <a href="/home/avaliacao.php">Avaliar</a>
                                </li>
                                <li class="dropdown">
                                    <a href="enderecoLista.php">Endereços</a>
                                </li>
                                <li class="dropdown">
                                    <!--/.Mudar aqui -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pedidos Whatsapp <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="pedidoWpp.php">Novo Pedido</a></li>
                                        <li><a href="pedidoWppLista.php">Listar Pedidos</a></li>
                                        <li><a href="clienteListaWpp.php">Listar Clientes Whatsapp</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cupom<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cupom.php">Cadastro</a></li>
                                        <li><a href="cupomLista.php">Listar Cupons</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Formas de Pagamento<span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="adicional.php">Cadastro</a></li>
                                            <li><a href="adicionalLista.php">Listar</a></li>
                                        </ul>
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
                    <div class="medium-divs"> 
                        <label>Filtro por nome do cliente: </label>
                        <input id="pesquisa" class="form-control" type="text" placeholder="Nome para pesquisa">
                    </div>
                    <div class="mini-divs"> 
                        <label>Menor valor do pedido: </label>
                        <input id="menor" class="form-control" type="number" placeholder="">
                    </div>
                        
                    <div class="mini-divs"> 
                        <label>Maior valor do pedido: </label>
                        <input id="maior" class="form-control" type="number" placeholder="">
                    </div>
                    <div class="medium-divs"> 
                        <label>Filtro por rua, CEP ou número do endereço: </label>
                        <input id="endereco" class="form-control" type="text" placeholder="Rua, CEP ou número para pesquisa">
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-12" id="tabela-pedido">
                    <?php include "../../ajax/pedido-tabela.php"; ?>
                </div>
            </div>
        </div>
        <?php include VIEWPATH."/rodape.html" ?>
        <script src="../../js/alert.js"></script>
        <script type="text/javascript">
            function alterarStatus(pedido,status){
                msgConfirmacao('Confirmação','Deseja Realmente alterar o status do pedido?',
                    function(linha){
                        var url ='../../ajax/alterar-pedido.php?pedido='+pedido+'&status='+status;
                        $.get(url, function(dataReturn) {
                            if (dataReturn > 0) {
                                msgRedireciona("Sucesso!","Status de pedido alterado!",1,"../../view/admin/pedidoLista.php" );
                            }else{
                                msgGenerico("Erro!","Não foi possível alterar o status do pedido!",2,function(){});
                            }
                        });  
                    },
                    function(){}
                );
            }

            $('#pesquisa, #menor, #maior, #endereco').on('change paste keyup', function(){
            var nome = $("#pesquisa").val();
            var menor = $("#menor").val();
            var maior = $("#maior").val();
            var endereco = $("#endereco").val();
            if (menor == ''){
                menor = 0;
            }
            if ( maior == ''){
                maior = 999999;
            }
            var url = '../../ajax/pedido-tabela.php';
            $.ajax({
                type: 'POST',

                url: url,

                data: {nome:nome, menor:menor, maior:maior, endereco:endereco},

                success:function(res){
                    $("#tabela-pedido").html(res);
                }
            });
        });
        </script>
    </body>
    </html>