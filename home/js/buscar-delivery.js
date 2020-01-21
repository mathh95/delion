function delivery(ativo, busca, pagina) {
    if (ativo.checked) {
            $.ajax({

            type:'GET',
            url: 'ajax/buscar-cardapio.php',
            data: {page: pagina, search: busca, tipo: 'busca', delivery:true},

            success:function(resultado){

                $( "#delivery").prop( "checked", true );
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