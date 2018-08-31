<?php
session_start();
    ini_set('display_errors', true);

    date_default_timezone_set('America/Sao_Paulo');



    include_once "../../admin/controler/conexao.php";

    include_once "../controler/controlCardapio.php";

    include_once "../controler/controlCategoria.php";

    include_once "../lib/alert.php";

    // Verifica se foi feita alguma busca

    // Caso contrario, redireciona o visitante pra home



    // Conecte-se ao MySQL antes desse ponto

    // Salva o que foi buscado em uma variável

    if ($_GET['tipo'] == 'busca') {

        $busca = addslashes(htmlspecialchars($_GET['search']));

        $controleCategoria=new controlerCategoria(conecta());

        $controleCardapio=new controlerCardapio(conecta());

        // ============================================

        // Monta outra consulta MySQL para a busca

        $por_pagina = 6;

        if (isset($_GET['page']) && !empty($_GET['page'])) {

            $pagina = (int)$_GET['page'];

        } else {

            $pagina = 1;

        }

        // if(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])){
        //     $quantidadeCarrinho = count($_SESSION['carrinho']);
        // }else{
        //     $quantidadeCarrinho = 0;
        // }

        $quantidade = $controleCardapio->select($busca,1);

        $total = count($quantidade);

        $offset = ($pagina - 1) * $por_pagina;
        
        $itens = $controleCardapio->selectPaginadoNome($busca,$offset,$por_pagina);

        $paginas = (($total % $por_pagina) > 0) ? (int)($total / $por_pagina) + 1 : ($total / $por_pagina);

        $i= 0;

        $categoria = "";

        if (!empty($itens) && count($itens) > 0) {

            foreach ($itens as $item) {

                $i++;

                if ($categoria != $item->getCategoria()) {

                    $categoria = $item->getCategoria();

                    $nomeCategoria = $controleCategoria->select($categoria, 2);

                    echo "<div class='categoria'>

                        ".strtoupper($nomeCategoria->getNome())."

                    </div>";

                }

                echo

                "<div class='produto'>

                    <div class='imagem'>

                        <div class='titulo'>".strtoupper($item->getNome())."</div>

                        <img src='../admin/".$item->getFoto()."'>

                    </div>

                    <div class='descricao'>

                        <div class='titulo'>DESCRIÇÃO</div>

                        <div class='texto'>".html_entity_decode($item->getDescricao())."</div>
                        
                        <button id='addCarrinho' data-url='ajax/add-carrinho.php' data-cod='".$item->getCod_cardapio()."' class='btn btn-default'>Adicionar ao pedido.</button>

                    </div>

                </div>"

                /*"<div class='produto'>

                    <div class='imagem'>

                        <div class='titulo'>".strtoupper($item->getNome())."</div>

                        <img src='../admin/".$item->getFoto()."'>

                    </div>

                    <div class='descricao'>

                        <div class='titulo'>DESCRIÇÃO</div>

                        <div class='texto'>".html_entity_decode($item->getDescricao())."

                        </div>

                        <button class='compartilhar' data-toggle='modal' data-target='#socialButton".$i."'><img src='../../home/img/to share.png'></button>

                    </div>

                    <div id='socialButton".$i."' class='modal fade' role='dialog' style='outline: none;margin-top:15%;'>

                       <div class='modal-dialog modal-sm'>

                           <!-- Modal content-->

                           <div class='modal-content' style='border-radius:0px !important;width:250px !important;'>                           

                               <div class='modal-body'>                            

                               <button type='button' class='close' data-dismiss='modal'>&times;</button>

                               <h4 class='modal-title'><strong>Compartilhar</strong></h4>

                               <br>

                                   <div id='social-buttons".$i."'></div>

                               </div>      

                           </div>

                       </div>

                   </div>

                </div>"*/;

            }

            if ($paginas > 1 ) {

            echo "<div class='paginacao'>

                    <nav aria-label='Page navigation'>

                        <ul class='pagination'>";

                        if ($pagina != 1 ) {

                            $prev = $pagina-1;

                            echo"<li>

                            <a href='#' aria-label='Previous' onclick='buscar(".$prev.",\"".$busca."\",\"busca\");return false'>

                                <img src='img/seta-direita-paginacao.png'>

                            </a>

                            </li>";

                        }

                        if ($pagina == 1) {

                        echo "<li class='active'><a href='#' id='1' onclick='buscar(1,\"".$busca."\",\"busca\");return false'>1</a></li>";

                        }else{

                            echo "<li><a href='#' id='1' onclick='buscar(1,\"".$busca."\",\"busca\");return false'>1</a></li>";

                        }

                        for ($i=2; $i <= $paginas-1; $i++) { 

                            if ($i == $pagina) {

                                echo "<li class='active'><a href='#' id='".$i."' onclick='buscar(".$i.",\"".$busca."\",\"busca\");return false'>".$i."</a></li>";

                            }else{



                            echo "<li><a href='#' id='".$i."' onclick='buscar(".$i.",\"".$busca."\",\"busca\");return false'>".$i."</a></li>";

                            }

                        }

                        if ($pagina == $paginas) {

                        echo "<li class='active'><a href='#' id='".$paginas."' onclick='buscar(".$paginas.",\"".$busca."\",\"busca\");return false'>".$paginas."</a></li>";

                        }else{

                            echo "<li><a href='#' id='".$paginas."' onclick='buscar(".$paginas.",\"".$busca."\",\"busca\");return false'>".$paginas."</a></li>";

                        }

                        if ($paginas != $pagina ) {

                            $next = $pagina+1;

                            echo"<li>

                            <a href='#' aria-label='Next' onclick='buscar(".$next.",\"".$busca."\",\"busca\");return false'>

                                <img src='img/seta-esquerda-paginacao.png'>

                            </a>

                            </li>";

                        }

                    echo"</ul>

                    </nav>

                </div>";

            }else{

                echo "<br>";

            }

        }else{

            echo "<div>Nenhum produto encontrado!</div><br/>";

        }

    }elseif ($_GET['tipo'] == 'categoria') {

        $busca = addslashes(htmlspecialchars($_GET['search']));

        $controleCategoria=new controlerCategoria(conecta());

        $controleCardapio=new controlerCardapio(conecta());

        // ============================================

        // Monta outra consulta MySQL para a busca

        $por_pagina = 6;

        if (isset($_GET['page']) && !empty($_GET['page'])) {

            $pagina = (int)$_GET['page'];

        } else {

            $pagina = 1;

        }

        $quantidade = $controleCardapio->select($busca,2);

        $total = count($quantidade);

        $offset = ($pagina - 1) * $por_pagina;

        $itens = $controleCardapio->selectPaginadoCategoria($busca,$offset,$por_pagina);

        $paginas = (($total % $por_pagina) > 0) ? (int)($total / $por_pagina) + 1 : ($total / $por_pagina);

        $paginasCategoria = $paginas;



        $j= 0;

        $categoria = "";

        foreach ($itens as $item) {

            $j++;

            if ($categoria != $item->getCategoria()) {

                $categoria = $item->getCategoria();

                $nomeCategoria = $controleCategoria->select($categoria, 2);

                echo "<div class='categoria'>".strtoupper($nomeCategoria->getNome())."</div>";

            }

            echo

            "<div class='produto'>

                <div class='imagem'>

                    <div class='titulo'>".strtoupper($item->getNome())."</div>

                    <img src='../admin/".$item->getFoto()."'>

                </div>

                <div class='descricao'>

                    <div class='titulo'>DESCRIÇÃO</div>

                    <div class='texto'>".html_entity_decode($item->getDescricao())."
                    <p>".$item->getPreco()."</p>
                    
                    <button id='addCarrinho' data-url='ajax/add-carrinho.php' data-cod='".$item->getCod_cardapio()."' class='btn btn-default'>Adicionar ao pedido.</button>

                    </div>

                </div>

            </div>"

            /*"<div class='produto'>

                <div class='imagem'>

                    <div class='titulo'>".strtoupper($item->getNome())."</div>

                    <img src='../admin/".$item->getFoto()."'>

                </div>

                <div class='descricao'>

                    <div class='titulo'>DESCRIÇÃO</div>

                    <div class='texto'>".html_entity_decode($item->getDescricao())."

                    </div>

                    <button class='compartilhar' data-toggle='modal' data-target='#socialButton".$i."'><img src='../../home/img/to share.png'></button>

                </div>

                <div id='socialButton".$i."' class='modal fade' role='dialog' style='outline: none;margin-top:15%;'>

                       <div class='modal-dialog modal-sm'>

                           <!-- Modal content-->

                           <div class='modal-content' style='border-radius:0px !important;width:250px !important;'>                           

                               <div class='modal-body'>                            

                               <button type='button' class='close' data-dismiss='modal'>&times;</button>

                               <h4 class='modal-title'><strong>Compartilhar</strong></h4>

                               <br>

                                   <div id='social-buttons".$i."'></div>

                               </div>      

                           </div>

                       </div>

                   </div>

            </div>"*/;

        }

        if ($paginas > 1 ) {

        echo "<div class='paginacao'>

                <nav aria-label='Page navigation'>

                    <ul class='pagination'>";

                    if ($pagina != 1 ) {

                        $prev = $pagina-1;

                        echo"<li>

                        <a href='#' aria-label='Previous' onclick='buscar(".$prev.",\"".$busca."\",\"categoria\");return false'>

                            <img src='img/seta-direita-paginacao.png'>

                        </a>

                        </li>";

                    }

                    for ($j=1; $j <= $paginas; $j++) { 

                        if ($j == $pagina) {

                            echo "<li class='active'><a href='#' id='".$j."' onclick='buscar(".$j.",\"".$busca."\",\"categoria\");return false'>".$j."</a></li>";

                        }else{



                        echo "<li><a href='#' id='".$j."' onclick='buscar(".$j.",\"".$busca."\",\"categoria\");return false'>".$j."</a></li>";

                        }

                    }

                    if ($paginas != $pagina ) {

                        $next = $pagina+1;

                        echo"<li>

                        <a href='#' aria-label='Next' onclick='buscar(".$next.",\"".$busca."\",\"categoria\");return false'>

                            <img src='img/seta-esquerda-paginacao.png'>

                        </a>

                        </li>";

                    }

                echo"</ul>

                </nav>

            </div>";

        }else{

            echo "<br>";

        }

    }

