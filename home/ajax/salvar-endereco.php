<?php
ini_set('display_errors', true);

date_default_timezone_set('America/Sao_Paulo');


include_once "../../admin/controler/conexao.php";
include_once "../controler/controlEndereco.php";

include_once "../configuracaoCores.php";

$cod_cliente = $_SESSION['cod_cliente'];


//Preenche campos via CEP
if(isset($_GET['cep']) && !empty($_GET['cep'])){
    $cep = $_GET['cep'];
}else{
    $cep ='';
}
if(isset($_GET['rua']) && !empty($_GET['rua'])){
    $rua = $_GET['rua'];
}else{
    $rua ='';
}
if(isset($_GET['bairro']) && !empty($_GET['bairro'])){
    $bairro=$_GET['bairro'];
}else{
    $bairro='';
}
if(isset($_GET['cidade']) && !empty($_GET['cidade'])){
    $cidade = $_GET['cidade'];
}else{
    $cidade ='';
}


/**
* ALTERAR ENDEREÇO
*/
if(isset($_GET['endereco']) && !empty($_GET['endereco'])){

    $controleEndereco = new controlEndereco(conecta());
    $cod_endereco = $_GET['endereco'];//pk_id

    $endereco_cliente = $controleEndereco->selectById($cod_endereco);

    $cep = $endereco_cliente->cep;
    $rua = $endereco_cliente->logradouro;
    $bairro = $endereco_cliente->bairro;
    $cidade = $endereco_cliente->cidade;

    //Preenche campos via CEP
    if(isset($_GET['cep']) && !empty($_GET['cep'])){ $cep = $_GET['cep']; }
    if(isset($_GET['rua']) && !empty($_GET['rua'])){ $rua = $_GET['rua']; }
    if(isset($_GET['bairro']) && !empty($_GET['bairro'])){ $bairro = $_GET['bairro']; }
    if(isset($_GET['cidade']) && !empty($_GET['cidade'])){ $cidade = $_GET['cidade']; }

    echo " 
        <form action='/home/controler/alterarEndereco.php' method='POST'>

            <p>Alterar Endereço</p>    
                <input name='cod_cliente' type='hidden' value='".$cod_cliente."'>           
                <input name='cod_endereco' type='hidden' value='".$endereco_cliente->getPkId()."'>
            
            <div>
                <div class='cadastro-form'>
                    <label>Cep*</label>
                    <input class='inputs-pequenos' name='cep' type='text' id='cep' required placeholder='cep' autofocus  value='".$cep."' style='border: 2px solid ".$corSec.";'>
                </div>
                <div class='cadastro-form'>
                    <label>Cidade*</label>
                    <input class='inputs-pequenos' name='cidade' type='text' required placeholder='Cidade' value='".$cidade."' style='background-color:#ccc; border: 2px solid ".$corSec.";' readonly>
                </div>
            </div>
            <div>
                <label>Rua*</label>
                <input name='rua' type='text' required placeholder='rua' value='".$rua."' style='background-color:#ccc; border: 2px solid ".$corSec.";' readonly>
            </div>
            <div>
                <div class='cadastro-form'>
                    <label>Número*</label>
                    <input class='inputs-pequenos' name='numero' type='text' required placeholder='numero' value='".$endereco_cliente->getNumero()."' style='border: 2px solid ".$corSec.";'>
                </div>
                <div class='cadastro-form'>
                    <label>Bairro*</label>
                    <input class='inputs-pequenos' name='bairro' type='text' required placeholder='bairro' value='".$bairro."' style='background-color:#ccc; border: 2px solid ".$corSec.";' readonly>
                </div>
            </div>
            <div>
                <label>Complemento</label>
                <input name='complemento' type='text' placeholder='complemento' value='".$endereco_cliente->getComplemento()."' style='border: 2px solid ".$corSec.";'>
            </div>
            <div>
                <label>Referência</label>
                <input name='referencia' type='text' placeholder='Referência' value='".$endereco_cliente->getReferencia()."' style='border: 2px solid ".$corSec.";'>
            </div>

                <button style='float:left; background-color:".$corSec.";' onclick='window.history.go(0); return false;'>VOLTAR</button>
                <button type='submit' style='background-color:".$corSec.";'>ALTERAR</button>
            </form>

            <div class='listar'>
            </div>
            ";

            //autocompletar apontando para alterar
            echo "
                <script>
                $('#cep').on('change paste keyup', function() {
                    var cep = $(this).val();
                    var cep = cep.replace(/\D/g, '');
                    if (cep.length >= 8){
                        console.log(cep);
                        var validacep = /^[0-9]{8}$/;
                        console.log(cep);
                        if (validacep.test(cep)){
                            var url ='https://viacep.com.br/ws/'+ cep + '/json/';
                            $.getJSON(url, function(data) {
                                if (data.erro){
                                    alert('CEP Inválido :/');
                                }else{
                                    autoCompletarAlterar(".$endereco_cliente->getPkId().", data.logradouro, data.bairro, cep, data.localidade);
                                }
                            });
                        }else{
                            console.log('cep invalido');
                        }
                    }
                    });
                </script>";

/**
* CADASTRAR NOVO ENDEREÇO
*/
}else{

    echo " <form action='/home/controler/businesEndereco.php' method='POST'>

    <p>Novo Endereço</p>
    <input name='cod_cliente' type='hidden' value='".$cod_cliente."'>
    
    <div>
        <div class='cadastro-form'>
            <label>Cep*</label>
            <input class='inputs-pequenos cep' name='cep' type='text' id='cep' required placeholder='CEP' autofocus value='".$cep."' style='border: 2px solid ".$corSec.";'>
        </div>
        <div class='cadastro-form'>
            <label>Cidade*</label>
            <input class='inputs-pequenos' name='cidade' type='text' required placeholder='Cidade' value='".$cidade."' style='background-color:#ccc; border: 2px solid ".$corSec.";' readonly>
        </div>
    </div>
    <div>
        <label>Logradouro*</label>
        <input name='rua' type='text' required placeholder='Rua' value='".$rua."' style='background-color:#ccc; border: 2px solid ".$corSec.";' readonly>
    </div>
    <div>
        <div class='cadastro-form'>
            <label>Número*</label>
            <input class='inputs-pequenos' name='numero' type='text' required placeholder='Número' value='' style='border: 2px solid ".$corSec.";'>
        </div>
        <div class='cadastro-form'>
            <label>Bairro*</label>
            <input class='inputs-pequenos' name='bairro' type='text' required placeholder='Bairro' value='".$bairro."' style='background-color:#ccc; border: 2px solid ".$corSec.";' readonly>
        </div>
    </div>
    <div>
        <label>Complemento</label>
        <input name='complemento' type='text' placeholder='Complemento' value='' style='border: 2px solid ".$corSec.";'>
    </div>

    <div>
        <label>Referência</label>
        <input name='referencia' type='text' placeholder='Referência' value='' style='border: 2px solid ".$corSec.";'>
    </div>

    <button style='float:left; background-color:".$corSec.";' onclick='window.history.go(0); return false;'>VOLTAR</button>
    <button type='submit' style='background-color:".$corSec.";'>SALVAR</button>
                    
    </form>

    <div class='listar'>
    </div>
    ";

    //autocompletar default
    echo "
    <script>
    $(document).ready(function(){
        $('.cep').mask('00000-000');
    });
    $('#cep').on('change paste keyup', function() {
        var cep = $(this).val();
        var cep = cep.replace(/\D/g, '');
        if (cep.length >= 8){
            console.log(cep);
            var validacep = /^[0-9]{8}$/;
            console.log(cep);
            if (validacep.test(cep)){
                var url ='https://viacep.com.br/ws/'+ cep + '/json/';
                $.getJSON(url, function(data) {
                    if (data.erro){
                        alert('CEP Inválido :/');
                    }else{
                        autoCompletar(data.logradouro, data.bairro, cep, data.localidade);
                    }
                });
            }else{
                console.log('cep invalido');
            }
        }
        });
    </script>";
}

?>