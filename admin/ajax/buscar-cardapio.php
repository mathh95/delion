<?php
die('cade');

    /*mysql_set_charset('utf8');
    date_default_timezone_set('America/Sao_Paulo');

    include_once "../admin/controler/controlCardapio.php";
    include_once "../admin/controler/controlCategoria.php";
    include_once "../lib/alert.php";
    // Verifica se foi feita alguma busca
    // Caso contrario, redireciona o visitante pra home

    if (!isset($search)||empty($search)) {
        header("Location: /cardapio.php");
        exit;
    }
    // Conecte-se ao MySQL antes desse ponto
    // Salva o que foi buscado em uma variável
    $busca = mysql_real_escape_string($search);
    $controleCardapio=new controlerCardapio($_SG['link']);
    $controleCategoria=new controlerCategoria($_SG['link']);
    // ============================================
    // Monta outra consulta MySQL para a busca
    $por_pagina = 5;
    $total = $controleCardapio->countCardapio();
    $paginas = (($total % $por_pagina) > 0) ? (int)($total / $por_pagina) + 1 : ($total / $por_pagina);
    if (isset($page)) {
        $pagina = (int)$page;
    } else {
        $pagina = 1;
    }
    $pagina = max(min($paginas, $pagina), 1);
    $offset = ($pagina - 1) * $por_pagina;
    $itens = $controleCardapio->selectPaginado($busca,$offset,$por_pagina);
    $categoria = "";
    foreach ($itens as $item) {
        if ($categoria != $item->getCategoria()) {
            $categoria = $item->getCategoria();
            $nomeCategoria = $controleCategoria->select($categoria, 2);
            echo "<div class='categoria'>
                ".$nomeCategoria->getNome()."
            </div>";
        }
        echo
        "<div class='produto'>
            <div class='imagem'>
                <div class='titulo'>'".$item->getNome()."'</div>
                <img src='../".$item->getFoto()."'>
            </div>
            <div class='descricao'>
                <div class='titulo'>DESCRIÇÃO</div>
                <div class='texto'>".$item->getDescricao()."
                </div>
                <div class='compartilhar' id='share0'><img src='../../img/to share.png'></div>
            </div>
        </div>";
    }*/
    echo "cade";
