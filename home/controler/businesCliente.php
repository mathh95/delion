<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once "controlCliente.php";
    include_once CONTROLLERPATH."/seguranca.php";

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
        
?>