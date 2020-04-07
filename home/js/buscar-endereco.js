$(document).ready(function () {
    //
});

function loadEnderecos(flag_selecionar_end){
    $.ajax({
        type: 'GET',
        url: 'ajax/buscar-endereco.php',
        data: { tipo: 'ativo', is_selecao_end: flag_selecionar_end },
        success: function (resultado) {
            $(".lista").html(resultado);
            html = "<button onclick='listarInativos()' style='background-color: "+corSecundaria+";'>LISTAR ENDEREÇOS EXCLUIDOS</button>"
            $('.listar').html(html);
        }
    });
}

function listarAtivos() {
    $.ajax({
        type: 'GET',
        url: 'ajax/buscar-endereco.php',
        data: { tipo: 'ativo' },
        success: function (resultado) {
            $(".lista").html(resultado);
            html = "<button onclick='listarInativos()' style='background-color: "+corSecundaria+";'>LISTAR ENDEREÇOS EXCLUIDOS</button>";
            $('.listar').html(html);
        }
    });
}

function listarInativos() {
    $.ajax({
        type: 'GET',
        url: 'ajax/buscar-endereco.php',
        data: { tipo: 'inativo' },
        success: function (resultado) {
            $(".lista").html(resultado);
            html = "<button  onclick='listarAtivos()' style='background-color: "+corSecundaria+";'>LISTAR ENDEREÇOS ATIVOS</button>"
            $('.listar').html(html);
        }
    });
}

function cadastrarEndereco() {
    $.ajax({
        type: 'GET',

        url: 'ajax/salvar-endereco.php',
        success: function (resultado) {
            $(".opcoes").html(resultado);
            html = "<button onclick='listarInativos()' style='background-color: "+corSecundaria+";'>LISTAR ENDEREÇOS EXCLUIDOS </button>"
            $('.listar').html(html);
        }
    });
}

function alterarEndereco(endereco) {
    $.ajax({
        type: 'GET',
        url: 'ajax/salvar-endereco.php',
        data: { endereco: endereco },
        success: function (resultado) {
            $(".opcoes").html(resultado);
            html = "<button onclick='listarInativos()' style='background-color: "+corSecundaria+";'>LISTAR ENDEREÇOS EXCLUIDOS </button>"
            $('.listar').html(html);
        }
    });
}

function excluirEndereco(endereco) {
    $.ajax({

        type: 'GET',
        url: 'ajax/excluir-endereco.php',
        data: { endereco: endereco },
        success: function (resultado) {
            if (resultado < 0) {
                swal("Não foi possível excluir endereço", "erro!", "error");
                reloadEnderecosAtivos();
            } else {
                swal("Endereço excluido com sucesso!", "Excluido!", "success");
                reloadEnderecosAtivos();
            }
        }
    });
}

function ativarEndereco(endereco) {
    $.ajax({

        type: 'GET',
        url: 'ajax/restaurar-endereco.php',
        data: { endereco: endereco },
        success: function (resultado) {
            if (resultado < 0) {
                swal("Não foi possível ativar endereço", "erro!", "error");
                reloadEnderecosAtivos();
            } else {
                swal("Endereço ativado com sucesso!", "Excluido!", "success");
                reloadEnderecosAtivos();
            }
        }

    });
}

function reloadEnderecosAtivos() {
    $.ajax({
        type: 'GET',
        url: 'ajax/buscar-endereco.php',
        data: { tipo: 'ativo' },
        success: function (resultado) {
            $('.lista').html(resultado);
            html = "<button onclick='listarInativos()' style='background-color: "+corSecundaria+";'>LISTAR ENDEREÇOS EXCLUIDOS</button>"
            $('.listar').html(html);
        }
    });
}

function reloadEnderecosInativos() {
    $.ajax({
        type: 'GET',
        url: 'ajax/buscar-endereco.php',
        data: { tipo: 'inativo' },
        success: function (resultado) {
            $('.lista').html(resultado);
            html = "<button onclick='listarAtivos()' style='background-color: "+corSecundaria+";'>LISTAR ENDEREÇOS ATIVOS</button>"
            $('.listar').html(html);
        }
    });
}

function autoCompletar(rua, bairro, cep, cidade) {
    $.ajax({
        type: 'GET',
        url: 'ajax/salvar-endereco.php',
        data: { rua: rua, bairro: bairro, cep: cep, cidade: cidade },
        success: function (resultado) {
            $('.opcoes').html(resultado);
            html = "<button onclick='listarAtivos()' style='background-color: "+corSecundaria+";'>LISTAR ENDEREÇOS ATIVOS</button>"
            $('.listar').html(html);
        }
    });
}

function autoCompletarAlterar(endereco, rua, bairro, cep, cidade) {
    $.ajax({
        type: 'GET',
        url: 'ajax/salvar-endereco.php?alterar=true',
        data: { endereco: endereco, rua: rua, bairro: bairro, cep: cep, cidade: cidade },
        success: function (resultado) {
            $('.opcoes').html(resultado);
            html = "<button onclick='listarAtivos()' style='background-color: "+corSecundaria+";'>LISTAR ENDEREÇOS ATIVOS</button>"
            $('.listar').html(html);
        }
    });
}

//cod_endereco
function selecionarEndereco(endereco) {
    
    //pedido    
    var url = "ajax/validaEnd.php";
    $.ajax({

        type: 'GET',
        url: url,
        data: { endereco: endereco },

        success: function (res) {

            swal({
                title: "Endereco selecionado!",
                text: "Confirme seu pedido 🙂",
                icon: "success",
                timer: 1100,
                buttons: false
            }).then((value) => {window.location="/home/carrinho.php"});
        }
    });
}