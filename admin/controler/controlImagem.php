<?php
    include_once MODELPATH."/imagem.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerImagem {
        private $pdo;
        function insert($imagem){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_imagem(ima_nome, ima_foto, ima_pagina)
                VALUES (:nome, :foto, :pagina)");
                $stmte->bindParam("nome", $imagem->getNome(), PDO::PARAM_STR);
                $stmte->bindParam("foto", $imagem->getFoto(), PDO::PARAM_STR);
                $stmte->bindParam("pagina", $imagem->getPagina(), PDO::PARAM_INT);
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

        function update($imagem){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_imagem SET ima_nome=:nome, ima_foto=:foto, ima_pagina=:pagina WHERE ima_pk_id=:cod_imagem");
                $stmte->bindParam(":cod_imagem", $imagem->getPkId() , PDO::PARAM_INT);
                $stmte->bindParam(":nome", $imagem->getNome(), PDO::PARAM_STR);
                $stmte->bindParam("foto", $imagem->getFoto(), PDO::PARAM_STR);
                $stmte->bindParam("pagina", $imagem->getPagina(), PDO::PARAM_INT);
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
            $imagem= new imagem();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_imagem WHERE ima_nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_imagem WHERE ima_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $imagem->setPkId($result->ima_pk_id);
                            $imagem->setNome($result->ima_nome);
                            $imagem->setFoto($result->ima_foto);
                            $imagem->setPagina($result->ima_pagina);
                        }
                    }
                }
                return $imagem;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function verificaIgual($parametro){
            $imagem= new imagem();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_imagem WHERE ima_nome = :parametro");
                $stmte->bindValue(":parametro", $parametro, PDO::PARAM_STR);
                if($stmte->execute()){
                        if($stmte->rowCount() > 0){
                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                                $imagem->setPkId($result->ima_pk_id);
                                $imagem->setNome($result->ima_nome);
                            }
                        }
                }
                return $imagem;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }


        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM tb_imagem WHERE ima_pk_id = :parametro");
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
            try{
            $imagens = array();
                $stmte = $this->pdo->prepare("SELECT * FROM tb_imagem");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $imagem= new imagem();
                            $imagem->setPkId($result->ima_pk_id);
                            $imagem->setNome($result->ima_nome);
                            $imagem->setFoto($result->ima_foto);
                            $imagem->setPagina($result->ima_pagina);
                            array_push($imagens, $imagem);
                        }
                    }else{
                        return NULL;
                    }
                    return $imagens;
                }else{
                    return NULL;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function countImagem(){
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS imagens FROM tb_imagem");
                $stmte->execute();
                $result = $stmte->fetch(PDO::FETCH_OBJ);
                return $result->imagens;
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