function delivery(ativo, busca, pagina) {
    if (ativo.checked) {
         $.ajax({

            type:'GET',

            url: 'ajax/buscar-cardapio.php',

            data: {page: pagina, search: busca, tipo: 'busca', delivery:true},

            success:function(resultado){

                $( "#delivery" ).prop( "checked", true );
                
                $('.produtos').html(resultado);
            }

        }); 
    } else {
        $.ajax({
            
            type:'GET',
            
            url: 'ajax/buscar-cardapio.php',
            
            data: {page: pagina, search: busca, tipo: 'busca'},
            
            success:function(resultado){
                
                $('.produtos').html(resultado);
                
                $( "#delivery" ).prop( "checked", false );
            }

        });
    }
  }

  function delivery(ativo, busca, pagina) {
    if (ativo.checked) {
         $.ajax({

            type:'GET',

            url: 'ajax/buscar-cardapio.php',

            data: {page: pagina, search: busca, tipo: 'busca', delivery:true},

            success:function(resultado){

                $( "#delivery" ).prop( "checked", true );
                
                $('.produtos').html(resultado);
            }

        }); 
    } else {
        $.ajax({
            
            type:'GET',
            
            url: 'ajax/buscar-cardapio.php',
            
            data: {page: pagina, search: busca, tipo: 'busca'},
            
            success:function(resultado){
                
                $('.produtos').html(resultado);
                
                $( "#delivery" ).prop( "checked", false );
            }

        });
    }
  }

  function deliveryCategoria(ativo, busca, pagina) {
    if (ativo.checked) {
         $.ajax({

            type:'GET',

            url: 'ajax/buscar-cardapio.php',

            data: {page: pagina, search: busca, tipo: 'categoria', delivery:true},

            success:function(resultado){

                $( "#delivery" ).prop( "checked", true );
                
                $('.produtos').html(resultado);
            }

        }); 
    } else {
        $.ajax({
            
            type:'GET',
            
            url: 'ajax/buscar-cardapio.php',
            
            data: {page: pagina, search: busca, tipo: 'categoria'},
            
            success:function(resultado){
                
                $('.produtos').html(resultado);
                
                $( "#delivery" ).prop( "checked", false );
            }

        });
    }
  }

  function tipoPedido(resultado){
    var check = resultado;
    $.ajax({
            
        type:'GET',
        
        url: 'ajax/buscar-carrinho.php',
        
        data: {delivery : resultado}
        ,
        success:function(resultado){
            $('.itens').html(resultado);
            
            if(check > 0){
                $("#delivery").button('toggle');
                $("#delivery").addClass("ativo");
            }else{
                $("#balcao").button('toggle');
                $("#delivery").addClass("ativo");
            }
        }

    });
  }

  function excluirEndereco(endereco){
    $.ajax({
            
        type:'GET',
        
        url: 'ajax/excluir-endereco.php',
        
        data: {endereco : endereco}
        ,
        success:function(resultado){
            if (resultado < 0){
                swal("Não foi possível excluir endereço", "erro!", "error");
                reloadEnderecosAtivos();
            }else{
                swal("Endereço excluido com sucesso!", "Excluido!", "success");
                reloadEnderecosAtivos();
            }
        }

    });
  }

  function reloadEnderecosAtivos(){
    $.ajax({
        type:'GET',
        url: 'ajax/buscar-endereco.php',
        data:{tipo:'ativo'},
        success:function(resultado){
            $('.lista').html(resultado);
            html = "<a href='#' onclick='listarInativos()'><button>LISTAR ENDEREÇOS EXCLUIDOS</button></a>"
            $('.listar').html(html);
        }
    });
  }

  function reloadEnderecosInativos(){
    $.ajax({
        type:'GET',
        url: 'ajax/buscar-endereco.php',
        data:{tipo:'inativo'},
        success:function(resultado){
            $('.lista').html(resultado);
            html = "<a href='#' onclick='listarAtivos()'><button>LISTAR ENDEREÇOS ATIVOS</button></a>"
            $('.listar').html(html);
        }
    });
  }