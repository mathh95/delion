<?php
session_start();

ini_set('display_errors', true);

date_default_timezone_set('America/Sao_Paulo');



include_once "../../admin/controler/conexao.php";

require_once "../controler/controlCarrinho.php";

require_once "../controler/controlCardapio.php";

include_once "../lib/alert.php";

$itens = array();
$cardapio = new controlerCardapio(conecta());
// $_SESSION['carrinho'] = ['14','16','17'];


if(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])){
    $itens = $_SESSION['carrinho'];
}else{
    $_SESSION['carrinho'] = array();
    $itens = $_SESSION['carrinho'];
}
if(count($itens) > 0){
    
    $itens = $cardapio->buscarVariosId($itens);
?>

   
        <h1>Lista de produtos no carrinho</h1>
        <div class="table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Descrição</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
        
                <?php foreach($itens as $item): ?>
                    <tr>
                        <td><strong><?=$item['nome']?></strong></td>
                        <td><?=html_entity_decode($item['descricao'])?></td>
                        <td><img style="width:200px;heigth:150px;" src="../admin/<?=$item['foto']?>"></td>
                    </tr>
            <?php endforeach;
    
    echo "</tbody>
        </table>
        </div>
        <button class='btn btn-default'>Finalizar pedido</button>";


}else{
    echo "<h1>NENHUM ITEM NO CARRINHO</h1>";
}

?>