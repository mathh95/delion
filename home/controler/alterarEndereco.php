<?php
    include_once "../../admin/controler/conexao.php";
    include_once "../controler/controlEndereco.php";
    include_once MODELPATH."/endereco.php";
    include_once "../lib/alert.php";
    $controleEndereco=new controlEndereco(conecta());
    $cod_endereco=$_POST['cod_endereco'];
    $rua=$_POST['rua'];
    $cep=$_POST['cep'];
    $numero=$_POST['numero'];
    $bairro=$_POST['bairro'];
    $complemento=$_POST['complemento'];
    $cliente= $_POST['cod_cliente'];
    $endereco= new endereco();
    $endereco->setCodEndereco($cod_endereco);
    $endereco->construct($rua,$numero,$cep,$complemento,$bairro,$cliente);
    $result=$controleEndereco->update($endereco);
    if ($result > 0){
        alertJSVoltarPagina("Sucesso!","Os dados foram alterados com sucesso!",1);
    }else{
        alertJSVoltarPagina("Erro!","Não foi possível alterar os dados.",1);
    }

?>