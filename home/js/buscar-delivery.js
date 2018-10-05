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