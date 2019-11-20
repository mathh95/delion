<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlEmpresa.php";

    include_once MODELPATH."/empresa.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);


    $controle=new controlerEmpresa($_SG['link']);

    $empresa = $controle->selectAll();

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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alteraEmpresa.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados da Empresa</h3>

                            <br>

                            <small>Sobre a Empresa: </small>

                            <textarea name="descricao" rows="12"><?=  $empresa->getDescricao(); ?></textarea>

                            <br>

                            <small>História da Empresa: </small>

                            <textarea name="historia" rows="12"><?=  $empresa->getHistoria(); ?></textarea>

                            <br>

                            <small>Foto: <span style="color:red">(Utilizar uma imagem no tamanho 270[largura] x 93[altura]. Formato (.png) ou (.jpg).)</span></small>

                            <br>

                            <img src="../../<?=  $empresa->getFoto(); ?>"  alt='' class='img-thumbnail img-responsive'/>

                            <br>

                            <br>

                            <small style="color:red">Selecione uma imagem caso queira substituir a imagem já existente.</small>

                            <input type="file" name="arquivo">

                            <input class="form-control" name="imagem" style="display: none;" id ="imagem" type="hidden" value="../<?=  $empresa->getFotoAbsoluto(); ?>"/>

                            <br>

                        </div>

                        <div class="col-md-1">

                        </div>

                        <div class="col-md-5">

                            <h3>Dados de Funcionamento da Empresa</h3>

                            <br>

                            
                            <small>Endereço:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                <input class="form-control" placeholder="" name="endereco" value="<?=  $empresa->getEndereco(); ?>"  type="text">

                                <input class="form-control" style="display: none;" placeholder="" name="cod_empresa" value="<?=  $empresa->getCod_empresa(); ?>"  type="text">

                            </div>

                            <br>

                            <small>CEP:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                <input class="form-control" placeholder="" name="cep" value="<?=  $empresa->getCep(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Bairro:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                <input class="form-control" placeholder="" name="bairro" value="<?=  $empresa->getBairro(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Cidade:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>

                                <input class="form-control" placeholder="" name="cidade" value="<?=  $empresa->getCidade(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Estado:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map"></i></span>

                                <input class="form-control" placeholder="" name="estado" value="<?=  $empresa->getEstado(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Telefone:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                <input class="form-control" placeholder="" name="fone" id="fone" value="<?=  $empresa->getFone(); ?>"  type="text">

                            </div>

                            <br>

                            <small>WhatsApp:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-whatsapp"></i></span>

                                <input class="form-control" placeholder="" name="whats" id="whats" value="<?=  $empresa->getWhats(); ?>"  type="text">

                            </div>

                            <br>

                            <small>E-mail:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                <input class="form-control" placeholder="" name="email" value="<?=  $empresa->getEmail(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Facebook:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-facebook-official"></i></span>

                                <input class="form-control" placeholder="" name="facebook" value="<?=  $empresa->getFacebook(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Instagram:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-instagram"></i></span>

                                <input class="form-control" placeholder="" name="instagram" value="<?=  $empresa->getInstagram(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Pinterest:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pinterest-p"></i></span>

                                <input class="form-control" placeholder="" name="pinterest" value="<?=  $empresa->getPinterest(); ?>"  type="text">

                            </div>

                            <br>

                        </div>

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('empresa', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

                    <?php } ?>

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

        </script>

        <script src="http://digitalbush.com/wp-content/uploads/2014/10/jquery.maskedinput.js"></script>

        <script type="text/javascript">

            $("#fone").on("blur", function() {

                var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );



                if( last.length == 3 ) {

                    var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );

                    var lastfour = move + last;

                    var first = $(this).val().substr( 0, 9 );



                    $(this).val( first + '-' + lastfour );

                }

            });

       </script>

    </body>

</html>