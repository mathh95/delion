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

//     function esvazia(){
//         $_SESSION['carrinho'] = array();
//         $_SESSION['totalCarrinho'] = 0;
//         header("Location: ".HOMEPATH); 
// }


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
        <button style='float:right;margin:10px;' class='btn btn-default'>Finalizar pedido <i class='far fa-envelope fa-lg'></i></button>
        <a style='float:right;margin:10px;' onclick='esvaziar()' href='cardapio.php'><button class='btn btn-danger'>Esvaziar carrinho <i class='fas fa-trash-alt fa-lg'></i></button></a>";


}else{
    echo "<h1>NENHUM ITEM NO CARRINHO</h1>";
}

?>

<script>

    function esvaziar(){
        var acao = "esv";

        $.ajax({
            type: 'GET',

            url: 'ajax/quantidade-carrinho.php',

            data: {acao: acao},
        });
    }

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
                var tr = $("#idLinha"+linha).fadeOut(100, function(){
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
        var subtotal = preco * (qtdInt+1);
       
        $.ajax({
            //falta pensar em uma forma de mandar o preço pra outra página...
            type: 'GET',

            url: 'ajax/quantidade-carrinho.php',

            data: {acao: acao, preco: preco},

            success:function(resultado){
                $("#total").html(resultado);
                $("#qtdUnidade"+linha).val(qtdInt+= 1);
                $("#subtotal"+linha).html("<strong>R$ "+subtotal+"</strong>");
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
        var subtotal = preco * qtdTotal;

        if(qtdTotal > 0){
            $.ajax({
            
            type: 'GET',

            url: 'ajax/quantidade-carrinho.php',

            data: {acao: acao, preco: preco},

            success:function(resultado){
                $("#total").html(resultado);
                $("#qtdUnidade"+linha).val(qtdTotal);
                $("#subtotal"+linha).html("<strong>R$ "+subtotal+"</strong>");
            }
        });
        }else if(qtdTotal <= 0){
            $.ajax({
            
            type: 'GET',

            url: 'ajax/quantidade-carrinho.php',

            data: {acao: acao, preco: preco, id: id},

            success:function(resultado){
                $("#total").html(resultado);
                var tr = $("#idLinha"+linha).fadeOut(100, function(){
                    tr.remove();
                });
            }
        });
        }
    });

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });

</script>