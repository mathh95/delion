<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once "controlCliente.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once "../lib/alert.php";
    include_once "../utils/VerificaCpf.php";
    include_once "../utils/VerificaTelefone.php";
    include_once "../utils/IaGente.php";
    include_once HELPERPATH."/mask.php";
    include_once MODELPATH."/sms_verificacao.php";
    include_once "controlSmsVerificacao.php";

    if (isset($_POST) and !empty($_POST) ){
        if(isset($_GET['verificacaoCadastro']) && !empty($_GET['verificacaoCadastro'])){
            $cod_cliente = $_SESSION['cod_cliente'];
            $cpf = addslashes(htmlspecialchars($_POST['cpf']));
            $data_nasc = addslashes(htmlspecialchars($_POST['data_nasc']));
            $telefone = addslashes(htmlspecialchars($_POST['telefone']));
            
            $ia_gente = new IaGente();
            $control_sms = new controlSmsVerificacao($_SG['link']);

            $erros = verifica($cpf, $data_nasc, $telefone);
            if($erros > 0){
                echo "Campos inválidos!";
            }else{
    
                $mask = new Mask;
                $telefone_int = $mask->rmMaskPhone($telefone);
    
                //Gera o código p/ enviar o sms
                $cod_sms = rand(1112, 9998);
                    
                //salva informações de verificação
                $sms = new smsVerificacao;
                $sms->construct($telefone_int, $cod_sms);
                    
                $result = $control_sms->insert($sms);
                if($result < 0){
                    echo "Erro ao salvar SMS 😕";
                    return;
                }
                    
                //add Código país para envio
                $telefone_int = "55".$telefone_int;
    
                //envia SMS
                $res_envio = $ia_gente->enviaVerificacaoSMS($telefone_int, $cod_sms);
                    
                if($res_envio == "OK"){
                    echo "verificado";
                }else{
                    echo "Erro ao enviar SMS 😕...contate o suporte.";
                }
            }
        }
        //Verificação do SMS e cadastro do usuário
        else if(isset($_GET['verificacaoSMS']) && !empty($_GET['verificacaoSMS'])){

            $ia_gente = new IaGente();
            $control_sms = new controlSmsVerificacao($_SG['link']);

            $cod_cliente = $_SESSION['cod_cliente'];
            $cpf = addslashes(htmlspecialchars($_POST['cpf']));
            $data_nasc = addslashes(htmlspecialchars($_POST['data_nasc']));
            $telefone = addslashes(htmlspecialchars($_POST['telefone']));
            $cod_inserido = addslashes(htmlspecialchars($_POST['codigo_sms']));
            
            if(strlen($cod_inserido) < 4 || strlen($cod_inserido) > 4){
                echo "Código inválido!";
                return;
            }
            
            $mask = new Mask;
            $telefone_int = $mask->rmMaskPhone($telefone);
            
            //verifica código SMS
            $res_sms = $control_sms->selectByTelefoneCodigo($telefone_int, $cod_inserido);

            if($res_sms->getCod_sms() == ""){
                echo "Código inválido!";
                return;
            }else{
                $control_sms->updateVerificado($res_sms->getCod_sms());
            }

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
                echo "Erro no cadastro 😕";
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