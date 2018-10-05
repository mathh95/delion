<?php
//  session_start();
ini_set("allow_url_include", true);
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";    
include_once MODELPATH."/cardapio.php";
include_once MODELPATH."/combo.php";
include_once MODELPATH."/item-combo.php";

class controlerCombo{

    private $pdo;

    function __construct($pdo){

        $this->pdo=$pdo;
    }

    function index(){}

    public function setPedido(){

        $idCliente = $_SESSION['cod_cliente'];
        $valor = $_SESSION['totalCombo'];
        $status = 1;

        $sql = $this->pdo->prepare("INSERT INTO combo SET cliente = :idCliente, data = NOW(), valor = :valor, status = :status");

        $sql->bindValue(":idCliente", $idCliente);
        // $sql->bindValue(":data", $data);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":status", $status);

        $sql->execute();

        $idCombo = $this->pdo->lastInsertId();

        foreach($_SESSION['combo'] as $key => $value){
            $sql = $this->pdo->prepare("INSERT INTO item_combo SET cod_produto = :cod_produto, cod_combo = :cod_combo, quantidade = :quantidade");

            $sql->bindValue(":cod_produto", $_SESSION['combo'][$key]);
            $sql->bindValue(":cod_combo", $idCombo);
            $sql->bindValue(":quantidade", $_SESSION['qtdCombo'][$key]);

            $sql->execute();
        }

        $_SESSION['combo'] = array();
        $_SESSION['qtdCombo'] = array();
        $_SESSION['totalCombo'] = array();
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
                    $pedido->setData(new DateTime($result->data));
                    $pedido->setValor($result->valor);
                    $pedido->setStatus($result->status);
                    array_push($pedidos,$pedido);  
                }
            }else{
                return -1;
            }
            return $pedidos;
        }else {
            return -1;
        }
    }

    function selectItens($cod_pedido){
        $parametro = $cod_pedido;
        $itens=array();
        $stmt=$this->pdo->prepare("SELECT item_pedido.cod_item_pedido, item_pedido.quantidade, cardapio.nome, cardapio.preco FROM item_pedido INNER JOIN cardapio ON item_pedido.cod_produto=cardapio.cod_cardapio WHERE item_pedido.cod_pedido=:parametro");
        $stmt->bindParam(":parametro", $parametro, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0 ){
                while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                    $item = new item();
                    $item->setCod_item($result->cod_item_pedido);
                    $item->setProduto($result->nome);
                    $item->setQuantidade($result->quantidade);
                    $item->preco=$result->preco;
                    array_push($itens,$item);  
                }
            }else{
                echo "Sem resultados";
                return -1;
            }
            return $itens;
        }else {
            return -1;
        }        
    }

    function selectAllPedido(){
        $pedidos=array();
        $stmt=$this->pdo->prepare("SELECT pedido.cod_pedido, pedido.data, pedido.valor, pedido.status, cliente.nome, cliente.telefone FROM pedido INNER JOIN cliente ON pedido.cliente = cliente.cod_cliente");
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0) {
                while ($result=$stmt->fetch(PDO::FETCH_OBJ)) {
                    $pedido = new pedido();
                    $pedido->setCod_pedido($result->cod_pedido);
                    $pedido->setData(new DateTime($result->data));
                    $pedido->setValor($result->valor);
                    $pedido->setStatus($result->status);
                    $pedido->setCliente($result->nome);
                    $pedido->telefone=($result->telefone);
                    array_push($pedidos,$pedido);
                }
            }else{
                echo "Sem resultados";
                return -1;

            }
            return $pedidos;
        }else{
            return -1;
        }

    }

    function alterarStatusPedido($cod_pedido,$status){
        $parametro=$cod_pedido;
        $stmt=$this->pdo->prepare("UPDATE pedido SET status=:status WHERE cod_pedido=:parametro");
        $stmt->bindParam("status",$status,PDO::PARAM_INT);
        $stmt->bindParam("parametro",$parametro,PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            return 1;
        }else{
            return -1;
        }
    }
}
?>