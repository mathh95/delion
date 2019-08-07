<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

include_once CONTROLLERPATH . "/controlUsuario.php";

include_once MODELPATH . "/usuario.php";

include_once CONTROLLERPATH . "/seguranca.php";

$_SESSION['permissaoPagina'] = 0;

protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);

$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);


?>

<!DOCTYPE html>

<html class="no-js" lang="pt-br">

<head>

    <?php include VIEWPATH . "/cabecalho.html" ?>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
	    crossorigin="anonymous">

</head>

<body>

    <!--[if lt IE 8]>

        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>

        <![endif]-->

    <!-- Add your site or application content here -->

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
                                <li class="dropdown ">
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
                                <li class="dropdown">
                                    <a href="enderecoLista.php">Endereços</a>
                                </li>
                                <li class="dropdown active ">
                                    <!--/.Mudar aqui -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pedidos Whatsapp <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="pedidoWpp.php">Novo Pedido</a></li>
                                        <li><a href="pedidoWppLista.php">Listar Pedidos</a></li>
                                        <li><a href="clienteListaWpp.php">Listar Clientes Whatsapp</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

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

        <form class="form-horizontal" id="form-cadastro-cliente" method="post" action="../../controler/businesClienteWpp.php">

            <div class="col-md-12">

                <h3>Dados do Pedido</h3>

                <div class="row">

                    <div class="col-md-6">

                        <small>Nome do Cliente:</small>

                        <br>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                            <input class="form-control" placeholder="Nome do Cliente" name="nome" value="" required autofocus type="text">

                        </div>

                        <br>

                    </div>

                    <div class="col-md-6">

                        <small>Telefone do Cliente:</small>

                        <br>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>

                            <input class="form-control" placeholder="Telefone" name="telefone" value="" type="number" onkeydown="return event.keyCode !== 69">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <small>Rua</small>

                        <br>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="glyphicon glyphicon-pushpin"></i></span>

                            <input class="form-control" placeholder="Rua" name="rua" value="" required autofocus type="text">

                        </div>

                        <br>

                    </div>

                    <div class="col-md-6">

                        <small>Número</small>

                        <br>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="glyphicon glyphicon-pushpin"></i></span>

                            <input class="form-control" placeholder="Número" name="numero" value="" size="4" type="number" onkeydown="return event.keyCode !== 69">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        
                        <small>Bairro</small>

                        <br>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="glyphicon glyphicon-pushpin"></i></span>

                            <input class="form-control" placeholder="Bairro" name="bairro" value="" required autofocus type="text">

                        </div>

                        <br>

                    </div>

                    <div class="col-md-6">

                        <small>Complemento</small>

                        <br>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="glyphicon glyphicon-pushpin"></i></span>

                            <input class="form-control" placeholder="Complemento" name="complemento" value="" type="text">

                        </div>

                    </div>

                </div>

