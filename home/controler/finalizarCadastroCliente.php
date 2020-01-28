<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once "controlCliente.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once "../lib/alert.php";
    include_once "../utils/VerificaCpf.php";
    include_once "../utils/VerificaTelefone.php";
    include_once HELPERPATH."/mask.php";

    if (isset($_POST) and !empty($_POST)){

        $cod_cliente = $_SESSION['cod_cliente'];
        $cpf = addslashes(htmlspecialchars($_POST['cpf']));
        $data_nasc = addslashes(htmlspecialchars($_POST['data_nasc']));
        $telefone = addslashes(htmlspecialchars($_POST['telefone']));
        
        $erros = verifica($cpf, $data_nasc, $telefone);
        if($erros > 0){
            echo "Campos inválidos!";
        }else{

            $mask = new Mask;
            $telefone_int = $mask->rmMaskPhone($telefone);
            $cpf_int = $mask->rmMaskCpf($cpf);

            $cliente = new cliente;
            $cliente->setPkId($cod_cliente);
            $cliente->setCpf($cpf_int);
            $cliente->setData_nasc($data_nasc);
            $cliente->setTelefone($telefone_int);

            $control = new controlCliente($_SG['link']);
            $result = $control->completarCadastro($cliente);
            
            if($result > 0){
                $_SESSION['data_nasc'] = $data_nasc;
                $_SESSION['telefone'] = $telefone_int;

                echo "atualizado";
            }else{
                echo "Erro no cadastro :/";
            }
        }
    }

    function verifica($cpf, $data_nasc, $telefone){

        $erros = 0;

        //valida cpf
        $verifica_cpf = new VerificaCpf();
        if($verifica_cpf->valida($cpf) == false){
            echo "CPF inválido.\n";
            $erros++;
        }
        
        //valida data_nasc
        $current = date("Y-m-d");
        $min = date('Y-m-d', strtotime($current.'-90 year'));
        $max = date('Y-m-d', strtotime($current.'-12 year'));

        if(strlen($data_nasc) == 0){
            echo "O Campo Data de Nascimento precisa ser preenchido.\n";
            $erros ++;
        }else if(($data_nasc > $max) || ($data_nasc < $min)){
            echo "Data de Nascimento inválida.\n";
            $erros ++;
        }

         //valida telefone
        $mask = new Mask;
        $telefone_int = $mask->rmMaskPhone($telefone);

        if(strlen($telefone_int) == 0){
            echo "O Campo Telefone precisa ser preenchido.\n";                
            $erros ++;
        }else if(strlen($telefone_int) < 11){
            echo "O Telefone precisa ter 11 números, código de área seguido do número.\n";
            $erros ++;
        }else if(strlen($telefone_int) > 11){
            echo "O Telefone precisa ter 11 números, código de área seguido do número.\n";
            $erros ++;
        }

        $verifica_telefone = new VerificaTelefone();
        if($verifica_telefone->valida($telefone_int, "BR") == false){
            echo "Telefone inválido.\n";
            $erros++;
        }

        return $erros;


    }
?>