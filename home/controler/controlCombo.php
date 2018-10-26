<?php
//  session_start();
ini_set("allow_url_include", true);
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";    
include_once MODELPATH."/cardapio.php";
include_once MODELPATH."/combo.php";
include_once MODELPATH."/item-combo.php";
include_once $_SERVER['DOCUMENT_ROOT']."/home/controler/controlAdicional.php";
include_once "../../../admin/controler/conexao.php";

class controlerCombo{

    private $pdo;

    function __construct($pdo){

        $this->pdo=$pdo;
    }

    function index(){}

    public function setCombo($adicionais){

        $controleAdicional = new controlerAdicional(conecta());

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

            $sql = $this->pdo->prepare("INSERT INTO item_combo SET cod_produto = :cod_produto, cod_combo = :cod_combo");

            $sql->bindValue(":cod_produto", $_SESSION['combo'][$key]);
            $sql->bindValue(":cod_combo", $idCombo);

            $sql->execute();

            if(isset($adicionais[$key]) && !empty($adicionais[$key])){
                $idItemCombo = $this->pdo->lastInsertId();
                $adicionaisProduto = $adicionais[$key];
                $adicionaisProduto = $controleAdicional->buscarVariosId($adicionaisProduto);
                foreach($adicionaisProduto as $ad){
                    $sql = $this->pdo->prepare("INSERT INTO item_adicional SET cod_item_combo = :cod_item_combo, cod_adicional = :cod_adicional");
                    $sql->bindValue(":cod_item_combo", $idItemCombo);
                    $sql->bindValue(":cod_adicional", $ad['cod_adicional']);

                    $sql->execute();
                }
            }
        }

        $_SESSION['combo'] = array();
        $_SESSION['totalCombo'] = array();
        $_SESSION['adicionalCombo'] = array();
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

    function selectItens($cod_combo){
        $parametro = $cod_combo;
        $itens=array();
        $stmt=$this->pdo->prepare("SELECT item_combo.cod_item_combo, cardapio.nome, cardapio.preco FROM item_combo INNER JOIN cardapio ON item_combo.cod_produto=cardapio.cod_cardapio WHERE item_combo.cod_combo=:parametro");
        $stmt->bindParam(":parametro", $parametro, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0 ){
                while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                    $item = new itemCombo();
                    $item->setCod_item_combo($result->cod_item_combo);
                    $item->setProduto($result->nome);
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

    function selectAllCombo(){
        $combos=array();
        $stmt=$this->pdo->prepare("SELECT combo.cod_combo, combo.data, combo.valor, cliente.nome, cliente.telefone FROM combo INNER JOIN cliente ON combo.cliente = cliente.cod_cliente");
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0) {
                while ($result=$stmt->fetch(PDO::FETCH_OBJ)) {
                    $combo = new combo();
                    $combo->setCod_combo($result->cod_combo);
                    $combo->setData(new DateTime($result->data));
                    $combo->setValor($result->valor);
                    $combo->setCliente($result->nome);
                    $combo->telefone=($result->telefone);
                    array_push($combos,$combo);
                }
            }else{
                echo "Sem resultados";
                return -1;

            }
            return $combos;
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