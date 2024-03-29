<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

include_once CONTROLLERPATH . "/controlUsuario.php";

include_once MODELPATH . "/usuario.php";

include_once CONTROLLERPATH . "/seguranca.php";

include_once CONTROLLERPATH . "/controlProduto.php";

include_once MODELPATH . "/produto.php";

include_once CONTROLLERPATH . "/controlCategoria.php";

include_once CONTROLLERPATH . "/controlAdicional.php";

include_once MODELPATH . "/categoria.php";

include_once CONTROLLERPATH . "/controlFaixaHorario.php";


$_SESSION['permissaoPagina'] = 0;

protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controleCategoria = new controlerCategoria($_SG['link']);
$categorias = $controleCategoria->selectAll();

$controle = new controlerProduto($_SG['link']);
$produto = $controle->selectById($_GET['cod']);
$codPag = $_GET['codPag'];

// $adicionais_associados = json_decode($produto->getAdicional());
$controleAdicional = new controlerAdicional($_SG['link']);

$adicionais = $controleAdicional->selectAdiCategoria($produto->getCategoria());

// var_dump($produto->getCategoria());
// exit;

$controleFaixaHorario = new controlerFaixaHorario($_SG['link']);
$faixas_horario = $controleFaixaHorario->selectByFkProduto($_GET['cod']);
$numero_turnos = count($faixas_horario);

//usado para coloração customizada da página selecionada na navbar
$arquivo_pai = basename(__FILE__, '.php');


?>

<!DOCTYPE html>

<html class="no-js" lang="pt-br">

<head>

    <?php include VIEWPATH . "/cabecalho.html" ?>

</head>

