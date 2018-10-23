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

$("input:checkbox").on("click", function(){
    var linha = $(this).data('linha');
    var subtotal = $("#sub"+linha).val();
    var descontoBruto = $("#desc"+linha).val();
    var precoAdicional = $(this).data('preco');
    var desconto = $(this).data('desconto');
    if($(this).is(':checked')){
        var acao = "addAdicional";
        var novoDesconto = parseInt(desconto) + parseInt(descontoBruto);
        var novoSubtotal = parseInt(subtotal) + parseInt(precoAdicional);
    }else{
        var acao = "removeAdicional";
        var novoDesconto = parseInt(descontoBruto) - parseInt(desconto);
        var novoSubtotal = parseInt(subtotal) - parseInt(precoAdicional);
    }

    $.ajax({
        type:'POST',

        url:'ajax/quantidade-combo.php',

        data:{subtotal:subtotal, precoAdicional:precoAdicional, desconto:desconto, descontoBruto:descontoBruto, acao:acao},

        success:function(res){
            $("#total").html(res);
            $("#desc"+linha).val(novoDesconto);
            $("#sub"+linha).val(novoSubtotal);
        }
    });
});

function esvaziar(){
    var acao = "esv";

    $.ajax({
        type: 'POST',

        url: 'ajax/quantidade-combo.php',

        data: {acao: acao},
    });
}

$(document).on("click", "#finalizar", function(){
    adicionais = new Array();
    var i = 0;
    $(".produto").each(function(){
        adicional = new Array();
        $("input[type=checkbox][name='adicional"+i+"']:checked").each(function(){
            adicional.push($(this).val());
        });
        i++;
        adicionais.push(adicional);
    });

    $.ajax({
        type: 'POST',

        url: 'ajax/enviarEmailCombo.php',

        data: {adicionais:adicionais},

        success:function(res){
            $(".itens").html(res);
        }
    });
});

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