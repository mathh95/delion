<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
include_once MODELPATH. "/cupom.php";
include_once CONTROLLERPATH."/seguranca.php";

include_once "../../admin/controler/controlCupom.php";
include_once "../../admin/controler/controlClienteCupom.php";
protegePagina("cross_call");
header('Content-Type: application/json');


date_default_timezone_set('America/Sao_Paulo');

// session_start();

$acao = $_GET['acao'];
$codigo_inserido = $_GET['codigocupom'];

if(isset($_SESSION['cod_cliente'])){
    $fk_cliente = $_SESSION['cod_cliente'];
}else{
    $fk_cliente = NULL;
}

// $valortotal = $total - $valor;
// $valortotal = $_GET['valortotal'];

$controlcupom = new controlCupom($_SG['link']);
$cupom = $controlcupom->selectPorCodigo($codigo_inserido);

//verifica se cupom utilizado em cliente/cod_cupom
$control_clcu = new controlClienteCupom($_SG['link']);
$clcu_fk_cod = $control_clcu->selectByFkCod($fk_cliente, $codigo_inserido);
$clcu_ultima_data = $control_clcu->selectUltimaDataUso($fk_cliente);

$pk_cupom_inserido = $cupom->getPkId();
$valor_cupom = $cupom->getValor();

if($clcu_ultima_data->getFkCliente() == -1){
    $cod_cliente_uso = 0;
}else{
    $cod_cliente_uso = $clcu_ultima_data->getFkCliente();
}

$_SESSION['valor_cupom'] = 0.00;
$_SESSION['total_com_desconto'] = 0.00;
$data = date('Y-m-d');


if($acao == "checar"){
    verificarCupom($fk_cliente, $cupom, $codigo_inserido, $data, $clcu_fk_cod, $cod_cliente_uso, $valor_cupom, $pk_cupom_inserido);
}



//Funcao para fazer as verificacoes de uso e fluxo do cupom
function verificarCupom($fk_cliente, $cupom, $codigo_inserido, $data, $clcu_fk_cod, $cod_cliente_uso, $valor_cupom, $pk_cupom_inserido){

    if(!isset($fk_cliente)){
        echo json_encode(array("mensagem" => "Por favor faça o login!")); return;
    }else if(empty($codigo_inserido)){
        echo json_encode(array("mensagem" => "Código vazio ou não digitado!")); return;
    }else if($codigo_inserido !== $cupom->getCodigo()){
        echo json_encode(array("mensagem" => "O cupom digitado não existe!")); return;
    }else if($pk_cupom_inserido === $clcu_fk_cod->getFkCupom()){
        echo json_encode(array("mensagem" => "Você já utilizou esse cupom!")); return;
    }else if($fk_cliente === $clcu_fk_cod->getPkId()){
        echo json_encode(array("mensagem" => "Você não pode usar mais de 1 cupom por dia")); return;
    }else if($cupom->getStatus() === 2){
        echo json_encode(array("mensagem" => "O numero de cupons foi esgotado!")); return;
    }else if($cupom->getStatus() === 3){
        echo json_encode(array("mensagem" => "O cupom expirou!")); return;
    }else if($cupom->getStatus() === 4){
        echo json_encode(array("mensagem" => "Infelizmente, o cupom foi cancelado!")); return;
    }else if($cupom->getVencimento_data() < $data){
        echo json_encode(array("mensagem" => "A data máxima do cupom venceu!")); return;
    }else if($data == $clcu_fk_cod->getUltimo_uso()){
        echo json_encode(array("mensagem" => "Não é possivel usar o cupom mais de 1 vez por dia!"));
        return;
    }else if($cupom->getQtde_atual() <= 0){
        echo json_encode(array("mensagem" => "Quantidade insuficiente ou cupons esgotados!")); return;
    }else if($fk_cliente == $cod_cliente_uso){
        echo json_encode(array("mensagem" => "Não é possivel usar mais de 1 cupom por dia !")); return;
    }else if($_SESSION['valor_subtotal'] < $cupom->getValor_minimo()){ 
        //Verificação para o valor minimo
        $txtSemVariavel = "O valor minimo para esse cupom é de";
        $txtWarning = $txtSemVariavel." R$".$cupom->getValor_minimo();
        echo json_encode(array("mensagem" => $txtWarning)); return;
    }else if($_SESSION['valor_subtotal'] < $valor_cupom){
        // echo json_encode(array("mensagem" => "O valor do cupom é maior do que o valor total da compra, a diferença será perdida!")); return;
        $_SESSION['valor_cupom'] = $valor_cupom;
        $_SESSION['codigo_cupom'] = $codigo_inserido;
        $_SESSION['pk_cupom'] = $pk_cupom_inserido;
        if($_SESSION['valor_cupom'] > $_SESSION['valor_subtotal']){
            $_SESSION['total_com_desconto'] = 0.00;
        }else{
            $_SESSION['total_com_desconto'] = ($_SESSION['valor_subtotal'] - $_SESSION['valor_cupom']);
        }

        echo json_encode(
            array("validoErro" => true, 
            "valorcupom" => $_SESSION['valor_cupom'],
            "totalCarrinho" => $_SESSION['valor_subtotal'],
            "totalComDesconto" => $_SESSION['total_com_desconto'])); return;
    
    }else{ // caso passe pelas verificacoes, atribui os valores e retorna 
        $_SESSION['valor_cupom'] = $valor_cupom;
        $_SESSION['codigo_cupom'] = $codigo_inserido;
        $_SESSION['pk_cupom'] = $pk_cupom_inserido;
        if($_SESSION['valor_cupom'] > $_SESSION['valor_subtotal']){
            $_SESSION['total_com_desconto'] = 0.00;
        }else{
            $_SESSION['total_com_desconto'] = ($_SESSION['valor_subtotal'] - $_SESSION['valor_cupom']);
        }
        
        echo json_encode(
            array("valido" => true, 
            "valorcupom" => $_SESSION['valor_cupom'],
            "totalCarrinho" => $_SESSION['valor_subtotal'],
            "totalComDesconto" => $_SESSION['total_com_desconto'])); return;
    }
}




    

    



