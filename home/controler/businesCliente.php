<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once MODELPATH."/sms_verificacao.php";
    include_once "controlCliente.php";
    include_once "controlSmsVerificacao.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once "../lib/alert.php";
    include_once "../utils/VerificaCpf.php";
    include_once "../utils/VerificaTelefone.php";
    include_once "../utils/InfoBip.php";
    include_once "../utils/GoogleRecaptcha.php";

    if (isset($_POST) and !empty($_POST)){

        //Cadastro/Login Google
        if(isset($_POST['id_google']) && !empty($_POST['id_google'])){

            $id_google = addslashes(htmlspecialchars($_POST['id_google']));
            $nome = addslashes(htmlspecialchars($_POST['nome']));
            $sobrenome = addslashes(htmlspecialchars($_POST['sobrenome']));
            $login_email = addslashes(htmlspecialchars($_POST['email']));
            $status = 1;
            
            $cliente = new cliente;
            $control = new controlCliente($_SG['link']);

            // $result = $control->selectByIdGoogle($id_google);
            $result = $control->selectByEmail($login_email);

            if (($result != null) && $result->getPkId()){

                $cod_cliente = $result->getPkId();
                $nome = $result->getNome();
                $login = $result->getLogin();

                if ($result->getIdGoogle() && ($result->getIdGoogle() == $id_google)){
                    $result = $control->validaRedeSocial($login_email, $id_google, 0);
                    if ($result == 2){
                        echo "sucesso";
                    }else{
                        echo -1;
                    }

                }else{
                    //atualiza id
                    $result = $control->updateIdGoogle($cod_cliente, $id_google);

                    if ($result > 0){
                        $result = $control->validaRedeSocial($login_email, $id_google, 1);
                        if ($result == 2){
                            echo "sucesso";
                        }else{
                            echo -1;
                        }
                    }else{
                        echo -1;
                    }
                }

            }else{
                $cliente = new cliente;
                $cliente->setNome($nome);
                $cliente->setSobrenome($sobrenome);
                $cliente->setLogin($login_email);
                $cliente->setStatus(1);
                $cliente->setIdGoogle($id_google);

                $result = $control->insertGoogle($cliente);
                if ($result > 0){
                    $result = $control->validaRedeSocial($login_email, $id_google, 1);
                    if ($result == 2){
                        echo "sucesso";
                    }else{
                        echo -1;
                    }
                }else{
                    echo -1;
                }
            }

        
        //Cadastro/Login Facebook
        }elseif (isset($_POST['id_facebook']) && !empty($_POST['id_facebook'])) {

            $control = new controlCliente ($_SG['link']);
            $nome = addslashes(htmlspecialchars($_POST['nome']));
            $sobrenome = addslashes(htmlspecialchars($_POST['sobrenome']));
            $login_email = addslashes(htmlspecialchars($_POST['email']));
            $id_facebook = addslashes(htmlspecialchars($_POST['id_facebook']));

            //$result = $control->selectByIdFacebook($id_facebook);//unique for each app
            $result = $control->selectByEmail($login_email);

            if (($result != null) && $result->getPkId()){

                $cod_cliente = $result->getPkId();
                $nome = $result->getNome();
                $login = $result->getLogin();

                if ($result->getIdFacebook() && ($result->getIdFacebook() == $id_facebook)){
                    $result = $control->validaRedeSocial($login_email, $id_facebook, 0);
                    if ($result == 2){
                        echo "sucesso";
                    }else{
                        echo -1;
                    }

                }else{
                    //atualiza id
                    $result = $control->updateIdFacebook($cod_cliente, $id_facebook);

                    if ($result > 0){
                        $result = $control->validaRedeSocial($login_email, $id_facebook, 0);
                        if ($result == 2){
                            echo "sucesso";
                        }else{
                            echo -1;
                        }
                    }else{
                        echo -1;
                    }
                }

            }else{
                $cliente = new cliente;
                $cliente->setNome($nome);
                $cliente->setSobrenome($sobrenome);
                $cliente->setLogin($login_email);
                $cliente->setStatus(1);
                $cliente->setIdFacebook($id_facebook);

                $result = $control->insertFacebook($cliente);
                if ($result > 0){
                    $result = $control->validaRedeSocial($login_email, $id_facebook, 0);
                    if ($result == 2){
                        echo "sucesso";
                    }else{
                        echo -1;
                    }
                }else{
                    echo -1;
                }
            }
        
        //Verificação dos Dados e Cadastro do Cliente
        }elseif (
            (isset($_POST['is_verificacao_cadastro']) && 
            ($_POST['is_verificacao_cadastro'] == 1))
            ||
            (isset($_POST['is_cadastro']) && 
            ($_POST['is_cadastro'] == 1))
        ){
            
            $nome= addslashes(htmlspecialchars($_POST['nome']));
            $sobrenome= addslashes(htmlspecialchars($_POST['sobrenome']));
            $cpf= addslashes(htmlspecialchars($_POST['cpf']));
            $data_nasc= addslashes(htmlspecialchars($_POST['data_nasc']));
            $telefone=addslashes(htmlspecialchars($_POST['telefone']));
            $login=addslashes(htmlspecialchars($_POST['login']));
            $senha=addslashes(htmlspecialchars($_POST['senha']));
            $senha2=addslashes(htmlspecialchars($_POST['senha2']));
            
            $token_verificar=addslashes(htmlspecialchars($_POST['grecaptcha_token_verificar'])); 
            
            $google_recaptcha = new GoogleRecaptcha();
            //Valida reCAPTCHAv3
            if(isset($_POST['grecaptcha_token_cadastrar'])){
                $token_cadastrar=addslashes(htmlspecialchars($_POST['grecaptcha_token_cadastrar']));
                
                $valid_token = $google_recaptcha->verificaToken($token_cadastrar);
            }else{
                $valid_token = $google_recaptcha->verificaToken($token_verificar);
            }
            
            $erros = 0;
            if($valid_token){

                $erros = verificaCadastro($erros, $nome, $sobrenome, $cpf, $data_nasc, $telefone, $login, $senha, $senha2);
                
                $info_bip = new InfoBip();
                $control_sms = new controlSmsVerificacao($_SG['link']);
                
            }else{
                // header('Content-type: application/json');
                // echo json_encode(array('valid_captcha' => 'false'));
                echo "reCAPTCHA inválido!";
                return;
            }

            if($erros > 0){
                echo "Campos inválidos!";
             
            //Verificação do Cliente
            }else if(
                isset($_POST['is_verificacao_cadastro']) &&
                $_POST['is_verificacao_cadastro'] == 1)
            {
                
                $telefone_int = limpaTelefone($telefone);
                $cod_sms = rand(1112, 9998);
                
                //salva informações de verificação
                $sms = new smsVerificacao;
                $sms->construct($telefone_int, $cod_sms);
                
                $result = $control_sms->insert($sms);
                if($result < 0){
                    echo "Erro ao salvar SMS :/";
                    return;
                }
                
                //add Código país para envio
                $telefone_int = "55".$telefone_int;

                //envia SMS
                $res_envio = $info_bip->enviaVerificacaoSMS($telefone_int, $cod_sms);
                
                if($res_envio){
                    echo "verificado";
                }else{
                    echo "Erro ao enviar SMS :/...contate o suporte.";
                }
            
            //Cadastro do Cliente
            } else if(isset($_POST['is_cadastro']) && $_POST['is_cadastro'] == 1){
                
                $telefone = addslashes(htmlspecialchars($_POST['telefone']));
                $cod_inserido = addslashes(htmlspecialchars($_POST['codigo_sms']));
                
                if(strlen($cod_inserido) < 4 || strlen($cod_inserido) > 4){
                    echo "Código inválido!";
                    return;
                }
                
                $telefone_int = limpaTelefone($telefone);
                
                //verifica código SMS
                $res_sms = $control_sms->selectByTelefoneCodigo($telefone_int, $cod_inserido);

                if($res_sms->getCod_sms() == ""){
                    echo "Código inválido!";
                    return;
                }else{
                    $control_sms->updateVerificado($res_sms->getCod_sms());
                }

                //Remove mascara
                $cpf_int = str_replace('-', '', $cpf);
                $cpf_int = preg_replace('/[^A-Za-z0-9\-]/', '', $cpf_int);

                //insere cliente
                $status=1;
                $cliente = new cliente;
                $cliente->construct($nome, $sobrenome, $cpf_int, $data_nasc, $login, $senha,$telefone_int, $status);
                $control = new controlCliente($_SG['link']);
                
                $result = $control->insert($cliente);
                if ($result > 0){
                    $control->validaCliente($cliente->getLogin(),$cliente->getSenha());
                    
                    echo "inserido";
                }else if($result == -2){
                    //login duplicado
                    echo "Erro no cadastro :/";
                }else{
                    echo "Erro no cadastro :/...entre em contato com o suporte.";
                }
            }

            return;

        }else{
            echo "Erro :/ Ação não definida!";
        }

    }else{
        echo -1;
    }

    function verificaCadastro($erros, $nome, $sobrenome, $cpf, $data_nasc, $telefone, $login, $senha, $senha2){

        //valida nome
        if(strlen($nome) == 0){
            echo "O Campo Nome precisa ser preenchido.\n";                
            $erros ++;
        }else if(!ctype_alpha(str_replace(" ","",$nome))){
            echo "O Campo Nome só aceita caracteres simples.\n";
            $erros ++;
        }else if(strlen($nome) < 3){
            echo "O Nome precisa ter 4 letras ou mais.\n";
            $erros ++;
        }else if(strlen($nome) > 30){
            echo "O Nome precisa ter menos que 30 letras.\n";
            $erros ++;
        }

        //valida sobrenome
        if(strlen($sobrenome) == 0){
            echo "O Campo Sobrenome precisa ser preenchido.\n";                
            $erros ++;
        }else if(!ctype_alpha(str_replace(" ","",$sobrenome))){
            echo "O Campo Sobrenome só aceita caracteres simples.\n";
            $erros ++;
        }else if(strlen($sobrenome) < 3){
            echo "O Sobrenome precisa ter 4 letras ou mais.\n";
            $erros ++;
        }else if(strlen($sobrenome) > 30){
            echo "O Sobrenome precisa ter menos que 30 letras.\n";
            $erros ++;
        }


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

        //valida senha
        if(strlen($senha) == 0){
            echo "O Campo Senha precisa ser preenchido.\n";
            $erros++;
        }else if($senha != $senha2){
            echo "Senhas diferentes.\n";
            $erros ++;
        }else if(strlen($senha) > 40){
            echo "A Senha precisa ter menos que 40 digitos.\n";
            $erros ++;
        }else if(strlen($senha) < 4){
            echo "A Senha precisa ter 4 ou mais caracteres.\n";
            $erros++;
        }
    
        //valida login
        if((strlen($login) == 0)){
            echo "O Campo Email precisa ser preenchido.\n";
            $erros++;
        }else if(strlen($login) > 40){
            echo "O Email precisa ter menos que 40 digitos.\n";
            $erros++;
        }else if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
            echo "Email inválido.\n";
            $erros++;
        }

        //valida telefone
        $telefone_int = limpaTelefone($telefone);

        if(strlen($telefone_int) == 0){
            echo "O Campo Telefone precisa ser preenchido.\n";                
            $erros ++;
        }else if(strlen($telefone_int) < 11){
            echo "O Telefone precisa ter 11 números, código de área seguido número.\n";
            $erros ++;
        }else if(strlen($telefone_int) > 11){
            echo "O Telefone precisa ter 11 números, código de área seguido número.\n";
            $erros ++;
        }

        $verifica_telefone = new VerificaTelefone();
        if($verifica_telefone->valida($telefone_int, "BR") == false){
            echo "Telefone inválido.\n";
            $erros++;
        }

        return $erros;
    }

    function limpaTelefone($telefone){
        //Remove mascara
        $telefone_int = str_replace('-', '', $telefone);
        $telefone_int = preg_replace('/[^A-Za-z0-9\-]/', '', $telefone_int);
        
        return $telefone_int;
    }

?>