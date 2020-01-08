<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once "controlCliente.php";
    include_once "../lib/alert.php";
    
        $cod_cliente= $_POST['cod_cliente'];
        $nome= addslashes(htmlspecialchars($_POST['nome']));
        $sobrenome= addslashes(htmlspecialchars($_POST['sobrenome']));
        $login=addslashes(htmlspecialchars($_POST['login']));
        $telefone=addslashes(htmlspecialchars($_POST['telefone']));
        
        $cliente = new cliente;
        $cliente->setLogin($login);
        $cliente->setNome($nome);
        $cliente->setSobrenome($sobrenome);
        $cliente->setTelefone($telefone);
        $cliente->setCod_cliente($cod_cliente);
        $control = new controlCliente($_SG['link']);
        $resultDt = $control->verifyDate($_POST['cod_cliente']);
        $resultFone = $control->verifyFone($_POST['cod_cliente'],$_POST['telefone']);
        // 1 -> Telefones Iguais
        //-1 -> Telefones Diferentes
        if($resultFone < 0){                            
            if($resultDt >= 30){
                $result=$control->updateDate($cliente);
                alertJSVoltarPagina("Sucesso!","Os dados foram alterados!",1);
            }else{
                alertJSVoltarPagina("Erro!","Não é possível alterar todos os dados, o telefone foi alterado nos últimos trinta dias!",1);
            }
        }else{
            $result=$control->update($cliente);
            if($result > 0){
                alertJSVoltarPagina("Sucesso!","Os dados foram alterados!",1);
            }else{
                alertJSVoltarPagina("Erro!","Não foi possível alterar os dados",1);
            }
        }

?>