<body>

    <?php include_once "./header.php" ?>


    <div class="container-fluid">

        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alteraProduto.php">

            <div class="col-md-12">

                <div class="row">


                    <h3>Alterar Produto</h3>

                    <br>

                    <div class="col-md-7">
                        <small>Nome *: </small>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fas fa-utensils"></i></span>

                            <input class="form-control" placeholder="Nome" name="nome" required autofocus id="nome" type="text" value="<?= $produto->getNome(); ?>">

                            <input class="form-control" name="cod" id="cod" type="hidden" value="<?= $produto->getPkId(); ?>">

                            <input class="form-control" name="codPag" id="codPag" type="hidden" value="<?= $codPag; ?>">

                            <input class="form-control" name="imagem" id="imagem" type="hidden" value="<?= $produto->getFoto(); ?>">

                        </div>
                    </div>

                    <div class="col-md-7">

                        <br>

                        <small>Preço *: </small>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>

                            <input class="form-control" placeholder="Preço" name="preco" required id="preco" type="number" step="0.01" min="0.1" max="999" value="<?= $produto->getPreco(); ?>">

                        </div>
                    </div>

                    <br>

                    <div class="col-md-7">

                        <small>Desconto em (%): </small>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fas fa-percentage"></i></span>

                            <input class="form-control" placeholder="Desconto" name="desconto" id="desconto" type="number" step="1" max="99" value="<?= $produto->getDesconto(); ?>">

                        </div>
                    </div>

                    <br>

                    <div class="col-md-7">

                        <small>Categoria *:</small>

                        <select class="form-control" name="categoria" id="categoria" required>

                            <option value="">Selecionar Categoria</option>

                            <?php

                            foreach ($categorias as $categoria) {

                                echo "<option value='" . $categoria->getPkId() . "' id='" . $categoria->getPkId() . "'>" . $categoria->getNome() . "</option>";
                            }
                            ?>

                        </select>
                    </div>

                    <div class="col-md-7">

                        <br>

                        <small>Informar se o item está ativo:</small>
                        <div class="checkbox">

                            <label>

                                <input type="checkbox" id="ativo" <?= ($produto->getFlag_ativo() == 1) ? "checked" : "" ?> name="flag_ativo" value="1">Ativo

                            </label>

                        </div>

                        <small>Informar se o item está marcado como prioridade:</small>

                        <div class="checkbox">

                            <label>
                                <?php if ($produto->getPrioridade() == 1) { ?>
                                    <input type="checkbox" id="prioridade" name="prioridade" value="1" checked>Prioridade
                                <?php } else { ?>
                                    <input type="checkbox" id="prioridade" name="prioridade" value="1">Prioridade
                                <?php } ?>
                            </label>
                        </div>

                        <small>Informar se o item está disponível para delivery:</small>

                        <div class="checkbox">

                            <label>
                                <?php if ($produto->getDelivery() == 1) { ?>
                                    <input type="checkbox" id="delivery" name="delivery" value="1" checked>Delivery
                                <?php } else { ?>
                                    <input type="checkbox" id="delivery" name="delivery" value="1">Delivery
                                <?php } ?>
                            </label>

                        </div>

                        <small>Informar se o Produto estará disponivel para ser Servido:</small>
                        <div class="checkbox">

                            <label>
                                <?php if ($produto->getFlag_servindo() == 1) { ?>
                                    <input type="checkbox" id="servindo" name="servindo" value="1" checked>Servindo
                                <?php } else { ?>
                                    <input type="checkbox" id="servindo" name="servindo" value="1">Servindo
                                <?php } ?>


                            </label>

                        </div>


                        <small>Dias em que o Item Estará Disponível:</small>

                        <div class="checkbox checkbox-dias">

                            <!-- Domingo -->
                            <label>
                                <input type="checkbox" id="domingo" name="dias[]" value="1" />Dom &nbsp;
                            </label>

                            <!-- Segunda -->
                            <label>
                                <input type="checkbox" id="segunda" name="dias[]" value="2" />Seg &nbsp;
                            </label>
                            <!-- Terça -->
                            <label>
                                <input type="checkbox" id="terca" name="dias[]" value="3" />Ter &nbsp;
                            </label>
                            <!-- Quarta -->
                            <label>
                                <input type="checkbox" id="quarta" name="dias[]" value="4" />Qua &nbsp;
                            </label>
                            <!-- Quinta -->
                            <label>
                                <input type="checkbox" id="quinta" name="dias[]" value="5" />Qui &nbsp;
                            </label>
                            <!-- Sexta -->
                            <label>
                                <input type="checkbox" id="sexta" name="dias[]" value="6" />Sex &nbsp;
                            </label>
                            <!-- Sábado -->
                            <label>
                                <input type="checkbox" id="sabado" name="dias[]" value="7" />Sáb &nbsp;
                            </label>
                        </div>

                    </div>

                    <div class="col-md-12">

                        <small>Quando o item estará disponível:</small>
                        <br>
                        <div class="col-md-2">
                            Turnos
                            <select id="turno-selector" class="form-control" name="turno">
                                <option value="0">Sempre Disponível</option>
                                <option value="1">1 Turno</option>
                                <option value="2">2 Turnos</option>
                                <option value="3">3 Turnos</option>
                                <option value="4">4 Turnos</option>
                            </select>
                        </div>

                        <?php

                        for($i=1; $i <= 4; $i++){

                            if(isset($faixas_horario[$i-1])){
                                $inicio = $faixas_horario[$i-1]->getInicio();
                                $final = $faixas_horario[$i-1]->getFinal();
                            }else{
                                $inicio = "00:00";
                                $final = "23:59";
                            }

                            echo '
                            <div id="turno'.$i.'" class="col-md-2 turnos">
                                '.$i.'º Turno (Início / Fim)
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="far fa-clock"></i></span>
                                    <input class="form-control" name="faho_inicio[]" type="time" value="'.$inicio.'">
                                    <input class="form-control" name="faho_final[]" type="time" value="'.$final.'">
                                </div>
                            </div>';
                        }
                        

                        ?>

                    </div>

                </div>

                <br>
                <br>

                <div class="col-md-7 adicionais-checkbox">
                    <small>Quais são os adicionais disponiveis para este produto:</small>

                    <input type="hidden" value="<?= count($adicionais) ?>" name="quantidadeAdicionais">
                    <br>

                    <div id="adicionais-checkbox-list" class="checkbox-adicionais">
                        <?php
                        foreach ($adicionais as $adicional) {
                            echo "
                                        <li>
                                            <input type='checkbox' name='adicional[]' value='" . $adicional->getPkId() . "'> " . $adicional->getNome() .
                                "</li>";
                        } ?>

                    </div>
                </div>

                <div class="col-md-7">

                    <small>Foto:</small>
                    <br>
                    <img src="../../<?= $produto->getFoto(); ?>" alt='' class='img-thumbnail img-responsive' />

                </div>
                
                <div class="col-md-7">

                    <small>Foto: <span style="color:red">(Utilizar uma imagem no tamanho 525[largura] x 320[altura]. Formato (.png) ou (.jpg).)</span></small>
                    <input type="file" name="arquivo" id="arquivo">
                    <br>
                    
                </div>

                <div class="col-md-7">

                    <small>Descrição do item: </small>

                    <textarea name="descricao" rows="12"><?= html_entity_decode($produto->getDescricao()); ?></textarea>

                    <br>

                </div>

            </div>

            <div class="col-md-5">

                <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('cardapio', $permissao)) { ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

                    <?php } ?>

                </div>

                <div class="pull-right">

                    <a href="cardapioLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Sair</a>

                </div>

            </div>

        </form>

    </div>



    <?php include VIEWPATH . "/rodape.php" ?>

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link |  forecolor backcolor '
        });

        $(document).ready(function() {

            var categoria = '<?= $produto->getCategoria() ?>';
            var dias = '<?= $produto->getDias_semana() ?>';
            var ativo = '<?= $produto->getFlag_ativo() ?>'
            var adicionais = '<?= $produto->getAdicional() ?>';
            var numero_turnos = '<?= $numero_turnos ?>';

            if (dias) dias = JSON.parse(dias);

            if (adicionais) adicionais = JSON.parse(adicionais);


            //dia -> 1 == domingo...7 == sábado
            for (let dia of dias) {
                $(".checkbox-dias :checkbox[value=" + dia + "]").prop("checked", "true");
            }
            for (let adicional of adicionais) {
                $(".checkbox-adicionais :checkbox[value=" + adicional + "]").prop("checked", "true");
            }

            if (ativo == 1) {
                $('#ativo').attr('checked', true);
            }

            if (categoria) $('#' + categoria).attr('selected', true);

            // Turnos
            $('.turnos').hide();
            $('#turno-selector').change(function() {

                $('.turnos').hide();

                var numero_turnos = $(this).val();
                for (var i = 1; i <= numero_turnos; i++) {
                    $('#turno' + i).show();
                }
            });

            $("#turno-selector").val(numero_turnos).change();
        });

        //adicionais
        $('#categoria').on('change',function(e){
        $.get('../../ajax/adicional-categoria.php', {id:$('#categoria option:checked').val()}, 
        function(data){
            $('.adicionais-checkbox').show();
            $('#adicionais-checkbox-list').html(data);
                console.log(data);
            })
        });

    </script>

</body>

</html>