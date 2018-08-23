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
                        <th>Excluir</th>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th>Quantidade</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
        
                <?php $total = 0; 
                $i = 0;
                foreach($itens as $item): ?>
                    <tr id="idLinha<?=$i?>" data-id="<?=$item['cod_cardapio']?>">
                        <td><button id="removeItem" data-linha="<?=$i?>" class="btn btn-danger">X</button></td>
                        <td><strong><?=$item['nome']?></strong></td>
                        <td id="preco<?=$i?>" data-preco="<?=$item['preco']?>">R$ <?=$item['preco']?></td>
                        <td><input id="qtdUnidade<?=$i?>" name="quantidade" type="number" value=1 readonly="true"><button id="adicionarUnidade" data-linha="<?=$i?>" class="btn btn-success">+</button><button id="removerUnidade" data-linha="<?=$i?>" class="btn btn-danger">-</button></td>
                        <td><img style="width:200px;heigth:150px;" src="../admin/<?=$item['foto']?>"></td>
                    </tr>
            <?php $i++; $total += $item['preco']; endforeach;
            $_SESSION['totalCarrinho'] = $total;
    
    echo "</tbody>
        </table>
        </div>
        <p id='total'>Valor total do pedido: R$".$_SESSION['totalCarrinho']."</p>
        <button class='btn btn-default'>Finalizar pedido</button>";

        
}else{
    echo "<h1>NENHUM ITEM NO CARRINHO</h1>";
}

?>

<script>

    $(document).on("click", "#removeItem", function(){
        var acao = "rem";
        var linha = $(this).data('linha');
        var id = $("#idLinha"+linha).data('id');
        var qtdAtual = $("#qtdUnidade"+linha).val();
        var preco = $("#preco"+linha).data('preco');

        $.ajax({
            type: 'GET',

            url: 'ajax/quantidade-carrinho.php',

            data: {acao: acao, preco: preco, qtdAtual: qtdAtual, id: id},

            success:function(resultado){
                $("#total").html(resultado);
                var tr = $("#idLinha"+linha).fadeOut(1000, function(){
                    tr.remove();
                });
            }
        });
    });

    $(document).on("click", "#adicionarUnidade", function(){
        
        var acao = "+";
        var linha = $(this).data('linha');
        var qtdAtual = $("#qtdUnidade"+linha).val();
        var preco = $("#preco"+linha).data('preco');
        var qtdInt = parseInt(qtdAtual);
       
        $.ajax({
            //falta pensar em uma forma de mandar o preço pra outra página...
            type: 'GET',

            url: 'ajax/quantidade-carrinho.php',

            data: {acao: acao, preco: preco},

            success:function(resultado){
                $("#total").html(resultado);
                $("#qtdUnidade"+linha).val(qtdInt+= 1);
            }
        });
    });

    $(document).on("click", "#removerUnidade", function(){
        
        var acao = "-";
        var linha = $(this).data('linha');
        var id = $("#idLinha"+linha).data('id');
        var qtdAtual = $("#qtdUnidade"+linha).val();
        var preco = $("#preco"+linha).data('preco');
        var qtdTotal = parseInt(qtdAtual); 
        qtdTotal-= 1;

        if(qtdTotal > 0){
            $.ajax({
            
            type: 'GET',

            url: 'ajax/quantidade-carrinho.php',

            data: {acao: acao, preco: preco},

            success:function(resultado){
                $("#total").html(resultado);
                $("#qtdUnidade"+linha).val(qtdTotal);
            }
        });
        }else if(qtdTotal <= 0){
            $.ajax({
            
            type: 'GET',

            url: 'ajax/quantidade-carrinho.php',

            data: {acao: acao, preco: preco, id: id},

            success:function(resultado){
                $("#total").html(resultado);
                var tr = $("#idLinha"+linha).fadeOut(1000, function(){
                    tr.remove();
                });
            }
        });
        }
    });

</script>