<?php

    include_once MODELPATH."/usuario.php";

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);
?>


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
                                    if(strpos($arquivo_pai, 'usuario') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                                
                            <?php
                            
                            $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                            if(in_array('usuario', $permissao)){ ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuários <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="usuario.php">Cadastro</a></li>

                                    <li><a href="usuariosLista.php">Listar</a></li>

                                </ul>

                            </li>

                            <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($arquivo_pai, 'empresa') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                                <?php } ?>

                            <?php
                            
                            $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                            if(in_array('empresa', $permissao)){ ?>

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empresa <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="empresa.php">Alterar</a></li>
                                    <li><a href="empresaHorarios.php">Gerenciar Funcionamento</a></li>

                                </ul>

                            </li>

                           <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($arquivo_pai, 'Avaliacao') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <?php } ?>

                            <?php
                            
                            $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                            if(in_array('avaliacao', $permissao)){ ?>

                                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Avaliacao <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="tipoAvaliacao.php">Cadastro</a></li>

                                    <li><a href="tipoAvaliacaoLista.php">Listar</a></li>

                                    <li><a href="mediaAvaliacao.php">Médias</a></li>

                                </ul>

                            </li> -->

                           <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($arquivo_pai, 'imagem') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <?php } ?>
                                
                            <?php
                            
                            $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                            if(in_array('imagem', $permissao)){ ?>

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Imagens <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="imagem.php">Cadastro</a></li>

                                    <li><a href="imagemLista.php">Listar</a></li>

                                </ul>

                            </li>

                           <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($arquivo_pai, 'evento') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <?php } ?>
                                
                            <?php
                            
                            $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                            if(in_array('evento', $permissao)){ ?>

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Evento <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="evento.php">Cadastro</a></li>

                                    <li><a href="eventoLista.php">Listar</a></li>

                                </ul>

                            </li>

                           <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($arquivo_pai, 'categoria') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <?php } ?>
                                
                            <?php
                            
                            $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                            if(in_array('categoria', $permissao)){ ?>

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categoria <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="categoria.php">Cadastro</a></li>

                                    <li><a href="categoriaLista.php">Listar</a></li>

                                </ul>

                            </li>

                           <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($arquivo_pai, 'cardapio') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <?php } ?>
                                
                            <?php
                            
                            $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                            if(in_array('cardapio', $permissao)){ ?>

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cardápio <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="produto.php">Cadastro</a></li>

                                    <li><a href="cardapioLista.php">Listar</a></li>

                                    <li><a href="gerenciarCardapio.php">Gerenciar</a></li>

                                </ul>

                            </li>

                           <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($arquivo_pai, 'adicional') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <?php } ?>
                                
                            <?php
                            
                            $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                            if(in_array('adicional', $permissao)){ ?>


                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Adicional <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="adicional.php">Cadastro</a></li>

                                    <li><a href="adicionalLista.php">Listar</a></li>
                                    
                                </ul>

                            </li>   

                       <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if($arquivo_pai == "cliente" || $arquivo_pai == "clienteLista"){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <?php } ?>
                            
                            <?php
                            
                            $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                            if(in_array('cliente', $permissao)){ ?>

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cliente <span class="caret"></span></a>
                            
                            <ul class="dropdown-menu">
                                
                                <!-- <li><a href="cliente.php">Cadastro</a></li> -->
                                    
                                <li><a href="clienteLista.php">Listar</a></li>
                            
                            </ul>
                            <?php } ?>
                        
                        </li>
                        
                        <?php
                            
                        $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                        if(in_array('cliente', $permissao)){ ?>

                       <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($arquivo_pai, 'combo') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <!-- <a href="comboLista.php">Combo</a> -->
                        </li>     
                        <?php } ?>


                        <?php
                            
                            $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                            if(in_array('avaliacao', $permissao)){ ?>

                       <!-- <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($arquivo_pai, 'avaliacao') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <a href="/home/avaliacao.php">Avaliar</a>
                        </li> -->
                        
                        <?php } ?>
                        
                        <?php
                            
                            $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                            if(in_array('avaliacao', $permissao)){ ?>
                        
                       <!-- <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($arquivo_pai, 'endereco') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <a href="enderecoLista.php">Endereços</a>
                        </li> -->

                        <?php } ?>
                        
                        <?php
                            
                            $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                            if(in_array('pedido', $permissao)){ ?>

                       <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($arquivo_pai, 'pedidoLista') !== false){
                                        echo 'active';
                                    }
                                ?>
                            ">
                            <!--/.Mudar aqui -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pedidos<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <!-- <li><a href="pedidoWpp.php">Novo Pedido Whatsapp</a></li> -->
                                <!-- <li><a href="pedidoWppLista.php">Listar Pedidos</a></li> -->
                                <li><a href="pedidoLista.php">Listar Pedidos</a></li>
                                <!-- <li><a href="clienteListaWpp.php">Listar Clientes Whatsapp</a></li> -->
                            </ul>
                            <?php } ?>
                        
                        
                       <?php
                            
                       $permissao = json_decode($usuarioPermissao->getPermissao());
                            
                       if(in_array('cupom', $permissao)){ ?>

                       <li class="dropdown

                                <?php
                                    //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                    if(strpos($arquivo_pai, 'cupom') !== false){
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
                        <?php } ?>
                        
                        <?php
                            
                        $permissao = json_decode($usuarioPermissao->getPermissao());
                                 
                        if(in_array('forma_pgto', $permissao)){ ?>

                       <li class="dropdown

                            <?php
                                //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                if(strpos($arquivo_pai, 'formaPgt') !== false){
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
                        <?php } ?>
                        
                        <?php
                            
                        $permissao = json_decode($usuarioPermissao->getPermissao());
                                 
                        if(in_array('info_entrega', $permissao)){ ?>

                        <li class="dropdown

                            <?php
                                //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                if(strpos($arquivo_pai, 'entrega') !== false || $arquivo_pai == "novo-raio"){
                                    echo 'active';
                                }
                            ?>
                        ">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informações de Entrega <span class="caret"></span></a>

                            <ul class="dropdown-menu">

                                <li><a href="novo-raio.php">Novo Raio</a></li>
                                <li><a href="entrega.php">Alterar</a></li>

                            </ul>

                        </li>
                        <?php } ?>



                        <?php
                        //SMS
                            
                        $permissao = json_decode($usuarioPermissao->getPermissao());
                                 
                        if(in_array('enviar_sms', $permissao)){ ?>

                        <li class="dropdown

                            <?php
                                //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                if(strpos($arquivo_pai, 'Sms') !== false){
                                    echo 'active';
                                }
                            ?>
                        ">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SMS <span class="caret"></span></a>

                            <ul class="dropdown-menu">

                                <li><a href="enviarSms.php">Enviar SMS</a></li>
                                <li><a href="listarSms.php">Listar Envios</a></li>

                            </ul>

                        </li>
                        <?php } ?>




                        <?php
                        //Gerenciar Fidelidade
                        $permissao = json_decode($usuarioPermissao->getPermissao());
                                 
                        if(in_array('gerenciar_fidelidade', $permissao)){ ?>

                        <li class="dropdown

                            <?php
                                //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                if(strpos($arquivo_pai, 'Fidelidade') !== false){
                                    echo 'active';
                                }
                            ?>  
                        ">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Fidelidade <span class="caret"></span></a>

                            <ul class="dropdown-menu">

                                <li><a href="gerenciarFidelidade.php">Gerenciar Programa</a></li>
                                <li><a href="cadastrarFidelidade.php">Adicionar Produto</a></li>
                                <li><a href="listarFidelidade.php">Listar Produtos</a></li>

                            </ul>

                        </li>
                        <?php } ?>


                        <?php
                        //Gerenciar Fornecedores
                        $permissao = json_decode($usuarioPermissao->getPermissao());
                                 
                        if(in_array('gerenciar_fornecedor', $permissao)){ ?>

                        <li class="dropdown

                            <?php
                                //verifica qual opção do menu está selecionada (arquivo aberto) e, atribui design diferenciado
                                if(strpos($arquivo_pai, 'Fornecedor') !== false || strpos($arquivo_pai, 'fornecedores') !== false){
                                    echo 'active';
                                }
                            ?>  
                        ">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Fornecedores <span class="caret"></span></a>

                            <ul class="dropdown-menu">
                                <li><a href="cadastrarFornecedor.php">Cadastrar Fornecedor</a></li>
                                <li><a href="fornecedoresLista.php">Listar Fornecedores</a></li>
                                <li><a href="cadastrarTipoFornecedor.php">Cadastrar Tipo de Fornecedor</a></li>
                                <li><a href="tipoFornecedorLista.php">Listar Tipos de Fornecedores</a></li>
                                <li><a href="cadastrarPedidoFornecedor.php">Cadastrar Pedido p/ Fornecedor</a></li>
                                <li><a href="pedidoFornecedorLista.php">Listar Pedidos p/ Fornecedores</a></li>

                            </ul>

                        </li>
                        <?php } ?>




                        </ul>

                    </div><!--/.nav-collapse -->

                    <div>

                    </div>

                    <div class="pull-right">

                        <h2>
                            <a href="alteraSenha.php"><i class="fa fa-cog"></i>&nbsp;ALTERAR SENHA&nbsp;|</a>
                            <a href="../../controler/logout.php"><i class="fas fa-sign-out-alt"></i>SAIR&nbsp;</a>
                        </h2>

                    </div>

                </div>

            </nav>

        </div>

    </div>

</header>