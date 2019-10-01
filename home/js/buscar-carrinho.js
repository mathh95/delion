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

        url: 'ajax/quantidade-carrinho.php',

        data: {acao: acao},
        
        success:function(resultado){
            window.location='/home/cardapio.php';
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
            $("#subTotal").html(resultado.totalCarrinho);
            $("#totalDescontado").html(resultado.totalComDesconto);
            
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
            var res = JSON.parse(resultado);
            var totalCarr = res.totalCarrinho;
            var valorCup = parseFloat(res.valorcupom);
            var totalDesc = res.totalComDesconto;

            
            $("#qtdUnidade"+linha).val(qtdInt+= 1);
            $("#subTotal").html("Subtotal: R$ "+totalCarr.toFixed(2));
            $("#desconto").html("Desconto: R$ "+valorCup.toFixed(2));
            if(totalDesc < 0){
                $("#totalDescontado").html("Total: R$ 0.00");
            }else{
                $("#totalDescontado").html("Total: R$ "+totalDesc.toFixed(2));
            }
            console.log(totalDesc);
            $("#subtotal"+linha).html("<strong>R$ "+subtotal.toFixed(2)+"</strong>");
            
            
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
            var totalCarr = res.totalCarrinho;
            var valorCup = parseFloat(res.valorcupom);
            var totalDesc = res.totalComDesconto;
            $("#subTotal").html("Subtotal: R$ "+totalCarr.toFixed(2));
            $("#desconto").html("Desconto: R$ "+valorCup.toFixed(2));
            if(totalDesc < 0){
                $("#totalDescontado").html("Total: R$ 0.00");
            }else{
                $("#totalDescontado").html("Total: R$ "+totalDesc.toFixed(2));
            }
            console.log(totalDesc);
            $("#qtdUnidade"+linha).val(qtdTotal);
            $("#subtotal"+linha).html("<strong>R$ "+subtotal.toFixed(2)+"</strong>");
        }
    });
    }else if(qtdTotal <= 0){
        $.ajax({
        
        type: 'GET',

        url: 'ajax/quantidade-carrinho.php',

        data: {acao: acao, preco: preco, id: id},

        success:function(resultado){
            $("#subTotal").html(resultado.totalCarrinho);
            $("#totalDescontado").html(resultado.totalComDesconto);
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