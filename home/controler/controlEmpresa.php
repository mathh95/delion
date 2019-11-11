<?php
    ini_set("allow_url_include", true);
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";    
    include_once MODELPATH."/empresa.php";

    class controlerEmpresa {
        private $pdo;
        /*
          modo: 1-Nome, 2-id
        */
        function select($parametro,$modo){
            $stmte;
            $empresa= new empresa();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM empresa WHERE nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM empresa WHERE cod_empresa = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $empresa->setCod_empresa($result->cod_empresa);
                            $empresa->setNome($result->nome);
                            $empresa->setDescricao($result->descricao);
                            $empresa->setHistoria($result->historia);
                            $empresa->setEndereco($result->endereco);
                            $empresa->setBairro($result->bairro);
                            $empresa->setCidade($result->cidade);
                            $empresa->setEstado($result->estado);
                            $empresa->setCep($result->cep);
                            $empresa->setFone($result->fone);
                            $empresa->setWhats($result->whats);
                            $empresa->setEmail($result->email);
                            $empresa->setFacebook($result->facebook);
                            $empresa->setInstagram($result->instagram);
                            $empresa->setPinterest($result->pinterest);
                            $empresa->setFoto($result->foto);
                            $empresa->setDiasSemana($result->dias_semana);
                            $empresa->setHorarioSemana($result->horario_semana);
                            $empresa->setDiasFimSemana($result->dias_fim_semana);
                            $empresa->setHorarioFimSemana($result->horario_fim_semana);
                            $empresa->setAberto($result->aberto);
                            $empresa->setEntregando($result->entregando);
                        }
                    }
                }
                return $empresa;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        function selectAll(){
            $stmte;
            $empresas = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM empresa");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $empresa= new empresa();
                            $empresa->setCod_empresa($result->cod_empresa);
                            $empresa->setNome($result->nome);
                            $empresa->setDescricao($result->descricao);
                            $empresa->setHistoria($result->historia);
                            $empresa->setEndereco($result->endereco);
                            $empresa->setBairro($result->bairro);
                            $empresa->setCidade($result->cidade);
                            $empresa->setEstado($result->estado);
                            $empresa->setCep($result->cep);
                            $empresa->setFone($result->fone);
                            $empresa->setWhats($result->whats);
                            $empresa->setEmail($result->email);
                            $empresa->setFacebook($result->facebook);
                            $empresa->setInstagram($result->instagram);
                            $empresa->setPinterest($result->pinterest);
                            $empresa->setFoto($result->foto);
                            $empresa->setDiasSemana($result->dias_semana);
                            $empresa->setHorarioSemana($result->horario_semana);
                            $empresa->setDiasFimSemana($result->dias_fim_semana);
                            $empresa->setHorarioFimSemana($result->horario_fim_semana);
                            $empresa->setAberto($result->aberto);
                            $empresa->setEntregando($result->entregando);
                            array_push($empresas, $empresa);
                        }
                    }
                }
                return $empresa;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        function __construct($pdo){
            $this->pdo=$pdo;
        }
    }
?>