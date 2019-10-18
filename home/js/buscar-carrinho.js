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

// function atualizaValores(delivery, totalCorrigido){
//     $('#valor_taxa_entrega').html(delivery.toFixed(2));
//     $('#valor_total').html(totalCorrigido.toFixes(2));
//     return;
// }

$(document).on('click', '.active', function(){

    $(this).removeClass('active');
    if(this.id == 'balcao'){
        $('#infoDelivery').hide();
        $('#infoEntrega').hide();
        $('#infoBalcao').show();
        
        $.ajax({
            type: 'POST',
            url: 'ajax/entrega-carrinho.php',
            data: {acao: "balcao"},
            success:function(result){
                var res = JSON.parse(result);
                // console.log(res);
                var delivery_price = res.delivery_price;
                var totalCorrigido = res.totalCorrigido;
                
                $("#valor_taxa_entrega").html(delivery_price.toFixed(2));
                if(totalCorrigido < 0){
                    $("#valor_total").html("0.00");
                }else{
                    $("#valor_total").html(totalCorrigido.toFixed(2));
                }
            },
            error: function(err){
                console.log(err);
            }
        });
        
    }else if(this.id == 'delivery'){
        $('#infoDelivery').show();
        $('#infoEntrega').show();
        $('#infoBalcao').hide();
        
        $.ajax({
            type: 'POST',
            url: 'ajax/entrega-carrinho.php',
            data: {acao: "delivery"},
            success:function(result){
                var res = JSON.parse(result);
                // console.log(res);
                var delivery_price = res.delivery_price;
                var totalCorrigido = res.totalCorrigido;
            
                $("#valor_taxa_entrega").html(delivery_price.toFixed(2));
                if(totalCorrigido < 0){
                    $("#valor_total").html("0.00");
                }else{
                    $("#valor_total").html(totalCorrigido.toFixed(2));
                }
            },
            error: function(err){
                console.log(err);
            }
        });        
    }
});

function esvaziar(){
    var acao = "esv";

    $.ajax({
        type: 'GET',

        url: 'ajax/quantidade-carrinho.php',

        data: {acao: acao},
        
        success:function(resultado){
            window.location='/home/cardapio.php';
        }
    });
}

//Função que remove o cupom em uso do carrinho
function removerCupom(){
    var acao = "removeCupom";
    
    $.ajax({
        type: 'GET',

        url: 'ajax/quantidade-carrinho.php',

        data: {acao:acao},

        success:function(resultado){
            window.location='/home/carrinho.php';
        }
    });
}

// Funcao de Verificar status do cupom e se tem disponibilidade ao clicar no botao.
function adicionarCupom(){
    var codigocupom = $('#codigocupom').val();
    if(codigocupom.length == ''){
        swal('Atenção!' , 'Codigo vazio', 'warning');
        return false;
    }
    $.ajax({
        type: 'GET',
        url: 'ajax/cupom.php',
        data :{acao: "checar", codigocupom:codigocupom},
        success:function(resultado){
            // alert(resultado);

            if(resultado.valido){
                swal('Sucesso!', 'Aproveite o desconto de R$ '+resultado.valorcupom + ' ! =)', 'success')
                .then(function(){
                    //mudar -> reload apenas carrinho!
                    window.location.reload();
                });
            }
            else if(resultado.validoErro){
                swal('Sucesso!', 'O cupom de R$ '+resultado.valorcupom + ' é maior do que o valor total da compra, a diferença será perdida!', 'success')
                .then(function(){
                    //mudar -> reload apenas carrinho!
                    window.location.reload();
                });
            }
            
            else if(!resultado.valido){
                swal('Atenção!' , resultado.mensagem, 'warning');
            }
            
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
        
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
            $("#valor_subTotal").html(resultado.totalCarrinho);
            $("#valor_total").html(resultado.totalComDesconto);
            
            var tr = $("#idLinha"+linha).fadeOut(100, function(){
                tr.remove();
                window.location.reload();
                
            });
            $("#spanCarrinho").html(parseInt($("#spanCarrinho").text()) - 1);
            
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
        type: 'GET',

        url: 'ajax/quantidade-carrinho.php',

        data: {acao: acao, preco: preco, qtdAtual: qtdAtual, linha: linha},

        success:function(resultado){
            //console.log(resultado);
            var res = JSON.parse(resultado);
            //console.log(res);
            var totalCarr = res.totalCarrinho;
            var valorCup = parseFloat(res.valorcupom);
            var totalDesc = res.totalComDesconto;
            var totalCorrigido = res.totalCorrigido;
            
            $("#qtdUnidade"+linha).val(qtdInt+= 1);
            $("#subtotal"+linha).html("<strong>R$ "+subtotal.toFixed(2)+"</strong>");   
            
            $("#valor_subTotal").html(totalCarr.toFixed(2));
            $("#valor_desconto").html(valorCup.toFixed(2));
            if(totalDesc < 0){
                $("#valor_total").html("0.00");
            }else{
                $("#valor_total").html(totalCorrigido.toFixed(2));
            }
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
                var res = JSON.parse(resultado);
                console.log(res);
                var totalCarr = res.totalCarrinho;
                var valorCup = parseFloat(res.valorcupom);
                var totalDesc = res.totalComDesconto;
                var totalCorrigido = res.totalCorrigido;

                $("#qtdUnidade"+linha).val(qtdTotal);
                $("#subtotal"+linha).html("<strong>R$ "+subtotal.toFixed(2)+"</strong>");
                
                $("#valor_subTotal").html(totalCarr.toFixed(2));
                $("#valor_desconto").html(valorCup.toFixed(2));
                if(totalDesc < 0){
                    $("#valor_total").html("0.00");
                }else{
                    $("#valor_total").html(totalCorrigido.toFixed(2));
                }
            }
        });

    }else if(qtdTotal <= 0){
        $.ajax({
        
            type: 'GET',

            url: 'ajax/quantidade-carrinho.php',

            data: {acao: acao, preco: preco, id: id},

            success:function(resultado){
                $("#valor_subTotal").html(resultado.totalCarrinho);
                $("#valor_total").html(resultado.totalComDesconto);
                var tr = $("#idLinha"+linha).fadeOut(100, function(){
                    tr.remove();
                    window.location.reload();
                });
                $("#spanCarrinho").html(parseInt($("#spanCarrinho").text()) - 1);
            }
        });
    }
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});