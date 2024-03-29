<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlImagem.php";

    include_once MODELPATH."/imagem.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    //usado para coloração customizada da página selecionada na navbar
    $arquivo_pai = basename(__FILE__, '.php');

?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <?php include VIEWPATH."/cabecalho.html" ?>

    </head>

    <body>

    <?php include_once "./header.php" ?>


        <?php

            $controle=new controlerImagem($_SG['link']);

            $imagem = $controle->select($_GET['cod'], 2);

            $paginas= $imagem->getPagina();

        ?>

        <div class="container-fluid">

            <form class="form-horizontal" id="form-cadastro-usuario" method="POST" enctype="multipart/form-data" action="../../controler/alteraImagem.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados da imagem</h3>

                            <br>

                            <small>Nome: (Apenas para referência.)</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" value="<?=  $imagem->getNome(); ?>"/>

                                <input class="form-control" name="cod" style="display: none;" id ="cod" type="text" value="<?=  $imagem->getPkId(); ?>"/>

                                <input class="form-control" name="imagem" style="display: none;" id ="imagem" type="text" value="../<?=  $imagem->getFotoAbsoluto(); ?>"/>

                            </div>

                            <br>

                            <small>Foto:</small>

                            <br>

                            <img src="../../<?=  $imagem->getFoto(); ?>"  alt='' class='img-thumbnail img-responsive'/>

                            <br>

                            <small>Foto:<br/> 

                               <span style="color:red">(Utilizar uma imagem no formato (.png) ou (.jpg). ) </span>

                            </small>
                            <input type="file" name="arquivo" id ="arquivo">

                            <br>

                            <div class="checkbox" style="font-size: 14px" hidden>

                                <ul>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="homeTopo" name="paginas[]" value="homeTopo">[Homepage] - (Imagem) Topo <small><span style="color:red">*Proporção sugerida 1410[largura] x 500[altura] </span><br/></small>

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="homeLogo" name="paginas[]" value="homeLogo">[Homepage] - (Imagem) Logo Topo <small><span style="color:red">*Proporção sugerida 230[largura] x 230[altura] </span><br/></small>

                                        </label>

                                    </li>

                                    <li style="white-space: nowrap">

                                        <label>

                                            <!-- <input type="checkbox" id="contato" name="paginas[]" value="contato">Contato -->
                                            <input type="checkbox" id="homeCardapio" name="paginas[]" value="homeCardapio">[Homepage] - (Imagem) Cardápio <small><span style="color:red">*Proporção sugerida 460[largura] x 460[altura] </span><br/></small>

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <!-- <input type="checkbox" id="popUp" name="paginas[]" value="popUp">Pop Up inicial -->
                                            <input type="checkbox" id="homeEventos" name="paginas[]" value="homeEventos">[Homepage] - (Imagem) Eventos <small><span style="color:red">*Proporção sugerida 460[largura] x 460[altura] </span><br/></small>

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <!-- <input type="checkbox" id="homeQuemSomos" name="paginas[]" value="homeQuemSomos">Quem Somos -->
                                            <input type="checkbox" id="homeFidelidade" name="paginas[]" value="homeFidelidade">[Homepage] - (Imagem) Fidelidade <small><span style="color:red">*Proporção sugerida 460[largura] x 460[altura] </span><br/></small>

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                        <input type="checkbox" id="contato" name="paginas[]" value="contato">[Contato] - (Imagem) Contato <small><span style="color:red">*Proporção sugerida 567[largura] x 319[altura] </span><br/></small> 

                                        </label>

                                    </li>


                                    <li>

                                        <label>

                                            <input type="checkbox" id="sobre" name="paginas[]" value="sobre">[Sobre] - (Imagem) Sobre <small><span style="color:red">*Proporção sugerida 668[largura] x 287[altura] </span><br/></small>

                                        </label>

                                    </li>

                                        <li>

                                        <label>

                                            <input type="checkbox" id="historia" name="paginas[]" value="historia">[História] - (Imagem) História <small><span style="color:red">*Proporção sugerida 567[largura] x 319[altura] </span><br/></small>

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

                    if (in_array('imagem', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                        <a href="imagemLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Sair</a>

                    </div>

                </div>

            </form>

        </div>

        <?php include VIEWPATH."/rodape.php" ?>
        
        <script>

        var paginas = <?= $paginas ?>;
        // console.log(permissoes);
        $( document ).ready(function() {

            for(let p of paginas){
                $('#' + p).attr('checked', true);
            }

        });

        </script>

    </body>

</html>