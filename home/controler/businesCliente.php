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
                        alertJSVoltarPagina("Erro!","Erro, não foi possível logar.", 2);
                    }
                }else{
                    $result=$control->updateFacebook($cod_cliente, $idFacebook);
                    if ($result > 0){
                        $result=$control->validaRedeSocial($login, $idFacebook,0);
                        if ($result == 2){
                            echo "sucesso";
                        }else{
                            alertJSVoltarPagina("Erro!","Erro, não foi possível logar.", 2);
                        }
                    }else{
                        alertJSVoltarPagina("Erro!","Erro, não foi possível logar.", 2);
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
                        alertJSVoltarPagina("Erro!","Erro, não foi possível logar.", 2);
                    }
                }else{
                    alertJSVoltarPagina("Erro!","Erro, não foi possível cadastrar.", 2);
                }
            }
        }else{
        
            $nome= addslashes(htmlspecialchars($_POST['nome']));
            $login=addslashes(htmlspecialchars($_POST['login']));
            $senha=addslashes(htmlspecialchars($_POST['senha']));
            $telefone=addslashes(htmlspecialchars($_POST['telefone']));
            $status=1;
            $cliente = new cliente;
            $cliente->construct($nome,$login,$senha,$telefone,$status);
            $control = new controlCliente($_SG['link']);
            $result=$control->insert($cliente);
            if ($result > 0){
                $control->validaCliente($cliente->getLogin(),$cliente->getSenha());
                header("Location: ../");
            }else{
                echo "erro";
            }
        }
    }else{
        header("Location:../");
    }   
?>