<?php
//session_start();

ini_set('display_errors', true);

date_default_timezone_set('America/Sao_Paulo');


include_once "../../admin/controler/conexao.php";
include_once "../controler/controlEndereco.php";
$controleEndereco=new controlEndereco(conecta());
$_SESSION['tipoEndereco']=$_GET['tipo'];
//get cod cliente
$tipo = $_GET['tipo'];
if ($tipo == 'ativo'){
    $enderecos= $controleEndereco->selectByCliente(5,1);
    if ($enderecos < 1){
        echo "<p> Não existem endereços registrados</p>";
    }else{ 
        echo "<p> Lista de endereços cadastrados: </p>";
            foreach ($enderecos as $endereco) {
                echo "<div class='item'>
                        <label> Rua: <strong>" . $endereco->getRua()."</strong></label>
                        <button class='btn btn-danger pull-right' onclick='excluirEndereco(".$endereco->getCodEndereco().")' > X </button>
                        <button class='btn btn-warning pull-right' onclick='alterarEndereco(".$endereco->getCodEndereco().")' > ALTERAR </button>
                        <div>
                        <label> Cep: " . $endereco->getCep()."</label>
                        <label> Número: " . $endereco->getNumero()."</label>
                        <label> Bairro: " . $endereco->getBairro()."</label>
                        </div>
                        <label> Complemento: " . $endereco->getComplemento()."</label>
                    </div>
                ";
            }
    }
}else{
    $enderecos= $controleEndereco->selectByCliente(5,2);
    if ($enderecos < 1){
        echo "<p> Não existem endereços excluidos</p>";
    }else{ 
        echo "<p> Lista de endereços excluidos: </p>";
            foreach ($enderecos as $endereco) {
                echo "<div class='item'>
                        <label> Rua: <strong>" . $endereco->getRua()."</strong></label>
                        <button class='btn pull-right' onclick='ativarEndereco(".$endereco->getCodEndereco().")' > Restaurar </button>
                        <div>
                        <label> Número: " . $endereco->getNumero()."</label>
                        <label> Cep: " . $endereco->getCep()."</label>
                        <label> Bairro: " . $endereco->getBairro()."</label>
                        </div>
                        <label> Complemento: " . $endereco->getComplemento()."</label>
                    </div>
                ";
            }
    }

} 

?>