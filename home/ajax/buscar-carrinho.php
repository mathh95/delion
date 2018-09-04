<?php
session_start();

ini_set('display_errors', true);

date_default_timezone_set('America/Sao_Paulo');


include_once "../../admin/controler/conexao.php";

require_once "../controler/controlCarrinho.php";

require_once "../controler/controlCardapio.php";

include_once "../lib/alert.php";

// require_once '../ajax/enviarEmailPedido.php';

$itens = array();
$cardapio = new controlerCardapio(conecta());
// $pedido = new enviarEmailPedido;




if(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])){
    $itens = $_SESSION['carrinho'];
    foreach ($_SESSION['qtd'] as $key => $value) {
        $_SESSION['qtd'][$key] = 1;
    }
}else{
    $_SESSION['carrinho'] = array();
    $_SESSION['qtd'] = array();
    $itens = $_SESSION['carrinho'];
}
if(count($itens) > 0){
    
    $itens = $cardapio->buscarVariosId($itens);
?>

        <script type="text/javascript" src="js/buscar-carrinho.js"></script>
        <h1 class="text-center">Pedido</h1>
        <?php //print_r($_SESSION['qtd']); ?>
        <?php //print_r($_SESSION['carrinho']); ?>
        <div class="carrinho row">
            <table class="tabela_itens table table-hover table-responsive table-condensed">
                <thead>
                    <tr id="cabecalhoTabela" >
                        <th>Excluir</th>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th>Subtotal</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>
        
                <?php $total = 0; 
                $i = 0;
                foreach($itens as $item): ?>
                    <tr id="idLinha<?=$i?>" data-id="<?=$item['cod_cardapio']?>">
                        <td><i id="removeItem" data-toggle="tooltip" title="Remover item!" data-linha="<?=$i?>" class="fas fa-trash-alt btn iconeRemoverProdutoTabela"></i></td>
                        <td class="text-uppercase nomeProdutoTabela"><strong><?=$item['nome']?></strong></td>
                        <td class="precoProdutoTabela" id="preco<?=$i?>" data-preco="<?=$item['preco']?>"><strong>R$ <?=$item['preco']?></strong></td>
                        <td class="subtotalProdutoTabela" id="subtotal<?=$i?>"><strong>R$ <?=$item['preco']?></strong></td>
                        <td>
                            <input class="quantidadeItemTabela" id="qtdUnidade<?=$i?>" name="quantidade" type="number" value=1 readonly="true">
                            <i id="adicionarUnidade" data-toggle="tooltip" title="Adicione 1." data-linha="<?=$i?>" class="fas fa-cart-plus fa-lg btn iconeAdicionarProdutoTabela"></i>
                            <i id="removerUnidade" data-toggle="tooltip" title="Remove 1." data-linha="<?=$i?>" class="fas fa-cart-arrow-down fa-lg btn iconeExcluirProdutoTabela"></i></td>
                    </tr>
            <?php $i++; $total += $item['preco']; endforeach;
            $_SESSION['totalCarrinho'] = $total;
    
    echo "</tbody>
        </table>
        </div>
        <div class='rodapeCarrinho row'>
            <strong><p class='text-right' id='total'>Valor total do pedido: R$".$_SESSION['totalCarrinho']."</p></strong>
            <a href='../home/ajax/enviarEmailPedido.php'><button id='finalizar' class='btn btn-default botaoCarrinhoEnviar'>Finalizar pedido <i class='far fa-envelope fa-adjust'></i></button></a>
            <a onclick='esvaziar()' href='cardapio.php'><button class='btn btn-danger botaoCarrinhoEsvaziar'>Esvaziar carrinho <i class='fas fa-trash-alt'></i></button></a>
        </div>";

        

// $pedido->finalizarPedido();

}else{
    echo "<div class='container row carrinhoVazio' style='margin:20px;'>
            <div class='imagemCarrinhoVazio'>
                <img src='img/carrinho_vazio.png'>
            </div>
            <div class='textoCarrinhoVazio'>
                <h1 class='text-left tituloCarrinhoVazio'>Seu carrinho ainda está vazio!!</h1>
                <p>Quer conhecer nossos produtos ? Dê uma olhada no nosso cardápio, você pode pedir antecipado, ou pedir para entregar, confira!</p>
            </div>
          </div>";
          
}

?>

<!-- <script>

    

</script> -->