<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once HOMEPATH."home/controler/controlCliente.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlFormaPgt.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);
   
    //usado para coloração customizada da página seleciona na navbar
    $arquivo_pai = basename(__FILE__, '.php');

    date_default_timezone_set('America/Sao_Paulo');

?>

<!DOCTYPE html>

<html class="no-js" lang="pt-br">

    <head>

        <?php include VIEWPATH."/cabecalho.html" ?>

    </head>

    <body>

        <?php include_once "./header.php" ?>

        <div id="loading">
        </div>
        <style>
            #loading{
                display : block;
                position : fixed;
                z-index: 100;
                background-image : url('../../img/loading-orange.gif');
                background-color: #fff;
                opacity : 0.7;
                background-repeat : no-repeat;
                background-position : center;
                left : 0;
                bottom : 0;
                right : 0;
                top : 0;
            }
        </style>

        <div class="container-fluid">

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/enviaMsgSms.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-12">
                            <h3>Enviar Mensagem (para clientes) via SMS</h3>
                            <br>
                        </div>

                        <div class="col-md-3">
                            <div class="col-md-12">
                                

                                <h5><i class="far fa-envelope-open"></i>&nbsp;Mensagem</h5>

                                <textarea class="form-control" id="msgSms" name="msg" maxlength="150" rows="5">Delion Café - ...</textarea>

                                <p>*Caracteres: <span id="charsCount"></span></p>
                            </div>

                            <div class="col-md-12">
                                <h5><i class="fas fa-info-circle"></i>&nbsp;Descrição</h5>
                                <input class="form-control" placeholder="Ex: Aniversariantes e Pedidos Únicos" name="descricao" type="text" required>
                            </div>

                            <div class="col-md-12">

                                <h5><i class="fas fa-users"></i>&nbsp;Grupos de envio</h5>

                                Todos (<span id="qtd_todos"></span>)
                                <input type="checkbox" id="check_todos" name="" value="">
                                <br>

                                Aniversariantes de Hoje (<span id="qtd_aniversariantes"></span>)
                                <input type="checkbox" id="check_aniversariantes" name="" value="">
                                <br>

                                <!-- Pediram nos últimos 30 dias (<span id="qtd_ativos30"></span>)
                                <input type="checkbox" id="check_30dias" name="" value="">
                                <br>

                                Fizeram apenas 1 pedido (<span id="qtd_pedido_unico"></span>)
                                <input type="checkbox" id="check_1pedido" name="" value="">
                                -->

                                <!-- Aleatórios (?)
                                <input type="checkbox" id="check_aleatorios" name="" value=""> -->
                                
                                <br>
                                <br>

                            </div>

                            <div class="col-md-12">

                                <div class="pull-left">

                                <?php

                                $permissao =  json_decode($usuarioPermissao->getPermissao());

                                if (in_array('enviar_sms', $permissao)){ ?>

                                    <button type="submit" class="btn btn-kionux"><i class="fas fa-paper-plane"></i></i> Enviar</button>

                                <?php } ?>

                                </div>
                            </div>

                        </div>

                        <div class="col-md-9" style="max-height:400px; overflow-y:auto;">
                                                    
                            <?php
                                $controle=new controlCliente($_SG['link']);
                                $clientes = $controle->selectAllAtivos();
                            ?>

                            <table class="table table-hover">
                                <h4>Selecione Individualmente</h4>
                                <h5>*Selecionados: <span id="qtde_selecionados">0</span></h5>
                            <thead>
                                <tr>
                                    <th style='text-align: center;'>Nome</th>
                                    <th style='text-align: center;'>Sobrenome</th>
                                    <th style='text-align: center;'>Data Nasc.</th>
                                    <th style='text-align: center;'>Nº Pedidos</th>
                                    <th style='text-align: center;'>Fidelidade</th>
                                    <th style='text-align: center;'>Enviar</th>
                                </tr>
                            <tbody>

                                <?php
                                // $i = 0;
                                // while($i < 5000){
                                // $i ++;

                                foreach ($clientes as $key => $cliente) {

                                    $nasc = $cliente->getData_nasc();
                                    if($nasc != "0000-00-00"){
                                        $nasc_date = new DateTime($nasc);
                                        $nasc = date_format($nasc_date, 'd-m-Y');
                                        $aniversario = date_format($nasc_date, 'd-m');
                                    }else{
                                        $nasc = "";
                                    }
                                ?>
                                
                                <tr
                                    data-aniversario="<?=$aniversario?>"
                                    data_ultimo_pedido=""
                                >       
                                <td><?=$cliente->getNome()?></td>
                                <td><?=$cliente->getSobrenome()?></td>
                                <td><?=$nasc?></td>
                                <td><?=1?></td>
                                <td><?=99?></td>
                                
                                <td>
                                    <input type="hidden" id="cod_cli" name="cod_cli[]" value="<?=$cliente->getCod_cliente()?>">
                                    
                                    <input
                                    type="hidden"
                                    id="telefone_cli"
                                    name="telefone_cli[]"
                                    data-nasc="<?=$cliente->getData_nasc()?>"
                                    data-numero_pedidos=""
                                    data-fidelidade=""
                                    value="<?=$cliente->getTelefone()?>">
                                    
                                    <!-- passa keys por array para associação futura de -->
                                    <!-- telefones[_cli] e cod_cli[] -->
                                    <input
                                    type="checkbox"
                                    class="key_cli"
                                    name="key_cli[]"
                                    value="<?=$key?>">


                                </td>
                                </tr>

                                <?php
                                }
                                // }
                                ?>
                            </tbody>
                            </table>
                        </div>
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

        <!-- <script src="//cdn.tinymce.com/4/tinymce.min.js"></script> -->

        <script>
            
            $(document).ready(updateCountChars);
            $('#msgSms').keyup(updateCountChars);
            $('#msgSms').keydown(updateCountChars);

            function updateCountChars() {
                let cs = $('#msgSms').val().length;
                $('#charsCount').text(cs);
            }

            function updateCountChecked(){
                let count  = $("tbody > tr").find("input:checkbox:checked").length;
                $("#qtde_selecionados").text(count);
            }

            jQuery(window).load(function () {
                // alert('carreguei, mochila...');
                $("#loading").hide();

                countTodos();
                countAniversariantes();
                countAtivosUltimos30dias();
                countApenas1pedido();
            });

            function getTime(d) {
                return new Date(d.split("-").reverse().join("-")).getTime();
            }

            $(".key_cli").change(function(){
                updateCountChecked();
            });

            var current_date = "<?= date("d-m") ?>";//19-11
            // var current_date = "30-07-1997";
            /*Check clientes de acordo com grupo selecionado*/
            $("#check_aniversariantes").change(function() {
                if(this.checked) {

                    $("tbody > tr").each(function(){
                        if(getTime(current_date) == getTime(this.dataset.aniversario)){
                            $(this).find("input[type=checkbox]").prop("checked", true);
                        }
                    });

                //desmarca clientes
                }else{
                    $("tbody > tr").each(function(){
                        if(getTime(current_date) == getTime(this.dataset.aniversario)){
                            $(this).find("input[type=checkbox]").prop("checked", false);
                        }
                    });
                }
                
                updateCountChecked();
            });

            /*Check clientes de acordo com grupo selecionado*/
            $("#check_todos").change(function() {
                if(this.checked) {

                    $("tbody > tr").each(function(){
                        $(this).find("input[type=checkbox]").prop("checked", true);
                    });

                //desmarca clientes
                }else{
                    $("tbody > tr").each(function(){
                        $(this).find("input[type=checkbox]").prop("checked", false);
                    });
                }

                updateCountChecked();
            });

            
            
            /*Quantidade dos Grupos*/
            function countTodos() {
                let qtd = 0;
                $("tbody > tr").each(function(){
                    qtd++;
                });

                $('#qtd_todos').text(qtd);
            }

            function countAniversariantes() {
                let qtd = 0;
                $("tbody > tr").each(function(){
                    if(getTime(current_date) == getTime(this.dataset.aniversario)){
                        qtd++;
                    }
                });

                $('#qtd_aniversariantes').text(qtd);
            }
            function countAtivosUltimos30dias() {
                
                let qtd = 0;
                $("tbody > tr").each(function(){
                    console.log(getTime(current_date)  - getTime(this.dataset.data_ultimo_pedido));

                    // if(getTime(current_date)  - getTime(this.dataset.data_ultimo_pedido)){
                    //     qtd++;
                    // }
                });

                $('#qtd_ativos30').text(qtd);
            }

            function countApenas1pedido() {

                let qtd = 0;
                $("tbody > tr").each(function(){
                    if(this.dataset.qtd_pedidos == 1){
                        qtd++;
                    }
                });

                $('#qtd_pedido_unico').text(qtd);
            }

        </script>

    </body>

</html>