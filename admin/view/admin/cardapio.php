<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlProduto.php";

    include_once MODELPATH."/produto.php";

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

    $controleTurnos = new controlerProdutoTurno($_SG['link']);

    $turnos = $controleTurnos->selectAll();

    $controleHoras = new controlerProdutoHoras($_SG['link']);

    $horas = $controleHoras->selectAll();

    //usado para coloração customizada da página seleciona na navbar
    $arquivo_pai = basename(__FILE__, '.php');
    
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

        <?php include_once "./header.php" ?>


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

                                        echo "<option value='".$categoria->getPkId()."'>".$categoria->getNome()."</option>";

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
                            
                            <small>Informar se após o cadastro o item estará disponivel para ser Servido:</small>

                                <div class="checkbox">

                                    <label>

                                            <input type="checkbox" id="servindo" name="servindo" value="1">Servindo                               
                                    
                                    </label>

                                </div>

                            <small>Dias em que o Item Estará Disponível:</small>

                                <div class="checkbox">
                                    <!-- Não abre no domingo, logo não precisa aparecer na lista -->

                                    <!-- Domingo -->
                                    <label>
                                        <input type="checkbox" id="domingo" name="dias[]" value="1"/>Dom &nbsp;
                                    </label>
                                    <!-- Segunda -->
                                    <label>
                                        <input type="checkbox" id="segunda" name="dias[]" value="2"/>Seg &nbsp;
                                    </label>
                                    <!-- Terça -->
                                    <label>
                                        <input type="checkbox" id="terca" name="dias[]" value="3"/>Ter &nbsp;                             
                                    </label>
                                    <!-- Quarta -->
                                    <label>
                                        <input type="checkbox" id="quarta" name="dias[]" value="4"/>Qua &nbsp;
                                    </label>
                                    <!-- Quinta -->
                                    <label>
                                        <input type="checkbox" id="quinta" name="dias[]" value="5"/>Qui &nbsp;                              
                                    </label>
                                    <!-- Sexta -->
                                    <label>
                                        <input type="checkbox" id="sexta" name="dias[]" value="6"/>Sex &nbsp;
                                    </label>
                                    <!-- Sábado -->
                                    <label>
                                        <input type="checkbox" id="sabado" name="dias[]" value="7"/>Sáb  &nbsp;                             
                                    </label>

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

