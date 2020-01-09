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

    include_once CONTROLLERPATH."/controlFaixaHorario.php";



    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controleCategoria = new controlerCategoria($_SG['link']);
    $categorias = $controleCategoria->selectAll();

    $controle = new controlerProduto($_SG['link']);
    $produto = $controle->selectById($_GET['cod']);

    $adicionalObj = json_decode($produto->getAdicional());
    $controleAdicional = new controlerAdicional($_SG['link']);

    $adicionais = $controleAdicional->selectAll();
    
    $controleFaixaHorario = new controlerFaixaHorario($_SG['link']);
    
    
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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alteraProduto.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Alterar Produto</h3>

                            <br>

                            <small>Nome: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-utensils"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" value="<?= $produto->getNome();?>">

                                <input class="form-control" name="cod" id ="cod" type="hidden" value="<?= $produto->getPkId();?>">

                                <input class="form-control" name="imagem" id ="imagem" type="hidden" value="<?= $produto->getFoto();?>">

                            </div>

                            <br>

                            <small>Preço: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>

                                <input class="form-control" placeholder="Preço" name="preco" required id="preco" type="number" step="1" min="1" max="99" value="<?=$produto->getPreco(); ?>">

                            </div>

                            <br>

                            <small>Desconto em (%): </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-percentage"></i></span>

                                <input class="form-control" placeholder="Desconto" name="desconto" id="desconto" type="number" step="1" max="99" value="<?=$produto->getDesconto(); ?>">

                            </div>

                            <br>

                            <small>Categoria</small>

                            <select class="form-control" name="categoria" id="categoria" >

                                <option value="">Selecionar Categoria</option>

                                <?php

                                    foreach ($categorias as $categoria) {

                                        echo "<option value='".$categoria->getPkId()."' id='".$categoria->getPkId()."'>".$categoria->getNome()."</option>";
                                    }
                                ?>

                            </select>

                            <br>

                            <small>Informar se o item está ativo:</small>
                                <div class="checkbox">

                                    <label>

                                        <input type="checkbox" id="ativo" <?=($produto->getFlag_ativo() == 1)?"checked":""?> name="flag_ativo" value="1">Ativo

                                    </label>

                                </div>
                            <small>Informar se o item está marcado como prioridade:</small>

                                <div class="checkbox">

                                    <label>
                                        <?php if ($produto->getPrioridade()==1){?>
                                            <input type="checkbox" id="prioridade" name="prioridade" value="1" checked>Prioridade
                                            <?php }else{ ?>
                                            <input type="checkbox" id="prioridade" name="prioridade" value="1">Prioridade
                                          <?php }?>                                    
                                    </label>

                                </div>
                            <small>Informar se o item está disponível para delivery:</small>

                                <div class="checkbox">

                                    <label>
                                        <?php if ($produto->getDelivery()==1){?>
                                            <input type="checkbox" id="delivery" name="delivery" value="1" checked>Delivery
                                            <?php }else{ ?>
                                            <input type="checkbox" id="delivery" name="delivery" value="1">Delivery
                                        <?php }?>                                    
                                    </label>

                                </div>
                            
                            <small>Informar se o Produto estará disponivel para ser Servido:</small>

                                <div class="checkbox">

                                    <label>
                                        <?php if ($produto->getFlag_servindo()==1){?>
                                            <input type="checkbox" id="servindo" name="servindo" value="1" checked>Servindo
                                            <?php }else{ ?>
                                            <input type="checkbox" id="servindo" name="servindo" value="1">Servindo
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
                                            
                                <br>
                                <div class="checkbox">
                                    <select class="form-control" name="faixa_horario" id="faixa_horario">

                                        <option value="">Faixa de Horário</option>
                                        <?php
                                            $faixas_horario = $controleFaixaHorario->selectAll();
                                            foreach ($faixas_horario as $faixa) {
                                                $ini = date("H:i", strtotime($faixa->getInicio()));
                                                $final = date("H:i", strtotime($faixa->getFinal()));
                                                $txt = $ini."h - ".$final."h";
                                                echo "<option value='".$faixa->getPkId()."' id='".$faixa->getPkId()."'>".$txt."</option>";
                                            }  
                                        ?>
                                    </select>
                                    
                                    <br><br>
                                </div>
                            <br>
                            <br>

                            <small>Quais são os adicionais disponiveis para este produto:</small>

                            <input type="hidden" value="<?=count($adicionais)?>" name="quantidadeAdicionais">

                            <br>
                            
                            <div>
                            
                                <ul>

                                    <?php 
                                        $i = 1;
                                        foreach($adicionais as $adicional){
                                    ?>
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

                                    <?php $i++; }?>

                                </ul>
                            
                            </div>

                            <small>Foto:</small>

                            <br>

                            <img src="../../<?=  $produto->getFoto(); ?>"  alt='' class='img-thumbnail img-responsive'/>

                            <br>

                            <small>Foto: <span style="color:red">(Utilizar uma imagem no tamanho 525[largura] x 320[altura]. Formato (.png) ou (.jpg).)</span></small>

                            <input type="file" name="arquivo" id ="arquivo">

                            <br>

                            <small>Descrição do item: </small>

                            <textarea name="descricao" rows="12"><?= html_entity_decode($produto->getDescricao()); ?></textarea>

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

                var categoria = '<?= $produto->getCategoria() ?>';
                var faixa_horario = '<?=$produto->getFkFaixaHorario()?>';
                var dias = JSON.parse('<?= $produto->getDias_semana() ?>');
                var ativo = '<?= $produto->getFlag_ativo() ?>';
                

                //dia -> 1 == domingo...7 == sábado
                for(let dia of dias){
                    $(".checkbox :checkbox[value="+dia+"]").prop("checked", "true");
                }

                if (ativo == 1){
                    $('#ativo').attr('checked', true);
                }

                $('#' + categoria).attr('selected', true);
                $('#' + faixa_horario).attr('selected', true);
            });      
            

            </script>

    </body>

</html>