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

                            <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'usuario') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuários <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="usuario.php">Cadastro</a></li>

                                    <li><a href="usuariosLista.php">Listar</a></li>

                                </ul>

                            </li>

                            <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'empresa') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empresa <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="empresa.php">Alterar</a></li>

                                </ul>

                            </li>

                            <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'banner') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">

                               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Banners <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="banner.php">Cadastro</a></li>

                                    <li><a href="bannerLista.php">Listar</a></li>

                                </ul>

                            </li>

                           <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'Avaliacao') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Avaliacao <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="tipoAvaliacao.php">Cadastro</a></li>

                                    <li><a href="tipoAvaliacaoLista.php">Listar</a></li>

                                    <li><a href="mediaAvaliacao.php">Médias</a></li>

                                </ul>

                            </li>

                           <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'imagem') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Imagens <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="imagem.php">Cadastro</a></li>

                                    <li><a href="imagemLista.php">Listar</a></li>

                                </ul>

                            </li>

                           <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'evento') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Evento <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="evento.php">Cadastro</a></li>

                                    <li><a href="eventoLista.php">Listar</a></li>

                                </ul>

                            </li>

                           <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'categoria') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categoria <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="categoria.php">Cadastro</a></li>

                                    <li><a href="categoriaLista.php">Listar</a></li>

                                </ul>

                            </li>

                           <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'cardapio') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cardápio <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="cardapio.php">Cadastro</a></li>

                                    <li><a href="cardapioLista.php">Listar</a></li>

                                </ul>

                            </li>

                           <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'adicional') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Adicional <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="adicional.php">Cadastro</a></li>

                                    <li><a href="adicionalLista.php">Listar</a></li>
                                    
                                </ul>

                            </li>   

                           <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'miniB') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mini banner <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="miniBanner.php">Cadastro</a></li>

                                    <li><a href="miniBannerLista.php">Listar</a></li>

                                </ul>

                            </li>

                       <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'cliente') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cliente <span class="caret"></span></a>
                            
                            <ul class="dropdown-menu">
                                
                                <li><a href="cliente.php">Cadastro</a></li>
                                    
                                <li><a href="clienteLista.php">Listar</a></li>
                            
                            </ul>
                        
                        </li>

                       <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'pedido') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <a href="pedidoLista.php">Pedido</a>
                        </li>

                       <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'combo') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <a href="comboLista.php">Combo</a>
                        </li>     
                        
                       <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'avaliacao') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <a href="/home/avaliacao.php">Avaliar</a>
                        </li>
                       <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'endereco') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <a href="enderecoLista.php">Endereços</a>
                        </li>
                       <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'Wpp') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <!--/.Mudar aqui -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pedidos Whatsapp <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="pedidoWpp.php">Novo Pedido</a></li>
                                <li><a href="pedidoWppLista.php">Listar Pedidos</a></li>
                                <li><a href="clienteListaWpp.php">Listar Clientes Whatsapp</a></li>
                            </ul>
                       <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'cupom') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cupom<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="cupom.php">Cadastro</a></li>
                                <li><a href="cupomLista.php">Listar Cupons</a></li>
                            </ul>
                        </li>
                       <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($father_filename, 'formaPgt') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Formas de Pagamento<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="formaPgt.php">Cadastro</a></li>
                                    <li><a href="formaPgtLista.php">Listar</a></li>
                                </ul>
                            </li> 


                        </ul>

                    </div><!--/.nav-collapse -->

                    <div>

                    </div>

                    <div class="pull-right">

                        <h2>
                            <a href="alteraSenha.php"><i class="fa fa-cog"></i>&nbsp;ALTERAR SENHA&nbsp;|</a>
                            <a href="../../controler/logout.php"><i class="fa fa-sign-out"></i>SAIR&nbsp;</a>
                        </h2>

                    </div>

                </div>

            </nav>

        </div>

    </div>

</header>