<!--                 <div class="row">

                    <h3>Formas de Pagamento</h3>

                <div class="row" -->

                    <div class="col-md-12">

                        <h3>Pedido</h3>

                        <table id="table-pedido" class="table table-responsive">
                            <thead>
                                <td><b>Excluir</b></td>
                                <td><b>Produto</b></td>
                                <td><b>Preço Unitário</b></td>
                                <td><b>Subtotal</b></td>
                                <td><b>Quantidade</b></td>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <h3 id="valor-total" style="float:right;">Valor Total: R$ <span>0</span></h3>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-5" style="padding-left: 0px;">
                            <!-- Alterar a função onClick -->
                            <div class="pull-left">
                                <?php
                                $permissao =  json_decode($usuarioPermissao->getPermissao());
                                if (in_array('pedidoWpp', $permissao)) { ?>
                                    <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o" onclick="confereSenha();"></i> Salvar</button>
                                <?php } ?>
                            </div>
                            <div class="pull-right">
                                <button type="reset" class="btn btn-kionux"><i class="fa fa-eraser btn iconeRemProduto"></i> Limpar Formulário</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>

        <div class="row">

            <div class="col-md-12">

                <h3>Cardápio</h3>

            </div>
        </div>

        
        <div class="row">
            <div class="container-fluid">
                <div class="searchbar">
                    <div class="mini-divs">
                        <label>Filtro por nome: </label>
                        <input id="pesquisa" class="form-control" type="text" placeholder="Nome para pesquisa">
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
                                echo "<option value=" . $nome . ">" . $nome . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div id="tabela-cardapio" class="col-lg-12">
                <?php include "../../ajax/cardapioWpp-tabela.php"; ?>
            </div>
        </div>
    </div>

    <footer>
        <div class="col-md-12">
            <div class="row">
                <img src="../../img/Kionux_1.jpg" class="img-responsive" alt="" />
            </div>
        </div>
    </footer>

    <?php include VIEWPATH . "/rodape.html" ?>
    <script type="text/javascript">
        $('#pesquisa,#flag,#prioridade,#categoria').on('change paste keyup', function() {
            var nome = $("#pesquisa").val();
            var flag = $("#flag").val();
            var prioridade = $("#prioridade").val();
            var categoria = $("#categoria").val();
            var url = '../../ajax/cardapioWpp-tabela.php';
            $.ajax({
                type: 'POST',

                url: url,

                data: {
                    nome: nome,
                    flag: flag,
                    prioridade: prioridade,
                    categoria: categoria
                },

                success: function(res) {
                    $("#tabela-cardapio").html(res);
                }
            });
        });
        
        function buildPedidoTableRow(id){
            return $(' \
            <tr data-id='+id+'> \
                <td class="excluir"> \
                    <i data-toggle="tooltip" class="fas fa-trash-alt btn iconeRemProduto"></i>\
                </td> \
                <td class="nome"> \
                </td> \
                <td class="valor"> \
                </td> \
                <td class="sub-total"> \
                </td> \
                <td class="qtd"> \
                    <i data-toggle="tooltip" class="fas fa-minus-circle btn iconeDecProduto"></i>\
                    <span></span>\
                    <i data-toggle="tooltip" class="fas fa-plus-circle btn iconeIncProduto"></i>\
                </td> \
            </tr>')
        }

        function updatePedidoTable() {
            let url = '../../ajax/atualiza-CarrinhoWpp.php';
            let total = 0;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(res) {
                    $("#table-pedido tbody")[0].innerHTML = ""
                    res = JSON.parse(res);
                    
                    for(let item in res){
                        let table_row = buildPedidoTableRow(item);
                        table_row.find('.nome').text(res[item].nome);
                        table_row.find('.valor').text( "R$ " + (res[item].valor));
                        table_row.find('.sub-total').text( "R$ " + ((res[item].valor * res[item].qtd).toFixed(2))); //Arredondamento
                        table_row.find('.qtd span').text(res[item].qtd);
                        $("#table-pedido tbody").append(table_row);
                        
                        total += res[item].valor * res[item].qtd;
                    }
                    totalCorreto=(total.toFixed(2));

                    $('#valor-total span').text(totalCorreto); //Mudar aqui o arredondamento
                }
            });
        }

        $(document).on('click', '.btn-add', function() {
            var url = '../../ajax/atualiza-CarrinhoWpp.php';
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    cod_produto: $(this).data("id"),
                    op: "inc",
                },
                success: function(res) {
                    updatePedidoTable();
                }
            });
        })

        $(document).on('click', '.iconeRemProduto', function() {
            var url = '../../ajax/atualiza-CarrinhoWpp.php';
            $.ajax({
                type: 'DELETE',
                url: url,
                data: {
                    cod_produto: $(this).parent().parent().data("id"),
                },
                success: function(res) {
                    updatePedidoTable();
                }
            });
        })
        
        $(document).on('click', '.iconeRem', function() {
            var url = '../../ajax/atualiza-CarrinhoWpp.php';
            $.ajax({
                type: 'DELETE',
                url: url,
                data: {
                    cod_produto: $(this).parent().parent().data("id"),
                },
                success: function(res) {
                    updatePedidoTable();
                }
            });
        })
        

        $(document).on('click', '.iconeDecProduto', function() {
            var url = '../../ajax/atualiza-CarrinhoWpp.php';
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    cod_produto: $(this).parent().parent().data("id"),
                    op: 'dec',
                },
                success: function(res) {
                    updatePedidoTable();
                }
            });
        })

        $(document).on('click', '.iconeIncProduto', function() {
            var url = '../../ajax/atualiza-CarrinhoWpp.php';
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    cod_produto: $(this).parent().parent().data("id"),
                    op: 'inc',
                },
                success: function(res) {
                    updatePedidoTable();
                }
            });
        })

        $(document).on('click','.btn-print', function() { //class='btn btn-kionux btn-add'
            dt = new Date();

            console.log(dt.getTime());
            $.ajax({
                url: '../../ajax/pedidoWpp-tabela.php',
                type: 'POST',
                data: {
                    cod_produto: $(this).parent().parent().data("id"),
                    ts: dt.getTime()
                },
            })
            .done(function() {
                console.log("success");
            })
            .fail(function() {
                console.log("error");
            })
            
        })
        
        updatePedidoTable()
    </script>

</body>

</html>