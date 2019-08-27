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

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controleCategoria = new controlerCategoria($_SG['link']);

    $categorias = $controleCategoria->selectAll();

    $controle = new controlerCardapio($_SG['link']);

    $cardapio = $controle->selectSemCategoria($_GET['cod'], 2);

    $adicionalObj = json_decode($cardapio->getAdicional());

    $controleAdicional = new controlerAdicional($_SG['link']);

    $adicionais = $controleAdicional->selectAll();



           
        $dias_semana = json_decode($cardapio->getDias_semana());
        // echo '<pre>';
        // print_r($dias_semana);
        // echo '</pre>';
            $d="[";

        foreach ($dias_semana as $dias) {

            $d.='"'.$dias.'",';

        }

        $d.="]";
    
        $turnos_semana = json_decode($cardapio->getTurnos_semana());

        $t="[";

        foreach ($turnos_semana as $turnos) {

            $t.='"'.$turnos.'",';

        }

        $t.="]";
    // echo '<pre>';
    // print_r($adicionais);
    // echo '</pre>';
    // exit;
    
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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alteraCardapio.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do item do cardápio</h3>

                            <br>

                            <small>Nome: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" value="<?= $cardapio->getNome();?>">

                                <input class="form-control" name="cod" id ="cod" type="hidden" value="<?= $cardapio->getCod_cardapio();?>">

                                <input class="form-control" name="imagem" id ="imagem" type="hidden" value="<?= $cardapio->getFoto();?>">

                            </div>

                            <br>

                            <small>Preço: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Preço" name="preco" required autofocus id="preco" type="number" step="0.01" min="1" max="99" value="<?=$cardapio->getPreco(); ?>">

                            </div>

                            <br>

                            <small>Desconto em (%): </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Desconto" name="desconto" required autofocus id="desconto" type="number" step="0.01" min="1" max="99" value="<?=$cardapio->getDesconto(); ?>">

                            </div>

                            <br>

                            <small>Categoria</small>

                            <select class="form-control" name="categoria" id="categoria" >

                                <option value="0">Não informado</option>

                                <?php

                                    foreach ($categorias as $categoria) {

                                        echo "<option value='".$categoria->getCod_categoria()."' id='".$categoria->getCod_categoria()."'>".$categoria->getNome()."</option>";

                                    }  

                                ?>

                            </select>

                            <br>

                            <small>Informar se o item está ativo:</small>
                                <div class="checkbox">

                                    <label>

                                        <input type="checkbox" id="ativo" <?=($cardapio->getFlag_ativo() == 1)?"checked":""?> name="flag_ativo" value="1">Ativo

                                    </label>

                                </div>
                            <small>Informar se o item está marcado como prioridade:</small>

                                <div class="checkbox">

                                    <label>
                                        <?php if ($cardapio->getPrioridade()==1){?>
                                            <input type="checkbox" id="prioridade" name="prioridade" value="1" checked>Prioridade
                                            <?php }else{ ?>
                                            <input type="checkbox" id="prioridade" name="prioridade" value="1">Prioridade
                                          <?php }?>                                    
                                    </label>

                                </div>
                            <small>Informar se o item está disponível para delivery:</small>

                                <div class="checkbox">

                                    <label>
                                        <?php if ($cardapio->getDelivery()==1){?>
                                            <input type="checkbox" id="delivery" name="delivery" value="1" checked>Delivery
                                            <?php }else{ ?>
                                            <input type="checkbox" id="delivery" name="delivery" value="1">Delivery
                                        <?php }?>                                    
                                    </label>

                                </div>
                               

                                <small>Dias em que o Item Estará Disponível:</small>

                                <div class="checkbox">
                                    <!-- Não abre no domingo, logo não precisa aparecer na lista -->

                                    
                                    <ul>

                                        <li>

                                            <label>

                                            <input type="checkbox" id="segunda" name="1dia" value="segunda"/>Seg &nbsp;

                                            </label>

                                        </li>

                                        <li>

                                            <label>

                                            <input type="checkbox" id="terca" name="2dia" value="terca"/>Ter &nbsp; 

                                            </label>

                                        </li>

                                        <li>

                                            <label>

                                            <input type="checkbox" id="quarta" name="3dia" value="quarta"/>Qua &nbsp;

                                            </label>

                                        </li>

                                        <li>

                                            <label>

                                            <input type="checkbox" id="quinta" name="4dia" value="quinta"/>Qui &nbsp;

                                            </label>

                                        </li>

                                        <li>

                                            <label>

                                            <input type="checkbox" id="sexta"  name="5dia" value="sexta"/>Sex &nbsp;

                                            </label>

                                        </li>

                                        <li>

                                            <label>

                                            <input type="checkbox" id="sabado" name="6dia" value="sabado"/>Sáb  &nbsp; 

                                            </label>

                                        </li>

                                        
                                       

                                        </ul>
                                    <!-- <label>
                                        <input type="checkbox" id="segunda" name="dia1" value="segunda"/>Seg &nbsp;
                                    </label>
                                    
                                    <label>
                                        <input type="checkbox" id="terca" name="dia2" value="terca"/>Ter &nbsp;                             
                                    </label>
                                    
                                    <label>
                                        <input type="checkbox" id="quarta" name="dia3" value="quarta"/>Qua &nbsp;
                                    </label>
                                    
                                    <label>
                                        <input type="checkbox" id="quinta" name="dia4" value="quinta"/>Qui &nbsp;                              
                                    </label>
                                  
                                    <label>
                                        <input type="checkbox" id="sexta" name="dia5" value="sexta"/>Sex &nbsp;
                                    </label>
                                    
                                    <label>
                                        <input type="checkbox" id="sabado" name="dia6" value="sabado"/>Sáb  &nbsp;                             
                                    </label> -->
                                    <!-- Domingo -->
                                    <!-- <label>
                                        <input type="checkbox" id="diaDom" name="diaDom" value="7"/>Dom                               
                                    </label> -->

                                </div>
                            
                                <small>Turno(s) que o item estará disponível:</small>
                                
                                <div class="checkbox">
                                        <!-- Primeiro Turno -->
                                        <tbody>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <label>
                                                        <input  type="checkbox" id="turno1" name="1turno" value="turno1"/>1° Turno &nbsp; 
                                                        </label>
                                                    </td>
                                                    
                                                    <!-- Segundo Turno -->
                                                    <td>
                                                        <label>
                                                        <input type="checkbox" id="turno2" name="2turno" value="turno2"/> 2° Turno &nbsp;                              
                                                        </label>
                                                    </td>
                                                    <!-- Terceiro Turno -->
                                                    <td>
                                                        <label>
                                                        <input type="checkbox" id="turno3" name="3turno" value="turno3"/> 3° Turno &nbsp;
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label for=""></label>
                                                    </td>
                                                </tr>
                                            
                                        
                                </div>

                                        <tr>
                                            <td><br> 
                                            <select name="" style="" id="select1">
                                                        <option value="">08:00</option>
                                                        <option value="">08:30</option>
                                                        <option value="">09:00</option>
                                                        <option value="">09:30</option>
                                                        <option value="">10:00</option>
                                                        <option value="">10:30</option>
                                                        <option value="">11:00</option>
                                                        <option value="">11:30</option>
                                            </select><br><br>
                                            <select name="" style="" id="select11">
                                                        <option value="">08:00</option>
                                                        <option value="">08:30</option>
                                                        <option value="">09:00</option>
                                                        <option value="">09:30</option>
                                                        <option value="">10:00</option>
                                                        <option value="">10:30</option>
                                                        <option value="">11:00</option>
                                                        <option value="">11:30</option>
                                            </select></td>

                                            <td><br>
                                            <select name="" style="" id="select2">
                                                        <option value="">12:00</option>
                                                        <option value="">12:30</option>
                                                        <option value="">13:00</option>
                                            </select><br><br>
                                            <select name="" style="" id="select22">
                                                        <option value="">12:00</option>
                                                        <option value="">12:30</option>
                                                        <option value="">13:00</option>
                                            </select>
                                            </td>
                                            
                                            <td><br>
                                            <select name="" style="" id="select3">
                                                        <option value="">17:00</option>
                                                        <option value="">17:30</option>
                                                        <option value="">18:00</option>
                                            </select><br><br>
                                            <select name="" style="" id="select33">
                                                        <option value="">17:00</option>
                                                        <option value="">17:30</option>
                                                        <option value="">18:00</option>
                                            </select>
                                            </td>
                                        </tr>
                                </table>
                                </tbody>
                                
                            <br>

                            <small>Quais são os adicionais disponiveis para este produto:</small>

                            <input type="hidden" value="<?=count($adicionais)?>" name="quantidadeAdicionais">

                            <br>
                            
                            <div>
                            
                                <ul>

                                    <?php $i = 1; foreach($adicionais as $adicional):?>

                                        <li>
                                            
                                            <?php 
                                                if(!empty($adicionalObj)){
                                                    if(in_array($adicional->getCod_adicional(), $adicionalObj)){
                                                        echo "<input checked type='checkbox' name='".$i."adicional' value='".$adicional->getCod_adicional()."'>".$adicional->getNome();
                                                    }else{
                                                        echo "<input type='checkbox' name='".$i."adicional' value='".$adicional->getCod_adicional()."'>".$adicional->getNome();
                                                    }
                                                }else{
                                                    echo "<input type='checkbox' name='".$i."adicional' value='".$adicional->getCod_adicional()."'>".$adicional->getNome();
                                                }
                                            ?>

                                        </li>

                                    <?php $i++; endforeach;?>

                                </ul>
                            
                            </div>

                            <small>Foto:</small>

                            <br>

                            <img src="../../<?=  $cardapio->getFoto(); ?>"  alt='' class='img-thumbnail img-responsive'/>

                            <br>

                            <small>Foto: <span style="color:red">(Utilizar uma imagem no tamanho 525[largura] x 320[altura]. Formato (.png) ou (.jpg).)</span></small>

                            <input type="file" name="arquivo" id ="arquivo">

                            <br>

                            <small>Descrição do item: </small>

                            <textarea name="descricao" rows="12"><?= html_entity_decode($cardapio->getDescricao()); ?></textarea>

                            <br>

                        </div>

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('cardapio', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

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

            var categoria =   <?=$cardapio->getCategoria()?>;

            $( document ).ready(function() {

                $('#' + categoria).attr('selected', true);

            })

            var dia =   <?=$d ?>;

            $( document ).ready(function() {

                for(let value of dia){

                    $('#' + value).attr('checked', true);

                }

            })

            var turno =   <?=$t ?>;

            $( document ).ready(function() {

                for(let value of turno){

                    $('#' + value).attr('checked', true);

                }

            })

            var ativo =   <?=$cardapio->getFlag_ativo()?>;

            // $( document ).ready(function() {

            //     if (ativo == 1) {

            //         $('#ativo').attr('checked', true);

            //     }

            // })

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