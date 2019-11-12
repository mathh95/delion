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

    include_once CONTROLLERPATH."/controlCardapioHoras.php";

    include_once CONTROLLERPATH."/controlCardapioTurno.php";

    include_once MODELPATH."/cardapio_horas.php";

    include_once MODELPATH."/cardapio_turno.php";

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

    $controleTurnos = new controlerCardapioTurno($_SG['link']);
    $turnos = $controleTurnos->selectAll();

    $controleHoras = new controlerCardapioHoras($_SG['link']);
    $horasini = $controleHoras->selectAll();

    $controleHoras = new controlerCardapioHoras($_SG['link']);
    $horasfim = $controleHoras->selectAll();

    //usado para coloração customizada da página seleciona na navbar
    $arquivo_pai = basename(__FILE__, '.php');
    
    $dias_semana = $cardapio->getDias_semana();
    
    // echo '<pre>';
    // print_r($cardapio);
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

        <?php include_once "./header.php" ?>

        
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
                                                            echo "<option value='".$turno->getCod_cardapio_turno()."' id='".$turno->getCod_cardapio_turno()."'>".$turno->getNome()."</option>";
                                                        }  
                                                    ?>
                                                </select>
                                            &nbsp;&nbsp;&nbsp;
                                            <select name="horario1" id="horario1">
                                                        <option value="0">Início</option>
                                                        <?php
                                                        foreach ($horasini as $hora) {
                                                            $horaform = date_create($hora->getHorario());
                                                            $horaform1 = date_format($horaform, 'H:i');
                                                            echo "<option value='".$hora->getCod_cardapio_horas()."' id='horaini".$hora->getCod_cardapio_horas()."'>".$horaform1."</option>";
                                                        }  
                                                    ?>
                                            </select>&nbsp;



                                            <select name="horario2" id="horario2">
                                                        <option value="0">Fim</option>
                                                    <?php
                                                        foreach ($horasfim as $hora) {
                                                            $horaform = date_create($hora->getHorario());
                                                            $horaform2 = date_format($horaform, 'H:i');
                                                            echo "<option value='".$hora->getCod_cardapio_horas()."' id='horafim".$hora->getCod_cardapio_horas()."'>".$horaform2."</option>";
                                                        }  
                                                    ?>
                                            </select>
                                            <br><br>
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
            
            $(document).ready(function() {
            var categoria = <?= $cardapio->getCategoria()?>;
            var turno = '' +<?=$cardapio->getCardapio_turno()?> + '';
            var horario1 = '' +  <?= $cardapio->getCardapio_horas_inicio()?> + '';
            var horario2 = '' + <?= $cardapio->getCardapio_horas_final()?> + '';
            var dias =  <?= $dias_semana ?>;
            var ativo =   <?= $cardapio->getFlag_ativo()?>;
            
            //dia -> 1 == domingo...7 == sábado
            for(let dia of dias){
                $(":checkbox[value="+dia+"]").prop("checked", "true");
                // $(':' + value).attr('checked', true);
            }

            if (ativo == 1){
                $('#ativo').attr('checked', true);
            }
            $('#' + categoria).attr('selected', true);
                $('#' + turno).attr('selected', true);
                $('#horaini' + horario1).attr('selected', true);
                $('#horafim' + horario2).attr('selected', true);
        })
        
            

            </script>

    </body>

</html>