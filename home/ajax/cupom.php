<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
include_once MODELPATH. "/cupom.php";
include_once CONTROLLERPATH."/seguranca.php";

include_once "../../admin/controler/controlCupom.php";
include_once "../../admin/controler/controlCupom_cliente.php";
protegePagina("carrinho_call");
header('Content-Type: application/json');


date_default_timezone_set('America/Sao_Paulo');

// session_start();

$acao = $_GET['acao'];
$codigo = $_GET['codigocupom'];

if(isset($_SESSION['cod_cliente'])){
    $cod_cliente = $_SESSION['cod_cliente'];
}else{
    $cod_cliente = NULL;
}

// $valortotal = $total - $valor;
// $valortotal = $_GET['valortotal'];

$controlcupom = new controlCupom($_SG['link']);
$cupom = $controlcupom->selectAll();

$controlcupom1 = new controlCupom($_SG['link']);
$cupom1 = $controlcupom1->selectPorCodigo($codigo);

$controlcheck = new controlCupom_cliente($_SG['link']);
$check = $controlcheck->select($cod_cliente, $codigo);

$controlcheck2 = new controlCupom_cliente($_SG['link']);
$check2 = $controlcheck2->selectDataUso($cod_cliente);


$codcupom = $cupom1->getCod_cupom();
$valorcupom = $cupom1->getValor();
if($check2->getCod_cliente() == -1){
    $cod_cliente_uso = 0;
}else{
    $cod_cliente_uso = $check2->getCod_cliente();
}

// echo "<pre>";
// var_dump($valorcupom);
// echo "</pre>";

$_SESSION['valorcupom'] = 0.00;
$_SESSION['totalComDesconto'] = 0.00;
$data = date('Y-m-d');
if($acao == "checar"){

    verificarCupom($cod_cliente, $cupom1, $codigo, $data, $check, $cod_cliente_uso, $valorcupom, $codcupom);
}
//Funcao para fazer as verificacoes de uso e fluxo do cupom
function verificarCupom($cod_cliente, $cupom1, $codigo, $data, $check, $cod_cliente_uso, $valorcupom, $codcupom){
    if(!isset($cod_cliente)){
        echo json_encode(array("mensagem" => "Por favor faça o login!")); return;
    }else if(empty($codigo)){
        echo json_encode(array("mensagem" => "Código vazio ou não digitado!")); return;
    }else if($codigo === $check->getCodigo()){
        echo json_encode(array("mensagem" => "Você já utilizou esse cupom!")); return;
    }else if($cod_cliente === $check->getCod_cliente()){
        echo json_encode(array("mensagem" => "Você não pode usar mais de 1 cupom por dia")); return;
    }else if($codigo !== $cupom1->getCodigo()){
        echo json_encode(array("mensagem" => "O cupom digitado não existe!")); return;
    }else if($cupom1->getStatus() === 2){
        echo json_encode(array("mensagem" => "O numero de cupons foi esgotado!")); return;
    }else if($cupom1->getStatus() === 3){
        echo json_encode(array("mensagem" => "O cupom expirou!")); return;
    }else if($cupom1->getStatus() === 4){
        echo json_encode(array("mensagem" => "Infelizmente, o cupom foi cancelado!")); return;
    }else if($cupom1->getVencimento_data() < $data){
        echo json_encode(array("mensagem" => "A data máxima do cupom venceu!")); return;
    }else if($data == $check->getUltimo_uso()){
        echo json_encode(array("mensagem" => "Não é possivel usar o cupom mais de 1 vez por dia!")); return;
    }else if($cupom1->getQtde_atual() <= 0){
        echo json_encode(array("mensagem" => "Quantidade insuficiente ou cupons esgotados!")); return;
    }else if($cod_cliente == $cod_cliente_uso){
        echo json_encode(array("mensagem" => "Não é possivel usar mais de 1 cupom por dia !")); return;
    }else if($_SESSION['totalCarrinho'] < $cupom1->getValor_minimo()){ 
        //Verificação para o valor minimo
        $txtSemVariavel = "O valor minimo para esse cupom é de";
        $txtWarning = $txtSemVariavel." R$".$cupom1->getValor_minimo();
        echo json_encode(array("mensagem" => $txtWarning)); return;
    }else if($_SESSION['totalCarrinho'] < $valorcupom){
        // echo json_encode(array("mensagem" => "O valor do cupom é maior do que o valor total da compra, a diferença será perdida!")); return;
        $_SESSION['valorcupom'] = $valorcupom;
        $_SESSION['codigocupom'] = $codigo;
        $_SESSION['codcupom'] = $codcupom;
        if($_SESSION['valorcupom'] > $_SESSION['totalCarrinho']){
            $_SESSION['totalComDesconto'] = 0.00;
        }else{
            $_SESSION['totalComDesconto'] = ($_SESSION['totalCarrinho'] - $_SESSION['valorcupom']);
        }

        echo json_encode(
            array("validoErro" => true, 
            "valorcupom" => $_SESSION['valorcupom'],
            "totalCarrinho" => $_SESSION['totalCarrinho'],
            "totalComDesconto" => $_SESSION['totalComDesconto'])); return;
    
    }else{ // caso passe pelas verificacoes, atribui os valores e retorna 
        $_SESSION['valorcupom'] = $valorcupom;
        $_SESSION['codigocupom'] = $codigo;
        $_SESSION['codcupom'] = $codcupom;
        if($_SESSION['valorcupom'] > $_SESSION['totalCarrinho']){
            $_SESSION['totalComDesconto'] = 0.00;
        }else{
            $_SESSION['totalComDesconto'] = ($_SESSION['totalCarrinho'] - $_SESSION['valorcupom']);
        }
        
        echo json_encode(
            array("valido" => true, 
            "valorcupom" => $_SESSION['valorcupom'],
            "totalCarrinho" => $_SESSION['totalCarrinho'],
            "totalComDesconto" => $_SESSION['totalComDesconto'])); return;
    }
}




    

    



