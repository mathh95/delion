<?php
//  session_start();
ini_set("allow_url_include", true);
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";    
include_once MODELPATH."/cardapio.php";
include_once MODELPATH."/pedido.php";

class controlerCarrinho{

    private $pdo;

    function __construct($pdo){

        $this->pdo=$pdo;
    }

    function index(){}

    public function setPedido(){

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

    function selectPedido($cod_cliente){
        $parametro = $cod_cliente;
        $pedidos= array();
        $stmt=$this->pdo->prepare("SELECT * FROM pedido WHERE cliente=:parametro ORDER BY data DESC, cod_pedido DESC");
        $stmt->bindParam(":parametro", $parametro, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0 ){
                while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                    $pedido = new pedido();
                    $pedido->setCod_pedido($result->cod_pedido);
                    $pedido->setData($result->data);
                    $pedido->setValor($result->valor);
                    $pedido->setStatus($result->status);
                    array_push($pedidos,$pedido);  
                }
            }else{
                echo "Sem resultados";
                return -1;
            }
            return $pedidos;
        }else {
            return -1;
        }
    }

}
?>