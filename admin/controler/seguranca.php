<?php
    include_once "conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once  MODELPATH."/usuario.php";

    $_SG['versao'] = "v1.0";           // Abre uma conexão com o servidor MySQL?

    $_SG['conectaServidor'] = true;    // Abre uma conexão com o servidor MySQL?
    $_SG['abreSessao'] = true;         // Inicia a sessão com um session_start()?
    $_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' é diferente de 'THIAGO'
    $_SG['validaSempre'] = true;       // Deseja validar o usuário e a senha a cada carregamento de página?
    // Evita que, ao mudar os dados do usuário no banco de dado o mesmo contiue logado.
    $_SG['paginaLogin'] = '../login.php'; // Página de login
    $_SG['tabela'] = 'usuario';       // Nome da tabela onde os usuários são salvos


    // Verifica se precisa fazer a conexão com o MySQL
    if ($_SG['conectaServidor'] == true) {
        $_SG['link'] = conecta();
    }
    // Verifica se precisa iniciar a sessão
    if ($_SG['abreSessao'] == true){
        if(!isset($_SESSION)){
            session_start();
        }
    }

    // valida o usuário
    function validaUsuario($usuario, $senha) {
        global $_SG;
        $pdo=$_SG['link'];
        $stmte = $pdo->prepare("SELECT * FROM tb_usuario WHERE usu_login = :parametro");
        $stmte->bindParam(":parametro", $usuario , PDO::PARAM_STR);
        if($stmte->execute()){
            if($stmte->rowCount() > 0){
                $result = $stmte->fetch(PDO::FETCH_OBJ);
                if ($result->usu_flag_bloqueado == 0)  {
                    if (md5($senha) == $result->usu_senha) {
                    // if (true) {
                        try {
                            $_SESSION['usuarioID'] = $result->usu_pk_id;
                            //  $_SESSION['usuarioLogin'] = strval($result->login);
                            $_SESSION['usuarioNome'] = strval($result->usu_nome);
                            $_SESSION['usuarioNivel'] = $result->usu_cod_perfil;
                            $_SESSION['permissaoPagina'] = $result->usu_cod_perfil;
                            $_SESSION['permissao'] = $result->usu_permissao;

                            $_SESSION['usuario'] = new usuario();
                            $_SESSION['usuario']->construct(
                                              $result->usu_nome,
                                              $result->usu_login,
                                              $result->usu_senha,
                                              $result->usu_email,
                                              $result->usu_flag_bloqueado,
                                              $result->usu_cod_perfil,
                                              $result->usu_permissao);
                            $_SESSION['usuario']->setCod_usuario($result->usu_pk_id);

                        } catch (Exception $e) {
                            print "Error!: " . $e->getMessage() . "<br/>";
                            die();
                        }
                        return 1;
                    } else {
                        return -1;
                    }
                } else {
                    return -2;
                }
            }else{
              return -3;
            }
        }else {
            return -4;
        }
    }

    /**
    * Função que protege uma página
    */
    function protegePagina($flag_exception="default") {

        global $_SG;

        //flag de exceção para chamada cruzada (home<->admin) sem login
        //a partir do carrinho
        if($flag_exception != "cross_call"){    
            if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
                // Não há usuário logado, manda pra página de login
                expulsaVisitante();
            } else if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
                // Há usuário logado, verifica se precisa validar o login novamente
                if ($_SG['validaSempre'] == true) {
                // Verifica se os dados salvos na sessão batem com os dados do banco de dados
                    if (!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])) {
                        // Os dados não batem, manda pra tela de login
                        expulsaVisitante();
                    }
                }
            }
            if(isset($_SESSION['permissaoPagina']) && isset($_SESSION['usuarioNivel'])){
                if($_SESSION['permissaoPagina']!=$_SESSION['usuarioNivel']){
                // echo "Permissão requisitada =".$_SESSION['permissaoPagina']." Permissão apresentada=".$_SESSION['usuarioNivel'];
                    expulsaVisitante();
                }else{
                }
            }
        }else{
            //possível verificação sem necessidade de login
        }
    }
    /**
    * Função para expulsar um visitante
    */
    function expulsaVisitante() {
        global $_SG;
        // echo "Visitante expluso";
        // Manda pra tela de login
        if (session_id()) {
            session_destroy();
        }
        // Remove as variáveis da sessão (caso elas existam)
        unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
        
        header("Location: /admin/view/login.php");
    }
?>