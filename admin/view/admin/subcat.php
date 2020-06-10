<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH . "/controlCategoria.php";

    include_once MODELPATH . "/categoria.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controleCategoria = new controlerCategoria($_SG['link']);

    $categorias = $controleCategoria->selectAll();

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


        <div class="container-fluid">

            <form class="form-horizontal" id="form-cadastro-usuario" method="POST" enctype="multipart/form-data" action="../../controler/businesSubcategoria.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Cadastrar Subcategoria</h3>

                            <br>

                            <small>Nome:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" maxlength="30">

                            </div>

                            <br>
                            
                           <small>Categoria Associada*: </small>

                            <select class="form-control" name="categoria" id="categoria" required>

                                <option value="">Selecionar Categoria</option>

                                <?php

                                foreach ($categorias as $categoria) {
                                    echo "<option value='" . $categoria->getPkId() . "'>" . $categoria->getNome() . "</option>";
                                }
                                ?>

                            </select>
                            
                            <br>

                            <small>Icone: <span style="color:red">(Utilizar uma imagem no tamanho 43[largura] x 43[altura]. Formato (.png) ou (.jpg).)</span></small>

                            <input type="file" name="arquivo" id ="arquivo">

                            <br>

                        </div> 

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('categoria', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                    <a href="categoriaLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Sair</a>

                    </div>

                </div>

            </form>

        </div>

        

        <?php include VIEWPATH."/rodape.php" ?>

    </body>

</html>