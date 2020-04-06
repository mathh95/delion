<?php
    include_once MODELPATH."/empresa.php";
    include_once "seguranca.php";
    protegePagina();

    class controlerEmpresa {
        private $pdo;
        function insert($empresa){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_empresa(emp_nome, emp_descricao, emp_historia, emp_endereco, emp_bairro, emp_cidade, emp_estado, emp_cep, emp_fone, emp_whats, emp_email, emp_facebook, emp_instagram, emp_pinterest, emp_foto)
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
                $stmte =$this->pdo->prepare("UPDATE tb_empresa SET emp_nome=:nome, emp_descricao=:descricao, emp_historia=:historia, emp_endereco=:endereco, emp_bairro=:bairro, emp_cidade=:cidade, emp_estado=:estado, emp_cep=:cep, emp_fone=:fone, emp_whats=:whats, emp_email=:email, emp_facebook=:facebook, emp_instagram=:instagram, emp_pinterest=:pinterest, emp_foto=:foto WHERE emp_pk_id=:cod_empresa");

                $stmte->bindParam(":cod_empresa", $empresa->getPkId() , PDO::PARAM_INT);
                $stmte->bindParam(":nome", $empresa->getNome(), PDO::PARAM_STR);
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
                $stmte =$this->pdo->prepare("UPDATE tb_empresa SET emp_txt_dias_semana=:txt_dias_semana, emp_txt_horario_semana=:txt_horario_semana, emp_txt_dias_fim_semana=:txt_dias_fim_semana, emp_txt_horario_fim_semana=:txt_horario_fim_semana, emp_arr_dias_semana=:arr_dias_semana, emp_arr_horarios_inicio=:arr_horarios_inicio, emp_arr_horarios_final=:arr_horarios_final, emp_aberto=:aberto, emp_entregando=:entregando WHERE emp_pk_id=:cod_empresa");

                $stmte->bindParam(":cod_empresa", $empresa->getPkId() , PDO::PARAM_INT);
                $stmte->bindParam(":txt_dias_semana", $empresa->getTxtDiasSemana() , PDO::PARAM_STR);
                $stmte->bindParam(":txt_horario_semana", $empresa->getTxtHorarioSemana() , PDO::PARAM_STR);
                $stmte->bindParam(":txt_dias_fim_semana", $empresa->getTxtDiasFimSemana() , PDO::PARAM_STR);
                $stmte->bindParam(":txt_horario_fim_semana", $empresa->getTxtHorarioFimSemana() , PDO::PARAM_STR);
                $stmte->bindParam(":arr_dias_semana", $empresa->getArrDiasSemana() , PDO::PARAM_STR);
                $stmte->bindParam(":arr_horarios_inicio", $empresa->getArrHorariosInicio() , PDO::PARAM_STR);
                $stmte->bindParam(":arr_horarios_final", $empresa->getArrHorariosFinal() , PDO::PARAM_STR);
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

            $empresa = new empresa();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT *
                    FROM tb_empresa
                    WHERE emp_nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT *
                    FROM tb_empresa
                    WHERE emp_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $empresa->setPkId($result->emp_pk_id);
                            $empresa->setNome($result->emp_nome);
                            $empresa->setDescricao($result->emp_descricao);
                            $empresa->setHistoria($result->emp_historia);
                            $empresa->setEndereco($result->emp_endereco);
                            $empresa->setBairro($result->emp_bairro);
                            $empresa->setCidade($result->emp_cidade);
                            $empresa->setEstado($result->emp_estado);
                            $empresa->setCep($result->emp_cep);
                            $empresa->setFone($result->emp_fone);
                            $empresa->setWhats($result->emp_whats);
                            $empresa->setEmail($result->emp_email);
                            $empresa->setFacebook($result->emp_facebook);
                            $empresa->setInstagram($result->emp_instagram);
                            $empresa->setPinterest($result->emp_pinterest);
                            $empresa->setFoto($result->emp_foto);
                            $empresa->setTxtDiasSemana($result->emp_txt_dias_semana);
                            $empresa->setTxtHorarioSemana($result->emp_txt_horario_semana);
                            $empresa->setTxtDiasFimSemana($result->emp_txt_dias_fim_semana);
                            $empresa->setTxtHorarioFimSemana($result->emp_txt_horario_fim_semana);
                            $empresa->setArrDiasSemana($result->emp_arr_dias_semana);
                            $empresa->setArrHorariosInicio($result->emp_arr_horarios_inicio);
                            $empresa->setArrHorariosFinal($result->emp_arr_horarios_final);
                            $empresa->setAberto($result->emp_aberto);
                            $empresa->setEntregando($result->emp_entregando);
                            $empresa->setTaxaConversaoFidelidade($result->emp_taxa_conversao_fidelidade);
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
                $stmt = $this->pdo->prepare("DELETE FROM tb_empresa WHERE emp_pk_id = :parametro");
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
            $empresas = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_empresa");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $empresa= new empresa();

                            $empresa->setPkId($result->emp_pk_id);
                            $empresa->setNome($result->emp_nome);
                            $empresa->setDescricao($result->emp_descricao);
                            $empresa->setHistoria($result->emp_historia);
                            $empresa->setEndereco($result->emp_endereco);
                            $empresa->setBairro($result->emp_bairro);
                            $empresa->setCidade($result->emp_cidade);
                            $empresa->setEstado($result->emp_estado);
                            $empresa->setCep($result->emp_cep);
                            $empresa->setFone($result->emp_fone);
                            $empresa->setWhats($result->emp_whats);
                            $empresa->setEmail($result->emp_email);
                            $empresa->setFacebook($result->emp_facebook);
                            $empresa->setInstagram($result->emp_instagram);
                            $empresa->setPinterest($result->emp_pinterest);
                            $empresa->setFoto($result->emp_foto);
                            $empresa->setTxtDiasSemana($result->emp_txt_dias_semana);
                            $empresa->setTxtHorarioSemana($result->emp_txt_horario_semana);
                            $empresa->setTxtDiasFimSemana($result->emp_txt_dias_fim_semana);
                            $empresa->setTxtHorarioFimSemana($result->emp_txt_horario_fim_semana);
                            $empresa->setArrDiasSemana($result->emp_arr_dias_semana);
                            $empresa->setArrHorariosInicio($result->emp_arr_horarios_inicio);
                            $empresa->setArrHorariosFinal($result->emp_arr_horarios_final);
                            $empresa->setAberto($result->emp_aberto);
                            $empresa->setEntregando($result->emp_entregando);
                            $empresa->setTaxaConversaoFidelidade($result->emp_taxa_conversao_fidelidade);

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
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS empresas FROM tb_empresa");
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