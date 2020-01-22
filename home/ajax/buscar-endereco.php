<?php
//session_start();

ini_set('display_errors', true);

date_default_timezone_set('America/Sao_Paulo');


include_once "../../admin/controler/conexao.php";
include_once "../controler/controlEndereco.php";

$controleEndereco = new controlEndereco(conecta());

if (isset($_SESSION['flag_combo']) && !empty($_SESSION['flag_combo'])) {
    $flag = $_SESSION['flag_combo'];
} else {
    $flag = 0;
}

$_SESSION['tipoEndereco'] = $_GET['tipo'];
$cod_cliente = $_SESSION['cod_cliente'];
$tipo = $_GET['tipo'];

if(isset($_GET['is_selecao_end'])){
    $flag_selecionar_end = $_GET['is_selecao_end'];
}else{
    $flag_selecionar_end = false;
}

if ($tipo == 'ativo') {
    $enderecos = $controleEndereco->selectByCliente($cod_cliente, 1);
    if ($enderecos < 1) {
        echo "<p> Não existem endereços registrados</p>";
    } else {
        if($flag_selecionar_end){
            echo "<p> Endereços Cadastrados </p>";
            foreach ($enderecos as $endereco) {
                echo "<div class='item'>
                        <label> Rua: <strong>" . $endereco->logradouro . "</strong></label>
                        <button class='btn btn-success pull-right' onclick='selecionarEndereco(" . $endereco->getPkId() . "," . $flag . ")' > SELECIONAR </button>
                        <div>
                        <label> Cep: " .  mask_cep($endereco->cep) . "</label>
                        <label> Número: " . $endereco->getNumero() . "</label>
                        <label> Bairro: " . $endereco->bairro . "</label>
                        </div>
                        <label> Complemento: " . $endereco->getComplemento() . "</label>
                    </div>
                ";
            }
        } else {
            echo "<p> Endereços Cadastrados </p>";
            foreach ($enderecos as $endereco) {
                echo "<div class='item'>
                        <label> Rua: <strong>" . $endereco->logradouro . "</strong></label>
                        <button class='btn btn-danger pull-right' onclick='excluirEndereco(" . $endereco->getPkId() . ")' > X </button>
                        <button class='btn btn-warning pull-right' onclick='alterarEndereco(" . $endereco->getPkId() . ")' > ALTERAR </button>
                        <div>
                        <label> Cep: " . mask_cep($endereco->cep) . "</label>
                        <label> Número: " . $endereco->getNumero() . "</label>
                        <label> Bairro: " . $endereco->bairro . "</label>
                        </div>
                        <label> Complemento: " . $endereco->getComplemento() . "</label>
                    </div>
                ";
            }
        }
    }

} else {

    $enderecos = $controleEndereco->selectByCliente($cod_cliente, 2);
    if ($enderecos < 1) {
        echo "<p> Não existem endereços excluidos</p>";
    } else {
        echo "<p> Lista de endereços excluidos: </p>";
        foreach ($enderecos as $endereco) {
            echo "<div class='item'>
                        <label> Rua: <strong>" . $endereco->getRua() . "</strong></label>
                        <button class='btn pull-right' onclick='ativarEndereco(" . $endereco->getCodEndereco() . ")' > Restaurar </button>
                        <div>
                        <label> Número: " . $endereco->getNumero() . "</label>
                        <label> Cep: " . $endereco->getCep() . "</label>
                        <label> Bairro: " . $endereco->getBairro() . "</label>
                        </div>
                        <label> Complemento: " . $endereco->getComplemento() . "</label>
                    </div>
                ";
        }
    }
}

function mask_cep($cep){

    $cep = strval($cep);
    
    $masked = "";
    $masked .= $cep[0];
    $masked .= $cep[1];
    $masked .= $cep[2];
    $masked .= $cep[3];
    $masked .= $cep[4];
    $masked .= "-";
    $masked .= $cep[5];
    $masked .= $cep[6];
    $masked .= $cep[7];

    return $masked;
}