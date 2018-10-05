$(document).ready(function () {

    $.ajax({
        type: 'GET',

        url: 'ajax/buscar-endereco.php',

        data: {tipo : 'ativo'},

        success: function (resultado) {
            $(".lista").html(resultado);
            html = "<button onclick='listarInativos()'>LISTAR ENDEREÇOS EXCLUIDOS</button>"
            $('.listar').html(html);
        }
    });
});

function listarAtivos(){
    $.ajax({
        type: 'GET',

        url: 'ajax/buscar-endereco.php',

        data: {tipo : 'ativo'},

        success: function (resultado) {
            $(".lista").html(resultado);
            html = "<button onclick='listarInativos()'>LISTAR ENDEREÇOS EXCLUIDOS</button>"
            $('.listar').html(html);
        }
    });
}

function listarInativos(){
    $.ajax({
        type: 'GET',

        url: 'ajax/buscar-endereco.php',

        data: {tipo : 'inativo'},

        success: function (resultado) {
            $(".lista").html(resultado);
            html = "<button  onclick='listarAtivos()'>LISTAR ENDEREÇOS ATIVOS</button>"
            $('.listar').html(html);
        }
    });
}

function cadastrarEndereco(){
    $.ajax({
        type: 'GET',

        url: 'ajax/salvar-endereco.php',
        success: function (resultado) {
            $(".opcoes").html(resultado);
            html = "<button onclick='listarAtivos()'>LISTAR ENDEREÇOS ATIVOS</button>"
            $('.listar').html(html);
        }
    });
}

function alterarEndereco(endereco){
    $.ajax({
        type: 'GET',

        url: 'ajax/salvar-endereco.php',

        data: {endereco:endereco},

        success: function (resultado) {
            $(".opcoes").html(resultado);
            html = "<button onclick='listarAtivos()'>LISTAR ENDEREÇOS ATIVOS</button>"
            $('.listar').html(html);
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

  function ativarEndereco(endereco){
    $.ajax({
            
        type:'GET',
        
        url: 'ajax/restaurar-endereco.php',
        
        data: {endereco : endereco}
        ,
        success:function(resultado){
            if (resultado < 0){
                swal("Não foi possível ativar endereço", "erro!", "error");
                reloadEnderecosAtivos();
            }else{
                swal("Endereço ativado com sucesso!", "Excluido!", "success");
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

  function autoCompletar(rua,bairro,cep){
    $.ajax({
        type:'GET',
        url: 'ajax/salvar-endereco.php',
        data:{rua:rua, bairro:bairro, cep:cep},
        success:function(resultado){
            $('.opcoes').html(resultado);
            html = "<a href='#' onclick='listarAtivos()'><button>LISTAR ENDEREÇOS ATIVOS</button></a>"
            $('.listar').html(html);
        }
    });
  }