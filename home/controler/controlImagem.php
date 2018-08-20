<?php
    include_once MODELPATH."/imagem.php";

    class controlerImagem {
        private $pdo;

        /*
          modo: 1-Nome, 2-id
        */

        function select($parametro,$modo){
            $stmte;
            $imagem= new imagem();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM imagem WHERE nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM imagem WHERE cod_imagem = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $imagem->setCod_imagem($result->cod_imagem);
                            $imagem->setNome($result->nome);
                            $imagem->setFoto($result->foto);
                            $imagem->setPagina($result->pagina);
                        }
                    }
                }
                return $imagem;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectAll(){
            $stmte;
            $imagens = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM imagem ORDER BY cod_imagem DESC");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $imagem= new imagem();
                            $imagem->setCod_imagem($result->cod_imagem);
                            $imagem->setNome($result->nome);
                            $imagem->setFoto($result->foto);
                            $imagem->setPagina($result->pagina);
                            array_push($imagens, $imagem);
                        }
                    }
                }
                return $imagens;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function countImagem(){
            $stmte;
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS imagens FROM imagem");
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