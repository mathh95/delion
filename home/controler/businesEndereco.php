<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/endereco.php";
    include_once "controlEndereco.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once "../lib/alert.php";
    
    $control= new controlEndereco($_SG['link']);
    $endereco= new endereco();

    //insert Endereco home page, sem vínculo com cod_cliente
    if(($_SESSION['is_delivery']) && ($_SESSION['delivery_price'] > 0) && ($_SESSION['delivery'] != -1)){
        $cep = $_SESSION['endereco']['postal_code'];
        $rua = $_SESSION['endereco']['route'];
        $numero = $_SESSION['endereco']['street_number'];
        $bairro = $_SESSION['endereco']['sublocality_level_1'];
        $complemento = $_SESSION['endereco']['complemento'];
        $cliente = "null";
        $cidade = $_SESSION['endereco']['administrative_area_level_2'];
        $referencia = $_SESSION['endereco']['referencia'];
        //$uf = $_SESSION['endereco']['administrative_area_level_1'];

        $endereco->construct($rua,$numero,$cep,$complemento,$bairro,$cidade,$referencia,$cliente);
        $cod_endereco = $control->insertSemCodCli($endereco);
        
        $_SESSION['cod_endereco'] = $cod_endereco;

    //cadastro endereço convencional
    }else{
        $cep=addslashes(htmlspecialchars($_POST['cep']));
        $rua=addslashes(htmlspecialchars($_POST['rua']));
        $numero=addslashes(htmlspecialchars($_POST['numero']));
        $bairro=addslashes(htmlspecialchars($_POST['bairro']));
        $cidade=addslashes(htmlspecialchars($_POST['cidade']));
        $referencia=addslashes(htmlspecialchars($_POST['referencia']));
        $complemento=addslashes(htmlspecialchars($_POST['complemento']));
        $cliente= addslashes(htmlspecialchars($_POST['cod_cliente']));
    
        $endereco->construct($rua,$numero,$cep,$complemento,$bairro,$cidade,$referencia,$cliente);
        $result=$control->insert($endereco);
        
        if ($result > 0){
            alertJSVoltarPagina("Sucesso!","O endereço foi cadastrado com sucesso!",1);
        }else{
            alertJSVoltarPagina("Erro!","Não foi cadastrar o endereço.",1);
        }
    }

?>