<?php
// session_start();
ini_set("allow_url_include", true);
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";    
include_once MODELPATH."/cardapio.php";

class controlerCarrinho{

    private $pdo;

    function __construct($pdo){

        $this->pdo=$pdo;
    }

    function setPedido(){

        $idCliente = $_SESSION['cod_cliente'];
        $valor = $_SESSION['totalCarrinho'];
        $status = 1;

        $sql = $this->pdo->prepare("INSERT INTO pedido SET cliente = :idCliente, data = NOW(), valor = :valor, status = :status");

        $sql->bindValue(":idCliente", $idCliente);
        // $sql->bindValue(":data", $data);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":status", $status);

        $sql->execute();

        $idPedido = $this->pdo->lastInsertId();

        foreach($_SESSION['carrinho'] as $key => $value){
            $sql = $this->pdo->prepare("INSERT INTO item_pedido SET cod_produto = :cod_produto, cod_pedido = :cod_pedido, quantidade = :quantidade");

            $sql->bindValue(":cod_produto", $_SESSION['carrinho'][$key]);
            $sql->bindValue(":cod_pedido", $idPedido);
            $sql->bindValue(":quantidade", $_SESSION['qtd'][$key]);

            $sql->execute();
        }

        $_SESSION['carrinho'] = array();
        $_SESSION['qtd'] = array();
        $_SESSION['totalCarrinho'] = array();
    }

}
?>