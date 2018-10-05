<?php
ini_set('display_errors', true);

date_default_timezone_set('America/Sao_Paulo');


include_once "../../admin/controler/conexao.php";
include_once "../controler/controlEndereco.php";

if(isset($_GET['endereco']) && !empty($_GET['endereco'])){
    $controleEndereco=new controlEndereco(conecta());
    $cod_endereco=$_GET['endereco'];
    $endereco=$controleEndereco->select($cod_endereco,1)[0];
    /**
     * ALTERAR ENDEREÇO
     */
    echo " <form action='/home/controler/alterarEndereco.php' method='POST'>

            <p>Alterar dados do endereço</p>
                            
                <input name='cod_endereco' type='hidden' value='".$endereco->getCodEndereco()."'>
            <div>
                <label>Rua:</label>
                <input name='rua' type='text' required placeholder='rua' value='".$endereco->getRua()."'>
                
            </div>
            <div>
                <div>
                <label>Cep:</label>
                <input class='inputs-pequenos' name='cep' type='text' required placeholder='cep' value='".$endereco->getCep()."'>
                </div>
                <div>
                <label>Número:</label>
                <input class='inputs-pequenos' name='numero' type='text' required placeholder='numero' value='".$endereco->getNumero()."'>
                </div>
                <div>
                <label>Bairro:</label>
                <input class='inputs-pequenos' name='bairro' type='text' required placeholder='bairro' value='".$endereco->getBairro()."'>
                </div>
            </div>
            <div>
                <label>Complemento:</label>
                <input name='complemento' type='text' placeholder='complemento' value='".$endereco->getComplemento()."'>

            </div>

                <button type='submit'>ALTERAR</button>
                            
            </form>

            <div class='listar'>
                
            </div>
            ";
}else{
    /**
     * CADASTRAR NOVO ENDEREÇO
     */
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
    echo " <form action='/home/controler/businesEndereco.php' method='POST'>

    <p>Alterar dados do endereço</p>
                    
    <div>
        <div class='cadastro-form'>
        <label>Cep:</label>
        <input class='inputs-pequenos cep' name='cep' type='text' id='cep' required placeholder='CEP' value='".$cep."'>
        </div>
    </div>
    <div>
        <label>Rua:</label>
        <input name='rua' type='text' required placeholder='Rua' value='".$rua."'>
    </div>
    <div>
        <div class='cadastro-form'>
            <label>Número:</label>
            <input class='inputs-pequenos' name='numero' type='text' required placeholder='Número' value=''>
        </div>
        <div class='cadastro-form'>
            <label>Bairro:</label>
            <input class='inputs-pequenos' name='bairro' type='text' required placeholder='Bairro' value='".$bairro."'>
        </div>
    </div>
    <div>
        <label>Complemento:</label>
        <input name='complemento' type='text' placeholder='Complemento' value=''>

    </div>

        <button type='submit'>SALVAR</button>
                    
    </form>

    <div class='listar'>
        
    </div>
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
                    console.log(url);
                    $.getJSON(url, function(data) {
                        if (data.erro){
                            alert('cep invalido');
                        }else{
                            console.log(data.logradouro, data.bairro);
                            autoCompletar(data.logradouro, data.bairro, cep);
                        }
                    });
                }else{
                    console.log('cep invalido');
                }
            }
            });
    </script>
    ";

}
?>