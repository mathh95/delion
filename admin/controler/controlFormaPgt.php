<?php
    include_once ROOTPATH. "/config.php";
    include_once MODELPATH. "/formaPgt.php";
    include_once "seguranca.php";

    protegePagina("carrinho_call");//flag de exceção, permite acessar control sem login

    class controlerFormaPgt{
        private $pdo;
        function insert($formaPgt){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO formapgt(tipoFormaPgt, flag_ativo)
                VALUES (:tipoFormaPgt, :flag_ativo)");
                $stmte->bindParam(":tipoFormaPgt", $formaPgt->getTipoFormaPgt(), PDO::PARAM_STR);
                $stmte->bindParam(":flag_ativo", $formaPgt->getFlag_ativo());
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
    
        function update($formapgt){
            try{
                $stmte =$this->pdo->prepare("UPDATE formapgt SET tipoFormaPgt=:tipoFormaPgt, flag_ativo=:flag_ativo WHERE cod_formaPgt=:cod_formaPgt");
                $stmte->bindParam(":cod_formaPgt",$formapgt->getCod_formaPgt(), PDO::PARAM_INT);
                $stmte->bindParam(":tipoFormaPgt", $formapgt->getTipoFormaPgt(), PDO::PARAM_INT);
                $stmte->bindParam(":flag_ativo", $formapgt->getFlag_ativo());
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

        function selectId($cod){
            $stmte;
            $formaPgt = new formaPgt();

            try{
                $stmte = $this->pdo->prepare("SELECT * FROM formapgt WHERE cod_formaPgt = :cod");
                $stmte->bindParam(":cod",$cod, PDO::PARAM_INT);
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $formaPgt->setCod_formaPgt($result->cod_formaPgt);
                            $formaPgt->setTipoFormaPgt($result->tipoFormaPgt);
                            $formaPgt->setFlag_ativo($result->flag_ativo);
                        }
                    }
                }
                return $formaPgt;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }

        }

        // function delete($parametro){
        //     try{
        //         $stmt = $this->pdo->prepare("UPDATE formapgt SET flag_ativo = 0 WHERE cod_formaPgt = :parametro");
        //         $stmt->bindParam(":parametro", $parametro, PDO::PARAM_INT);
        //         $stmt->execute();
        //         return 1;
        //     }
        //     catch(PDOException $e){
        //         echo $e->getMessage();
        //         return -1;
        //     }
        // }

        // function delete($cod_formaPgt){
        //     try{
        //         $flag_ativo=0;
        //         $parametro=$cod_formaPgt;
        //         $stmt=$this->pdo->prepare("UPDATE formapgt SET flag_ativo = 0 WHERE cod_formaPgt=:parametro");
        //         $stmt->bindParam("flag_ativo",$flag_ativo, PDO::PARAM_INT);
        //         $stmt->bindParam("parametro",$parametro,PDO::PARAM_INT);
        //         $executa=$stmt->execute();
        //         if($executa){
        //             return 1;
        //         }else{
        //             return -1;
        //         }
        //     }catch(PDOException $e){
        //         echo $e->getMessage();
        //         return -1;
        //     }
        // }

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE formapgt SET flag_ativo = 0 WHERE cod_formaPgt = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function desativaFormaPgt($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE formapgt SET flag_ativo = 0 WHERE cod_formaPgt = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function ativaFormaPgt($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE formapgt SET flag_ativo = 1 WHERE cod_formaPgt = :parametro");
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
            $formapgts = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM formapgt");
                $executa= $stmte->execute();
                if($executa){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $formapgt = new formapgt();
                            $formapgt->setCod_formaPgt($result->cod_formaPgt);
                            $formapgt->setTipoFormaPgt($result->tipoFormaPgt);
                            $formapgt->setFlag_ativo($result->flag_ativo);
                            array_push($formapgts, $formapgt);
                        }
                    }else{
                        echo "Sem resultados";
                        return -1;
                    }
                    return $formapgts;
                }else{
                    return -1;
                }
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