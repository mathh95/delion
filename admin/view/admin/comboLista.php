<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once HOMEPATH."home/controler/controlCombo.php";
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
                                <li class="dropdown">
                                    <a href="pedidoLista.php">Pedido</a>
                                </li>
                                <li class="dropdown active">
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
                                    </ul>
   
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
                    <label>Valor mínimo do combo </label>
                    <?php $controlCombo= new controlerCombo($_SG['link']);
                          $minimo = $controlCombo->selectMinCombo();
                    ?>
                    <input id="combo" class="form-control" type="number" required placeholder="Valor mínimo de produtos combo" value="<?php echo $minimo; ?>">
                </div>
                <div class="medium-divs" style="padding-top:25px">
                    <button class="btn btn-kionux" onClick="alterarMinimo()"> Salvar </button>
                </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php include "../../ajax/combo-tabela.php"; ?>
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
        function alterarMinimo(){
            var minimo = $("#combo").val();
            var url = '../../controler/alteraMinimoCombo.php';
            $.ajax({
                type: 'POST',

                url: url,

                data: {minimo:minimo},

                success:function(res){
                    if (res > 0) {
                            msgRedireciona("Sucesso!","Alterado!",1,"../../view/admin/comboLista.php" );
                        }else{
                            msgGenerico("Erro!","Não foi possível alterar!",2,function(){});
                        }
                }
            });
        }
    </script>
</body>
</html>