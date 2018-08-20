<?php
    include_once MODELPATH."/imagem.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerImagem {
        private $pdo;
        function insert($imagem){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO imagem(nome, foto, pagina)
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
                $stmte =$this->pdo->prepare("UPDATE imagem SET nome=:nome, foto=:foto, pagina=:pagina WHERE cod_imagem=:cod_imagem");
                $stmte->bindParam(":cod_imagem", $imagem->getCod_imagem() , PDO::PARAM_INT);
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

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM imagem WHERE cod_imagem = :parametro");
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
            $imagens = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM imagem");
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