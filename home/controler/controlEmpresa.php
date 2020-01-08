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

            $empresa= new empresa();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_empresa WHERE emp_nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_empresa WHERE emp_pk_id = :parametro");
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
        function __construct($pdo){
            $this->pdo=$pdo;
        }
    }
?>