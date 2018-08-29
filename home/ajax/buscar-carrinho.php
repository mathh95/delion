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
        <h1>Lista de produtos no carrinho</h1>
        <?php print_r($_SESSION['qtd']); ?>
        <?php print_r($_SESSION['carrinho']); ?>
        <div class="table-responsive categoria">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr id="cabecalhoTabela">
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
                        <td><i id="removeItem" data-toggle="tooltip" title="Remover item!" data-linha="<?=$i?>" class="fas fa-trash-alt btn"></i></td>
                        <td class="text-uppercase"><strong><?=$item['nome']?></strong></td>
                        <td id="preco<?=$i?>" data-preco="<?=$item['preco']?>"><strong>R$ <?=$item['preco']?></strong></td>
                        <td id="subtotal<?=$i?>"><strong>R$ <?=$item['preco']?></strong></td>
                        <td><input style="border:none;background-color:transparent;width:30px;" id="qtdUnidade<?=$i?>" name="quantidade" type="number" value=1 readonly="true">
                            <i id="adicionarUnidade" data-toggle="tooltip" title="Adicione 1." data-linha="<?=$i?>" class="fas fa-cart-plus fa-lg btn"></i>
                            <i id="removerUnidade" data-toggle="tooltip" title="Remove 1." data-linha="<?=$i?>" class="fas fa-cart-arrow-down fa-lg btn"></i></td>
                    </tr>
            <?php $i++; $total += $item['preco']; endforeach;
            $_SESSION['totalCarrinho'] = $total;
    
    echo "</tbody>
        </table>
        </div>
        <strong><p class='text-right' id='total'>Valor total do pedido: R$".$_SESSION['totalCarrinho']."</p></strong>
        <a href='../home/ajax/enviarEmailPedido.php'><button id='finalizar' style='float:right;margin:10px;' class='btn btn-default'>Finalizar pedido <i class='far fa-envelope fa-lg'></i></button></a>
        <a style='float:right;margin:10px;' onclick='esvaziar()' href='cardapio.php'><button class='btn btn-danger'>Esvaziar carrinho <i class='fas fa-trash-alt fa-lg'></i></button></a>";

        

// $pedido->finalizarPedido();

}else{
    echo "<h1>NENHUM ITEM NO CARRINHO</h1>";
}

?>

<!-- <script>

    

</script> -->