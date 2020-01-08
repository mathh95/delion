<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/endereco.php";
    include_once MODELPATH."/endereco_cliente.php";

    include_once "controlEndereco.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once "../lib/alert.php";
    
    $control_endereco = new controlEndereco($_SG['link']);
    $endereco = new endereco();
    $endereco_cliente = new enderecoCliente();

    //Endereco inserido na home page
    if(isset($_SESSION['is_delivery_home']) && ($_SESSION['is_delivery_home']) && ($_SESSION['delivery_price'] > 0)){
        
        $cep = $_SESSION['endereco']['postal_code'];
        $logradouro = $_SESSION['endereco']['route'];
        $numero = $_SESSION['endereco']['street_number'];
        $bairro = $_SESSION['endereco']['sublocality_level_1'];
        $complemento = $_SESSION['endereco']['complemento'];
        $cliente = "null";
        $cidade = $_SESSION['endereco']['administrative_area_level_2'];
        $referencia = $_SESSION['endereco']['referencia'];
        $fk_cliente = $_SESSION['cod_cliente'];
        //$uf = $_SESSION['endereco']['administrative_area_level_1'];

        $cep = preg_replace('/[^0-9]/', '', $cep);
        $endereco_cli_inserido = 0;


        //verifica se já existe endereco
        $res_endereco = $control_endereco->selectByCep($cep);
        if($res_endereco){
            
            //insere endereco específico
            $endereco_cliente->construct(
                $numero,
                $referencia,
                $complemento,
                $res_endereco->getPkId(),
                $fk_cliente
            );
            $fk_endereco = $control_endereco->insertEnderecoSemFkCliente($endereco_cliente);
            $endereco_cli_inserido = 1;

        }else{
            $cidade = $control_endereco->selectCidadeByNome($cidade);
            $fk_cidade = $cidade->getPkId();

            $endereco->construct($cep, $logradouro, $bairro, $fk_cidade);
            $result = $control_endereco->insert($endereco);

            if($result > 0){
                
                $res_endereco = $control_endereco->selectByCep($cep);

                $endereco_cliente->construct(
                    $numero,
                    $referencia,
                    $complemento,
                    $res_endereco->getPkId(),
                    $fk_cliente
                );
                $cod_endereco = $control_endereco->insertEnderecoSemFkCliente($endereco_cliente);
                $endereco_cli_inserido = 1;
            }
        }
        $_SESSION['cod_endereco'] = $fk_endereco;

    //cadastro endereço convencional
    }else{
        $cep = addslashes(htmlspecialchars($_POST['cep']));
        $logradouro = addslashes(htmlspecialchars($_POST['rua']));
        $numero = addslashes(htmlspecialchars($_POST['numero']));
        $bairro = addslashes(htmlspecialchars($_POST['bairro']));
        $cidade = addslashes(htmlspecialchars($_POST['cidade']));
        $referencia = addslashes(htmlspecialchars($_POST['referencia']));
        $complemento = addslashes(htmlspecialchars($_POST['complemento']));
        $fk_cliente = addslashes(htmlspecialchars($_POST['cod_cliente']));

        $cep = preg_replace('/[^0-9]/', '', $cep);
        $endereco_cli_inserido = 0;


        //verifica se já existe endereco
        $res_endereco = $control_endereco->selectByCep($cep);
        if($res_endereco){
            
            //insere endereco específico
            $endereco_cliente->construct(
                $numero,
                $referencia,
                $complemento,
                $res_endereco->getPkId(),
                $fk_cliente
            );
            $endereco_cli_inserido = $control_endereco->insertEnderecoCliente($endereco_cliente);

        }else{
            $cidade = $control_endereco->selectCidadeByNome($cidade);
            $fk_cidade = $cidade->getPkId();

            $endereco->construct($cep, $logradouro, $bairro, $fk_cidade);
            $result = $control_endereco->insert($endereco);

            if($result > 0){
                
                $res_endereco = $control_endereco->selectByCep($cep);

                $endereco_cliente->construct(
                    $numero,
                    $referencia,
                    $complemento,
                    $res_endereco->getPkId(),
                    $fk_cliente
                );
                $endereco_cli_inserido = $control_endereco->insertEnderecoCliente($endereco_cliente);
            }
        }
        
        if ($endereco_cli_inserido > 0){
            alertJSVoltarPagina("Sucesso!","O endereço foi cadastrado com sucesso!",1);
        }else{
            alertJSVoltarPagina("Erro!","Não foi possível cadastrar o endereço.",1);
        }
    }

?>