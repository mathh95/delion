<?php
    include_once "../../admin/controler/conexao.php";
    include_once "../../home/controler/controlEndereco.php";
    include_once MODELPATH."/endereco.php";
    include_once MODELPATH."/endereco_cliente.php";
    include_once "../lib/alert.php";
    
    $control_endereco = new controlEndereco(conecta());

    $cod_endereco=addslashes(htmlspecialchars($_POST['cod_endereco']));
    $logradouro=addslashes(htmlspecialchars($_POST['rua']));
    $cep=addslashes(htmlspecialchars($_POST['cep']));
    $numero=addslashes(htmlspecialchars($_POST['numero']));
    $bairro=addslashes(htmlspecialchars($_POST['bairro']));
    $cidade=addslashes(htmlspecialchars($_POST['cidade']));
    $referencia=addslashes(htmlspecialchars($_POST['referencia']));
    $complemento=addslashes(htmlspecialchars($_POST['complemento']));
    $fk_cliente= addslashes(htmlspecialchars($_POST['cod_cliente']));

    $endereco = new endereco();
    $endereco_cliente = new enderecoCliente();

    $endereco_cli_atualizado = 0;

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
        $endereco_cliente->setPkId($cod_endereco);
        $endereco_cli_atualizado = $control_endereco->update($endereco_cliente);

    }else{
        $cidade = $control_endereco->selectCidadeByNome($cidade);
        $fk_cidade = $cidade->getPkId();

        //insere endereço genérico
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
            $endereco_cliente->setPkId($cod_endereco);
            $endereco_cli_atualizado = $control_endereco->update($endereco_cliente);
        }
    }
    
    if ($endereco_cli_atualizado > 0){
        msgRedireciona('Sucesso!','Os dados foram alterados com sucesso!',1,'../view/admin/clienteLista.php');
    }else{
        alertJSVoltarPagina("Erro!","Não foi possível alterar os dados.",1);
    }

?>