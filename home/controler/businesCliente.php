<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once "controlCliente.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once "../lib/alert.php";
    if (isset($_POST) and !empty($_POST)){
        if(isset($_POST['idGoogle']) && !empty($_POST['idGoogle'])){

            $nome= addslashes(htmlspecialchars($_POST['nomeCliente']));
            $idGoogle = addslashes(htmlspecialchars($_POST['idGoogle']));
            $status=1;
            $login=addslashes(htmlspecialchars($_POST['emailCliente']));
            
            $cliente = new cliente;
            $control = new controlCliente($_SG['link']);

            $cliente = $control->select($login, 3);

            if(null != $cliente->getCod_cliente()){
               
                $_SESSION['cod_cliente']=$cliente->getCod_cliente();
                $_SESSION['nome']=$cliente->getNome();
                $_SESSION['login']=$cliente->getLogin();

                echo $_SESSION['nome'];
                
            }else{

                $cliente->setNome($nome);
                $cliente->setLogin($login);
                $cliente->setIdGoogle($idGoogle);
                $cliente->setStatus($status);

                $result=$control->insertGoogle($cliente);
                if ($result > 0){
                    $control->validaCliente($cliente->getLogin(),$cliente->getSenha());
                    header("Location: ../");
                }else{
                    echo "erro";
                }
            }

        }elseif (isset($_POST['id']) && !empty($_POST['id'])) {
            $control = new controlCliente ($_SG['link']);
            $nome=addslashes(htmlspecialchars($_POST['nome']));
            $login=addslashes(htmlspecialchars($_POST['email']));
            $idFacebook=addslashes(htmlspecialchars($_POST['id']));
            $result=$control->select($login,3);
            if ($result->getCod_cliente()){
                $cod_cliente=$result->getCod_cliente();
                $nome=$result->getNome();
                $login=$result->getLogin();
                if ($result->getIdFacebook() and $result->getIdFacebook() == $idFacebook){
                    $result=$control->validaRedeSocial($login,$idFacebook,0);
                    if ($result == 2){
                        echo "sucesso";
                    }else{
                        echo -1;
                    }
                }else{
                    $result=$control->updateFacebook($cod_cliente, $idFacebook);
                    if ($result > 0){
                        $result=$control->validaRedeSocial($login, $idFacebook,0);
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
                $cliente->setLogin($login);
                $cliente->setStatus(1);
                $cliente->setIdFacebook($idFacebook);
                $result = $control->insertFacebook($cliente);
                if ($result > 0){
                    $result=$control->validaRedeSocial($login,$idFacebook, 0);
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

            $nome= addslashes(htmlspecialchars($_POST['nome']));
            $login=addslashes(htmlspecialchars($_POST['login']));
            $senha=addslashes(htmlspecialchars($_POST['senha']));
            $senha2=addslashes(htmlspecialchars($_POST['senha2']));
            $telefone=addslashes(htmlspecialchars($_POST['telefone']));

            $erros=0;

            //valida nome
            if(strlen($nome) == 0){
                echo "O Campo Nome precisa ser preenchido.\n";                
                $erros ++;
            }else if(!ctype_alpha(str_replace(" ","",$nome))){
                echo "O Campo Nome só aceita caracteres simples.\n";
                $erros ++;
            }else if(strlen($nome) < 4){
                echo "O Nome precisa ter 4 letras ou mais.\n";
                $erros ++;
            }else if(strlen($nome) > 30){
                echo "O Nome precisa ter menos que 30 letras.\n";
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
            }else if(strlen($senha < 4)){
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
            }

            //valida telefone
            if(strlen($telefone) == 0){
                echo "O Campo Telefone precisa ser preenchido.\n";                
                $erros ++;
            }else if(strlen($telefone) < 8){
                echo "O Telefone precisa ter 8 números ou mais.\n";
                $erros ++;
            }else if(strlen($telefone) > 30){
                echo "O Telefone precisa ter menos que 15 números.\n";
                $erros ++;
            }

            if($erros == 0){

                $status=1;
                $cliente = new cliente;
                $cliente->construct($nome,$login,$senha,$telefone,$status);
                $control = new controlCliente($_SG['link']);
                $result=$control->insert($cliente);
                if ($result > 0){
                    $control->validaCliente($cliente->getLogin(),$cliente->getSenha());
                    
                    echo "inserido";
                }else{
                    echo "Erro no cadastro :/...entre em contato com o suporte.";
                }
            }else{
                echo "Campos inválidos!";
            }
        }
    }else{
        echo -1;
    }   
?>