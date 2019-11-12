<?php
    include_once MODELPATH."/empresa.php";
    include_once "seguranca.php";
    protegePagina();

    class controlerEmpresa {
        private $pdo;
        function insert($empresa){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO empresa(nome, descricao, historia, endereco, bairro, cidade, estado, cep, fone, whats, email, facebook, instagram, pinterest, foto)
                VALUES (:nome, :descricao, :historia, :endereco, :bairro, :cidade, :estado, :cep, :fone, :whats, :email, :facebook, :instagram, :pinterest, :foto)");
                $stmte->bindParam("nome", $empresa->getNome(), PDO::PARAM_STR);
                $stmte->bindParam("descricao", $empresa->getDescricao(), PDO::PARAM_STR);
                $stmte->bindParam("historia", $empresa->getHistoria(), PDO::PARAM_STR);
                $stmte->bindParam("endereco", $empresa->getEndereco(), PDO::PARAM_STR);
                $stmte->bindParam("bairro", $empresa->getBairro(), PDO::PARAM_STR);
                $stmte->bindParam("cidade", $empresa->getCidade(), PDO::PARAM_STR);
                $stmte->bindParam("estado", $empresa->getEstado(), PDO::PARAM_STR);
                $stmte->bindParam("cep", $empresa->getCep(), PDO::PARAM_STR);
                $stmte->bindParam("fone", $empresa->getFone(), PDO::PARAM_STR);
                $stmte->bindParam("whats", $empresa->getWhats(), PDO::PARAM_STR);
                $stmte->bindParam("email", $empresa->getEmail() , PDO::PARAM_STR);
                $stmte->bindParam("facebook", $empresa->getFacebook() , PDO::PARAM_STR);
                $stmte->bindParam("instagram", $empresa->getInstagram() , PDO::PARAM_STR);
                $stmte->bindParam("pinterest", $empresa->getPinterest() , PDO::PARAM_STR);
                $stmte->bindParam("foto", $empresa->getFoto() , PDO::PARAM_STR);
                $executa = $stmte->execute();
                if($executa){
                    return 1;
                }
               else{
                    return -1;
                }
            }
           catch(PDOException $e){
                echo $e->getMessage();
                return -1;
           }
        }
        function update($empresa){
            try{
                $stmte =$this->pdo->prepare("UPDATE empresa SET descricao=:descricao, historia=:historia, endereco=:endereco, bairro=:bairro, cidade=:cidade, estado=:estado, cep=:cep, fone=:fone, whats=:whats, email=:email, facebook=:facebook, instagram=:instagram, pinterest=:pinterest, foto=:foto WHERE cod_empresa=:cod_empresa");

                $stmte->bindParam(":cod_empresa", $empresa->getCod_empresa() , PDO::PARAM_INT);
                $stmte->bindParam(":descricao", $empresa->getDescricao(), PDO::PARAM_STR);
                $stmte->bindParam(":historia", $empresa->getHistoria(), PDO::PARAM_STR);
                $stmte->bindParam(":endereco", $empresa->getEndereco(), PDO::PARAM_STR);
                $stmte->bindParam(":bairro", $empresa->getBairro(), PDO::PARAM_STR);
                $stmte->bindParam(":cidade", $empresa->getCidade(), PDO::PARAM_STR);
                $stmte->bindParam(":estado", $empresa->getEstado(), PDO::PARAM_STR);
                $stmte->bindParam(":cep", $empresa->getCep(), PDO::PARAM_STR);
                $stmte->bindParam(":fone", $empresa->getFone(), PDO::PARAM_STR);
                $stmte->bindParam(":whats", $empresa->getWhats(), PDO::PARAM_STR);
                $stmte->bindParam(":email", $empresa->getEmail() , PDO::PARAM_STR);
                $stmte->bindParam(":facebook", $empresa->getFacebook() , PDO::PARAM_STR);
                $stmte->bindParam(":instagram", $empresa->getInstagram() , PDO::PARAM_STR);
                $stmte->bindParam(":pinterest", $empresa->getPinterest() , PDO::PARAM_STR);
                $stmte->bindParam(":foto", $empresa->getFoto() , PDO::PARAM_STR);

                $executa = $stmte->execute();
                if($executa){
                    return 1;
                }
                else{
                    return -1;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }
        function updateFuncionamento($empresa){
            try{
                $stmte =$this->pdo->prepare("UPDATE empresa SET dias_semana=:dias_semana, horario_semana=:horario_semana, dias_fim_semana=:dias_fim_semana, horario_fim_semana=:horario_fim_semana, aberto=:aberto, entregando=:entregando WHERE cod_empresa=:cod_empresa");

                $stmte->bindParam(":cod_empresa", $empresa->getCod_empresa() , PDO::PARAM_INT);
                $stmte->bindParam(":dias_semana", $empresa->getDiasSemana() , PDO::PARAM_STR);
                $stmte->bindParam(":horario_semana", $empresa->getHorarioSemana() , PDO::PARAM_STR);
                $stmte->bindParam(":dias_fim_semana", $empresa->getDiasFimSemana() , PDO::PARAM_STR);
                $stmte->bindParam(":horario_fim_semana", $empresa->getHorarioFimSemana() , PDO::PARAM_STR);
                $stmte->bindParam(":aberto", $empresa->getAberto() , PDO::PARAM_INT);
                $stmte->bindParam(":entregando", $empresa->getEntregando() , PDO::PARAM_INT);

                $executa = $stmte->execute();
                if($executa){
                    return 1;
                }
                else{
                    return -1;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }
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
                            $empresa->getCod_empresa($result->cod_empresa);
                            $empresa->getNome($result->nome);
                            $empresa->getDescricao($result->descricao);
                            $empresa->getHistoria($result->historia);
                            $empresa->getEndereco($result->endereco);
                            $empresa->getBairro($result->bairro);
                            $empresa->getCidade($result->cidade);
                            $empresa->getEstado($result->estado);
                            $empresa->getCep($result->cep);
                            $empresa->getFone($result->fone);
                            $empresa->getWhats($result->whats);
                            $empresa->getEmail($result->email);
                            $empresa->getFacebook($result->facebook);
                            $empresa->setInstagram($result->instagram);
                            $empresa->setPinterest($result->pinterest);
                            $empresa->getFoto($result->foto);
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

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM empresa WHERE cod_empresa = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
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

        function countEmpresa(){
            $stmte;
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS empresas FROM empresa");
                $stmte->execute();
                $result = $stmte->fetch(PDO::FETCH_OBJ);
                return $result->empresas;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }


        function __construct($pdo){
            $this->pdo=$pdo;
        }
    }
?>