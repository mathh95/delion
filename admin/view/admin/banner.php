<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    //usado para coloração customizada da página seleciona na navbar
    $arquivo_pai = basename(__FILE__, '.php');

?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <?php include VIEWPATH."/cabecalho.html" ?>

    </head>

    <body>

        <?php include_once "./header.php" ?>


        <div class="container-fluid">

            <form class="form-horizontal" id="form-cadastro-usuario" method="POST" enctype="multipart/form-data" action="../../controler/businesBanner.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do Banner</h3>

                            <br>

                            <small>Nome: (Apenas para referência)</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text">

                            </div>

                            <br>

                            <small>Link: (endereço caso deseja que ao clicar no banner o usuário vá para uma página especifica.)</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-link"></i></span>

                                <input class="form-control" placeholder="ex: http://www.minhapagina.com.br/produtos" name="link" id ="link" type="text">

                            </div>

                            <br>

                            <small>Foto:<br/> 

                                <span style="color:red">(Utilizar uma imagem no formato (.png) ou (.jpg). Tamanho 1900[largura] x 690[altura] para o banner da Página inicial superior.)</span><br/>



                                <span style="color:red">(Utilizar uma imagem no formato (.png) ou (.jpg).Tamanho 1900[largura] x 538[altura] para outros locais de banners.) </span><br/>

                                <span style="color:red">(Utilizar uma imagem no formato (.png) ou (.jpg). ) </span>

                            </small>

                            <input type="file" name="arquivo" id ="arquivo" required="">

                            <br>

                            <small>Página (Página onde o banner será utilizado)</small>

                            <div class="checkbox">

                                <ul>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="inicialSuperior" name="1pagina" value="inicialSuperior">Página inicial superior

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="inicialInferior" name="2pagina" value="inicialInferior">Página inicial inferior

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="sobre" name="3pagina" value="sobre">Sobre

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="historia" name="4pagina" value="historia">História

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="contato" name="5pagina" value="contato">Contato

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="localizacao" name="6pagina" value="localizacao">Localização

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="cardapio" name="7pagina" value="cardapio">Cardápio

                                        </label>

                                    </li>

                                </ul>

                            </div>

                            <br>

                        </div> 

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('banner', $permissao)){ ?>

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

    </body>

</html>