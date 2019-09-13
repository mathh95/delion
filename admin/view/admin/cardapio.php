<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlCardapio.php";

    include_once MODELPATH."/cardapio.php";

    include_once CONTROLLERPATH."/controlCategoria.php";

    include_once CONTROLLERPATH."/controlAdicional.php";

    include_once MODELPATH."/categoria.php";

    include_once MODELPATH."/adicional.php";

    include_once CONTROLLERPATH."/controlCardapioHoras.php";


    include_once CONTROLLERPATH."/controlCardapioTurno.php";

    include_once MODELPATH."/cardapio_horas.php";

    include_once MODELPATH."/cardapio_turno.php";


    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controleAdicional = new controlerAdicional($_SG['link']);

    $adicionais = $controleAdicional->selectAll();

    $controleCategoria = new controlerCategoria($_SG['link']);

    $categorias = $controleCategoria->selectAll();

    $controleTurnos = new controlerCardapioTurno($_SG['link']);

    $turnos = $controleTurnos->selectAll();

    $controleHoras = new controlerCardapioHoras($_SG['link']);

    $horas = $controleHoras->selectAll();




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

                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Adicional <span class="caret"></span></a>

                                        <ul class="dropdown-menu">

                                            <li><a href="adicional.php">Cadastro</a></li>

                                            <li><a href="adicionalLista.php">Listar</a></li>
                                            
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
                                            <li><a href="formaPgt.php">Cadastro</a></li>
                                            <li><a href="formaPgtLista.php">Listar</a></li>
                                        </ul>
                                    </li> 
   

                                </ul>

                            </div><!--/.nav-collapse -->

                            <div>

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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/businesCardapio.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do item do cardápio</h3>

                            <br>

                            <small>Nome: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text">

                            </div>

                            <br>
                            
                            <small>Preço: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Preço" name="preco" required autofocus id="preco" type="number" step="0.01" min="1" max="99">

                            </div>

                            <br>

                             <small>Desconto: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Desconto" name="desconto" required autofocus id="desconto" type="number" step="0.01" min="1" max="99">

                            </div>

                            <br>

                            <small>Categoria: </small>

                            <select class="form-control" name="categoria" id="categoria" >

                                <option value="0">Não informado</option>

                                <?php

                                    foreach ($categorias as $categoria) {

                                        echo "<option value='".$categoria->getCod_categoria()."'>".$categoria->getNome()."</option>";

                                    }  

                                ?>

                            </select>

                            <!-- </br> -->

                            <small>Informar se o item está ativo:</small>

                            <div class="checkbox">

                                <label>

                                    <input type="checkbox" id="ativo" name="flag_ativo" value="1">Ativo

                                </label>

                            </div>

                            <small>Informar se o item está marcado como prioridade:</small>

                            <div class="checkbox">

                                <label>

                                        <input type="checkbox" id="prioridade" name="prioridade" value="1">Prioridade                               
                                
                                </label>

                            </div>

                            <small>Informar se o item está disponível para delivery:</small>

                            <div class="checkbox">

                                <label>

                                        <input type="checkbox" id="delivery" name="delivery" value="1">Delivery                               
                                
                                </label>

                            </div>

                            <small>Dias em que o Item Estará Disponível:</small>

                                <div class="checkbox">
                                    <!-- Não abre no domingo, logo não precisa aparecer na lista -->

                                    <!-- Segunda -->
                                    <label>
                                        <input type="checkbox" id="segunda" name="1dia" value="segunda"/>Seg &nbsp;
                                    </label>
                                    <!-- Terça -->
                                    <label>
                                        <input type="checkbox" id="terca" name="2dia" value="terca"/>Ter &nbsp;                             
                                    </label>
                                    <!-- Quarta -->
                                    <label>
                                        <input type="checkbox" id="quarta" name="3dia" value="quarta"/>Qua &nbsp;
                                    </label>
                                    <!-- Quinta -->
                                    <label>
                                        <input type="checkbox" id="quinta" name="4dia" value="quinta"/>Qui &nbsp;                              
                                    </label>
                                    <!-- Sexta -->
                                    <label>
                                        <input type="checkbox" id="sexta" name="5dia" value="sexta"/>Sex &nbsp;
                                    </label>
                                    <!-- Sábado -->
                                    <label>
                                        <input type="checkbox" id="sabado" name="6dia" value="sabado"/>Sáb  &nbsp;                             
                                    </label>
                                    <!-- Domingo -->
                                    <!-- <label>
                                        <input type="checkbox" id="diaDom" name="diaDom" value="7"/>Dom                               
                                    </label> -->

                                </div>
                            
                                <small>Turno(s) que o item estará disponível:</small>
                                
                                <div class="checkbox">
                                        <!-- Primeiro Turno -->
                                                <select name="turnos" id="turnos">
                                                    <option value="0">Selecione o turno</option>
                                                    <?php
                                                        foreach ($turnos as $turno) {
                                                            echo "<option value='".$turno->getCod_cardapio_turno()."'>".$turno->getNome()."</option>";
                                                        }  
                                                    ?>
                                                </select>
                                            &nbsp;&nbsp;&nbsp;
                                            <select name="horario1" id="horario1">
                                                        <option value="0">Início</option>

                                                        <?php
                                                        foreach ($horas as $hora) {
                                                            $horaform = date_create($hora->getHorario());
                                                            $horaform1 = date_format($horaform, 'H:i');
                                                            echo "<option value='".$hora->getCod_cardapio_horas()."'>".$horaform1."</option>";
                                                        }  
                                                    ?>
                                            </select>&nbsp;


                                            <select name="horario2" id="horario2">
                                                        <option value="">Fim</option>

                                                    <?php
                                                        foreach ($horas as $hora) {
                                                            $horaform = date_create($hora->getHorario());
                                                            $horaform2 = date_format($horaform, 'H:i');
                                                            echo "<option value='".$hora->getCod_cardapio_horas()."'>".$horaform2."</option>";
                                                        }  
                                                    ?>
                                            </select>
                                            <br><br>
                            </div>
                            <br>
                            
                            <small>Quais adicionais estarão disponiveis para esse produto:</small>

                            <input type="hidden" value="<?=count($adicionais)?>" name="quantidadeAdicionais">

                            <br>

                            <?php $i = 1; foreach($adicionais as $adicional){ ?>

                                <input type="checkbox" name="<?=$i?>adicional" value="<?=$adicional->getCod_adicional()?>"><?=$adicional->getNome()?>
                                <br>

                            <?php $i++; } ?>

                            <br>

                            <small>Foto: <span style="color:red">(Utilizar uma imagem no tamanho 525[largura] x 320[altura]. Formato (.png) ou (.jpg).)</span></small>

                            <br>

                            <input type="file" name="arquivo">

                            <br>

                            <small>Descrição do item: </small>

                            <textarea name="descricao" rows="12"></textarea>

                            <br>

                        </div>

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('cardapio', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                    <button type="reset" class="btn btn-kionux"><i class="fa fa-eraser"></i> Limpar Formulário</button>

                    </div>

                </div>

            </form>

        </div>

        <footer>

            <div class="col-md-12">

                <div class="row">

                    <img src="../../img/Kionux_1.jpg" class="img-responsive" alt="" />

                </div>

            </div>

        </footer>

        <?php include VIEWPATH."/rodape.html" ?>

        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>

            tinymce.init({selector: 'textarea', plugins: [

                'advlist autolink lists link image charmap print preview hr anchor pagebreak',

                'searchreplace wordcount visualblocks visualchars code fullscreen',

                'insertdatetime media nonbreaking save table contextmenu directionality',

                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'

                ],

                toolbar1: 'undo redo | insert | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link |  forecolor backcolor '

            });

                $('[name="1turno"]').on('change', function() {
                    $('#select1').toggle(this.checked);
                    }).change();
                $('[name="1turno"]').on('change', function() {
                    $('#select11').toggle(this.checked);
                    }).change();

                $('[name="2turno"]').on('change', function() {
                    $('#select2').toggle(this.checked);
                    }).change();
                $('[name="2turno"]').on('change', function() {
                    $('#select22').toggle(this.checked);
                    }).change();

                $('[name="3turno"]').on('change', function() {
                    $('#select3').toggle(this.checked);
                    }).change();
                $('[name="3turno"]').on('change', function() {
                    $('#select33').toggle(this.checked);
                    }).change();

        </script>

    </body>

</html>

