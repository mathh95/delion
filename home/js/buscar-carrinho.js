
$(document).on('click', '.tipo-entrega', function(){

    $('.tipo-entrega').removeClass('active');

    if(this.id == 'balcao'){
        
        $("#balcao").addClass('active');

        $('#infoDelivery').hide();
        $('#infoPercurso').hide();
        $('#infoBalcao').show();

        
        $.ajax({
            type: 'POST',
            url: 'ajax/entrega-carrinho.php',
            data: {acao: "balcao"},
            success:function(result){
                var res = JSON.parse(result);
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

        $("#delivery").addClass('active');
        
        $('#infoDelivery').show();
        $('#infoPercurso').show();
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


function removerEndereco(){
    $.ajax({
        type: 'POST',
        url: 'ajax/entrega-carrinho.php',
        data: {acao: "rem_endereco"},
        success:function(result){
            location.reload();
        },
        error: function(err){
            location.reload();
            console.log(err);
        }
    });
}

function esvaziar(){

    var acao = "esv";

    $.ajax({
        type: 'GET',
        url: 'ajax/quantidade-carrinho.php',
        data: {acao: acao},
        
        success:function(resultado){
            window.location = '/home/cardapio.php';
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
            loadItens();
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
        data :{acao: "checar", codigocupom: codigocupom},
        success:function(resultado){
            // alert(resultado);

            if(resultado.valido){
                swal('Cupom Adicionado! 😉', 'Desconto de R$ '+resultado.valorcupom + ' ! =)', 'success')
                .then(function(){
                    loadItens();
                });
            }
            else if(resultado.validoErro){
                swal('Cupom Adicionado! 😉', 'O cupom de R$ '+resultado.valorcupom + ' é maior do que o valor total da compra, a diferença será perdida!', 'success')
                .then(function(){
                    loadItens();
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

function postObservacao(){
    var obs = $('#observacao').val();

    $.ajax({
        type: 'POST',
        url: 'ajax/obs-carrinho.php',
        data: {obs:obs},

        success: function (resultado) {}
    });
}


$(document).on("click", "#removeItemResgate", function(){
    
    var acao = "rem_resgate";
    var linha = $(this).data('linha');
    var id = $("#idLinha"+linha).data('id');

    $.ajax({
        type: 'GET',
        url: 'ajax/quantidade-carrinho.php',
        data: {acao: acao, id: id},

        success: function(res){
            // console.log(res);
            
            var tr = $("#idLinha"+linha).fadeOut(100, function(){
                tr.remove();
                window.location.reload();
            });
        },
        error: function(res){
            
        }
    });
});


$(document).on("click", "#removeItem", function(){
    var acao = "rem";
    var linha = $(this).data('linha');
    var id = $("#idLinha"+linha).data('id');
    var qtdAtual = $("#qtdUnidade"+linha).data("qtd");
    var preco = $("#preco"+linha).data('preco');

    $.ajax({
        type: 'GET',
        url: 'ajax/quantidade-carrinho.php',
        data: {acao: acao, preco: preco, qtdAtual: qtdAtual, id: id},

        success:function(resultado){
            var res = JSON.parse(resultado);

            var totalCarr = res.totalCarrinho;
            var totalDesc = res.totalComDesconto;
            var totalCorrigido = res.totalCorrigido;
            var taxaEntrega = res.taxaEntrega;

            $("#valor_subTotal").html(totalCarr.toFixed(2));
            $("#valor_taxa_entrega").html(taxaEntrega.toFixed(2));
            if(totalDesc < 0){
                $("#valor_total").html("0.00");
                atualizaFormaPgt(0);
            }else{
                $("#valor_total").html(totalCorrigido.toFixed(2));
                atualizaFormaPgt(totalCorrigido.toFixed(2));
            }

            $("#valor_subTotal").html(totalCarr.toFixed(2));
            $("#valor_taxa_entrega").html(taxaEntrega.toFixed(2));
            $("#valor_total").html(totalDesc.toFixed(2));
            
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
    var qtdAtual = $("#qtdUnidade"+linha).data("qtd");
    var preco = $("#preco"+linha).data('preco');
    var qtdInt = parseInt(qtdAtual);
    var subtotal = preco * (qtdInt+1);

    //incremento antes do retorno, melhor fluidez p/ o cliente
    $("#qtde-text"+linha).text(qtdInt+1);
   
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
            var taxaEntrega = res.taxaEntrega;
            
            qtdInt += 1;
            $("#qtdUnidade"+linha).data("qtd", qtdInt);
            $("#qtdUnidade"+linha).attr("data-qtd", qtdInt);
            $("#qtde-text"+linha).text(qtdInt);


            $("#subtotal"+linha).html("<strong>R$ "+subtotal.toFixed(2)+"</strong>");   
            
            $("#valor_subTotal").html(totalCarr.toFixed(2));
            $("#valor_taxa_entrega").html(taxaEntrega.toFixed(2));
            $("#valor_desconto").html(valorCup.toFixed(2));
            if(totalDesc < 0){
                $("#valor_total").html("0.00");
                atualizaFormaPgt(0);
            }else{
                $("#valor_total").html(totalCorrigido.toFixed(2));
                atualizaFormaPgt(totalCorrigido.toFixed(2));
            }
        },
        error: function(err){
            //desfaz o incremento
            $("#qtde-text"+linha).text(qtdInt-1);
            console.log(err);
        }
    });
});

$(document).on("click", "#removerUnidade", function(){
    
    var acao = "-";
    var linha = $(this).data('linha');
    var id = $("#idLinha"+linha).data('id');
    var qtdAtual = $("#qtdUnidade"+linha).data("qtd");
    var preco = $("#preco"+linha).data('preco');
    var qtdTotal = parseInt(qtdAtual); 
    qtdTotal-= 1;
    var subtotal = preco * qtdTotal;
    
    //decrementa antes do retorno, melhor fluidez p/ o cliente
    $("#qtde-text"+linha).text(qtdTotal-1);

    if(qtdTotal > 0){
        $.ajax({
            
            type: 'GET',
            url: 'ajax/quantidade-carrinho.php',
            data: {acao: acao, preco: preco, qtdAtual: qtdAtual, linha: linha},
            
            success:function(resultado){
                var res = JSON.parse(resultado);
                //console.log(res);
                var totalCarr = res.totalCarrinho;
                var valorCup = parseFloat(res.valorcupom);
                var totalDesc = res.totalComDesconto;
                var totalCorrigido = res.totalCorrigido;
                var taxaEntrega = res.taxaEntrega;

                $("#qtdUnidade"+linha).data("qtd", qtdTotal);
                $("#qtdUnidade"+linha).attr("data-qtd", qtdTotal);
                $("#qtde-text"+linha).text(qtdTotal);
                
                $("#subtotal"+linha).html("<strong>R$ "+subtotal.toFixed(2)+"</strong>");
                
                $("#valor_subTotal").html(totalCarr.toFixed(2));
                $("#valor_taxa_entrega").html(taxaEntrega.toFixed(2));
                $("#valor_desconto").html(valorCup.toFixed(2));
                if(totalDesc < 0){
                    $("#valor_total").html("0.00");
                    atualizaFormaPgt(0);
                }else{
                    $("#valor_total").html(totalCorrigido.toFixed(2));
                    atualizaFormaPgt(totalCorrigido.toFixed(2));
                }
            },
            error: function(err){
                console.log(err);
                //desfaz o decremento
                $("#qtde-text"+linha).text(qtdTotal+1);
            }
        });
    
    //remove item quando qtd 0
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