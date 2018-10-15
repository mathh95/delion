// $(document).on("click", "#finalizar", function(){
        
//     $.ajax({
//         type: 'POST',

//         url: 'ajax/enviarEmailPedido.php',

//         success:function(resultado){
//             alert("EU VO MATA O JAVA SCRIPTOKKKKK");
//         },
//         error: function (request, status, error) {
//             alert(request.responseText);
//         }
//     }); 
// });

function esvaziar(){
    var acao = "esv";

    $.ajax({
        type: 'GET',

        url: 'ajax/quantidade-combo.php',

        data: {acao: acao},
    });
}

$(document).on("click", "#removeItem", function(){
    var acao = "rem";
    var linha = $(this).data('linha');
    var id = $("#idLinha"+linha).data('id');
    var qtdAtual = $("#qtdUnidade"+linha).val();
    var preco = $("#preco"+linha).data('preco');
    var desconto = $("#preco"+linha).data('desconto');

    $.ajax({
        type: 'GET',

        url: 'ajax/quantidade-combo.php',

        data: {acao: acao, preco: preco, qtdAtual: qtdAtual, id: id, desconto:desconto},

        success:function(resultado){
            $("#total").html(resultado);
            var tr = $("#idLinha"+linha).fadeOut(100, function(){
                tr.remove();
            });
            $("#spanCombo").html(parseInt($("#spanCombo").text()) - 1);
        }
    });
});

$(document).on("click", "#adicionarUnidade", function(){
    
    var acao = "+";
    var linha = $(this).data('linha');
    var qtdAtual = $("#qtdUnidade"+linha).val();
    var preco = $("#preco"+linha).data('preco');
    var desconto = $("#preco"+linha).data('desconto');
    var qtdInt = parseInt(qtdAtual);
    var subtotal = preco * (qtdInt + 1);
    var descontoG = desconto / 100;
    descontoG = subtotal * descontoG;
    subtotal -= descontoG;

   
    $.ajax({
       
        type: 'GET',

        url: 'ajax/quantidade-combo.php',

        data: {acao: acao, preco: preco, qtdAtual: qtdAtual, linha: linha, desconto:desconto},

        success:function(resultado){
            $("#total").html(resultado);
            $("#qtdUnidade"+linha).val(qtdInt+= 1);
            $("#subtotal"+linha).html("<strong>R$ "+subtotal.toFixed(2)+"</strong>");
        }
    });
});

$(document).on("click", "#removerUnidade", function(){
    
    var acao = "-";
    var linha = $(this).data('linha');
    var id = $("#idLinha"+linha).data('id');
    var qtdAtual = $("#qtdUnidade"+linha).val() - 1;
    var preco = $("#preco"+linha).data('preco');
    var desconto = $("#preco"+linha).data('desconto');
    var subtotal = preco * qtdAtual;
    var descontoG = desconto / 100;
    descontoG = subtotal * descontoG;
    subtotal -= descontoG;

    if(qtdAtual > 0){
        $.ajax({
        
        type: 'GET',

        url: 'ajax/quantidade-combo.php',

        data: {acao: acao, preco: preco, qtdAtual: qtdAtual, linha: linha, desconto:desconto},

        success:function(resultado){
            $("#total").html(resultado);
            $("#qtdUnidade"+linha).val(qtdAtual);
            $("#subtotal"+linha).html("<strong>R$ "+subtotal.toFixed(2)+"</strong>");
        }
    });
    }else if(qtdAtual <= 0){
        $.ajax({
        
        type: 'GET',

        url: 'ajax/quantidade-combo.php',

        data: {acao: acao, preco: preco, id: id, desconto:desconto},

        success:function(resultado){
            $("#total").html(resultado);
            var tr = $("#idLinha"+linha).fadeOut(100, function(){
                tr.remove();
            });
            $("#spanCombo").html(parseInt($("#spanCombo").text()) - 1);
        }
    });
    }
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});