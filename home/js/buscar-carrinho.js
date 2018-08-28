$(document).on("click", "#finalizar", function(){
        
    $.ajax({
        type: 'GET',

        url: 'ajax/enviarEmailPedido.php',

        success:function(resultado){
            alert("EU VO MATA O JAVA SCRIPTOKKKKK");
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    }); 
});

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

        data: {acao: acao, preco: preco, qtdAtual: qtdAtual, linha: linha},

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

        data: {acao: acao, preco: preco, qtdAtual: qtdAtual, linha: linha},

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