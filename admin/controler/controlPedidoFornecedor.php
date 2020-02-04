<?php
    include_once MODELPATH. "/pedido_fornecedor.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerPedidoFornecedor{
        private $pdo;

        function insert($pedido_fornecedor){
            try{
                $stmte = $this->pdo->prepare("INSERT INTO tb_pedido_fornecedor(pefo_valor, pefo_forma_pgt, pefo_desc, pefo_dt_pedido, pefo_fk_fornecedor)
                VALUES (:valor, :forma_pgt, :descricao, :dt_pedido, :fk_tipo_fornecedor)");
                
                $stmte->bindParam(":valor", $pedido_fornecedor->getValor());
                $stmte->bindParam(":forma_pgt", $pedido_fornecedor->getFormaPgt(), PDO::PARAM_STR);
                $stmte->bindParam(":descricao", $pedido_fornecedor->getDesc(), PDO::PARAM_STR);
                $stmte->bindParam(":dt_pedido", $pedido_fornecedor->getDtPedido());
                $stmte->bindParam(":fk_tipo_fornecedor", $pedido_fornecedor->getFkFornecedor(), PDO::PARAM_INT);

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

        function update($pedido_fornecedor){
            try{
                $stmte = $this->pdo->prepare("UPDATE tb_pedido_fornecedor SET pefo_valor=:valor, pefo_forma_pgt=:forma_pgt, pefo_desc=:descricao, pefo_dt_pedido=:dt_pedido, pefo_fk_fornecedor=:cod_tipo_fornecedor WHERE pefo_pk_id=:cod_pedido_fornecedor");

                $stmte->bindParam(":cod_pedido_fornecedor",$pedido_fornecedor->getPkId(), PDO::PARAM_INT);
                $stmte->bindParam(":valor", $pedido_fornecedor->getValor());
                $stmte->bindParam(":forma_pgt", $pedido_fornecedor->getFormaPgt(), PDO::PARAM_STR);
                $stmte->bindParam(":descricao", $pedido_fornecedor->getDesc(), PDO::PARAM_STR);
                $stmte->bindParam(":dt_pedido", $pedido_fornecedor->getDtPedido());
                $stmte->bindParam(":cod_tipo_fornecedor", $pedido_fornecedor->getFkFornecedor(), PDO::PARAM_INT);
                

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

        function delete(){
            try{

            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function selectAll(){
            $pedido_fornecedores = array();
            try{   
                $stmte= $this->pdo->prepare("SELECT * 
                FROM tb_pedido_fornecedor AS PED
                INNER JOIN tb_fornecedor AS FO
                ON PED.pefo_fk_fornecedor = FO.for_pk_id
                INNER JOIN tb_tipo_fornecedor AS TIP
                ON TIP.tifo_pk_id = FO.for_fk_tipo_fornecedor");
                $executa= $stmte->execute();
                if($executa){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $pedido_fornecedor = new pedido_fornecedor();
                            $pedido_fornecedor->setPkId($result->pefo_pk_id);
                            $pedido_fornecedor->setValor($result->pefo_valor);
                            $pedido_fornecedor->setFormaPgt($result->pefo_forma_pgt);
                            $pedido_fornecedor->setDesc($result->pefo_desc);
                            $pedido_fornecedor->setDtPedido($result->pefo_dt_pedido);
                            $pedido_fornecedor->setFkFornecedor($result->pefo_fk_fornecedor);
                            $pedido_fornecedor->tipo_fornecedor=$result->tifo_nome;

                            array_push($pedido_fornecedores, $pedido_fornecedor);
                        }
                    }else{
                        return -1;
                    }
                    return $pedido_fornecedores;
                }

            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }

        }

        function select($parametro, $modo){
            $pedido_fornecedor = new pedido_fornecedor();
            try{
                if($modo == 1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_pedido_fornecedor WHERE for_nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%", PDO::PARAM_STR);
                }elseif ($modo == 2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_pedido_fornecedor WHERE pefo_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $pedido_fornecedor->setPkId($result->pefo_pk_id);
                            $pedido_fornecedor->setValor($result->pefo_valor);
                            $pedido_fornecedor->setFormaPgt($result->pefo_forma_pgt);
                            $pedido_fornecedor->setDesc($result->pefo_desc);
                            $pedido_fornecedor->setDtPedido($result->pefo_dt_pedido);
                            $pedido_fornecedor->setFkFornecedor($result->pefo_fk_fornecedor);
                        }
                    }
                }
                return $pedido_fornecedor;
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