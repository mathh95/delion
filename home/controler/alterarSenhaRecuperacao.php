<?php 
    include_once("controlCliente.php");
    include_once "../lib/alert.php";

    if (isset($_POST) and !empty($_POST)){

        $cod_cliente = $_POST['cod_cliente'];
        $cod_recuperacao = $_POST['cod_recuperacao'];

        $novaSenha = addslashes(htmlspecialchars($_POST['novaSenha']));
        $confirmaSenha = addslashes(htmlspecialchars($_POST['confirmaSenha']));

        if ($novaSenha  === $confirmaSenha){

            $control = new controlCliente($_SG['link']);
            
            $recuperacao = $control->getCodRecuperacao($cod_recuperacao);
            
            // var_dump($recuperacao[0]);
            
            $date = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
            $date = $date->format('Y-m-d H:i:s');

            if($recuperacao[0]['cod_cliente_fk'] != $cod_cliente){
                alertJSVoltarPagina("Erro!","Cliente inválido para código de recuperação.", 2);
            }else if($recuperacao[0]['recuperado'] == 1){
                alertJSVoltarPagina("Erro!","Código de recuperacao já foi utilizado.", 2);
            }else if($recuperacao[0]['data_expiracao'] < $date){
                alertJSVoltarPagina("Erro!","Código de recuperacao expirado.", 2);
            }else{

                $result=$control->updateSenhaEsquecida($cod_cliente,$confirmaSenha,$novaSenha);
                
                if ($result == 2){

                    //codigo recuperado
                    $control->setRecuperacao($cod_recuperacao);

                    //alertJSVoltarPagina("Sucesso!","Sua senha foi alterada com sucesso.", 1);
                    header("Location:../login.php?recuperada=true");
                }elseif($result == -2){
                    alertJSVoltarPagina("Erro!","Erro, sua senha não confere", 2);
                }else{
                    alertJSVoltarPagina("Erro!","Erro, não foi possível alterar sua senha.", 2);
                }
                // alertJSVoltarPagina("Erro!","Código de recuperação inválido.", 2);
            }

        }else {
            alertJSVoltarPagina("Erro!","Erro, sua nova senha e a confirmação não conferem.", 2);
        }
    }else{
        header("Location:../");
    }   
?>