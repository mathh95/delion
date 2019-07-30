<?php
//  session_start();
ini_set("allow_url_include", true);
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";    
include_once MODELPATH."/cardapio.php";
include_once MODELPATH."/pedido-wpp.php";
include_once MODELPATH."/item.php";

class controlerCarrinhoWpp{

    private $pdo;

    function __construct($pdo){

        $this->pdo=$pdo;
    }

    function index(){}

    public function setPedidoWpp($pedidowpp){

        // $idCliente = $_SESSION['cod_cliente_wpp'];
        // $valor = $_SESSION['totalCarrinho'];
        $status = 1;
        $sql = $this->pdo->prepare("INSERT INTO pedido_wpp SET cod_cliente_wpp = :idClienteWpp, data = NOW(), valor = :valor, status = :status");

        $sql->bindValue(":idClienteWpp", $pedidowpp->getCliente_wpp());
        // $sql->bindValue(":data", $data);
        $sql->bindValue(":valor", $pedidowpp->getValor());
        $sql->bindValue(":status", $pedidowpp->getStatus());

        $sql->execute();

        $idPedido = $this->pdo->lastInsertId();

        ///Ajustar o foreach!
        //todo
        foreach($_SESSION['carrinhoWpp'] as $key => $value){
            $sql = $this->pdo->prepare("INSERT INTO item_pedido_wpp SET cod_produto = :cod_produto, cod_pedido_wpp = :cod_pedido_wpp, quantidade = :quantidade");

            $sql->bindValue(":cod_produto", $_SESSION['carrinho'][$key]);
            $sql->bindValue(":cod_pedido_wpp", $idPedido);
            $sql->bindValue(":quantidade", $_SESSION['qtd'][$key]);

            $sql->execute();
        }

        $_SESSION['carrinho'] = array();
        $_SESSION['qtd'] = array();
        $_SESSION['totalCarrinho'] = array();
    }

    function selectPedido($cod_clienteWpp){
        $parametro = $cod_clienteWpp;
        $pedidos= array();
        $stmt=$this->pdo->prepare("SELECT * FROM pedido_wpp WHERE cliente=:parametro ORDER BY data DESC, cod_pedido_wpp DESC");
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
        $stmt=$this->pdo->prepare("SELECT itw.cod_item_pedido_wpp, itw.quantidade, cardapio.nome, cardapio.preco 
        FROM item_pedido_wpp AS itw INNER JOIN cardapio ON itw.cod_produto=cardapio.cod_cardapio 
        WHERE itw.cod_pedido_wpp=:parametro");
        $stmt->bindParam(":parametro", $parametro, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0 ){
                while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                    $item = new item();
                    $item->setCod_item($result->cod_item);
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

    function selectAllPedido($parametro, $valormenor, $valormaior){
        $pedidos=array();
        $parametro = "%".$parametro."%";
        $stmt=$this->pdo->prepare("SELECT pw.cod_pedido_wpp, pw.cliente, pw.data, pw.valor, pw.status, cw.nome, cw.telefone, cw.rua, cw.numero, cw.bairro, cw.complemento
        FROM pedido_wpp as pw
        INNER JOIN
        cliente_wpp AS cw ON
        pw.cliente = cw.cod_cliente_wpp
        WHERE cw.nome like :nome AND p.valor > :menor AND p.valor < :maior");
        $stmt->bindValue(":nome", $parametro);
        $stmt->bindParam(":menor", $valormenor, PDO::PARAM_INT);
        $stmt->bindParam(":maior", $valormaior, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0) {
                while ($result=$stmt->fetch(PDO::FETCH_OBJ)) {
                    $pedido = new PedidoWpp();
                    $pedido->setCod_pedido($result->cod_pedido);
                    $pedido->setData(new DateTime($result->data));
                    $pedido->setValor($result->valor);
                    $pedido->setStatus($result->status);
                    $pedido->setCliente($result->nome);
                    $pedido->telefone=($result->telefone);
                    $pedido->rua=($result->rua);
                    $pedido->numero=($result->numero);
                    $pedido->bairro=($result->bairro);
                    array_push($pedidos,$pedido);
                }
            }else{
                return -1;

            }
            return $pedidos;
        }else{
            return -1;
        }

    }

    // function filterEndereco($parametro, $valormenor, $valormaior, $endereco){
    //     $pedidos=array();
    //     $parametro = "%".$parametro."%";
    //     $endereco = "%" . $endereco . "%";
    //     $stmt=$this->pdo->prepare("SELECT p.cod_pedido, p.data, p.valor, p.status, p.endereco, p.cliente, c.nome, c.telefone, e.rua, e.numero, e.cep
    //     FROM pedido as p
    //     INNER JOIN
    //     cliente AS c ON
    //     p.cliente = c.cod_cliente
    //     INNER JOIN
    //     endereco AS e ON
    //     p.endereco = e.cod_endereco
    //     WHERE c.nome like :nome AND p.valor > :menor AND p.valor < :maior
    //     AND e.rua LIKE :rua OR e.numero LIKE :numero OR e.cep LIKE :cep");
    //     $stmt->bindValue(":nome", $parametro);
    //     $stmt->bindValue(":rua", $endereco);
    //     $stmt->bindValue(":numero", $endereco);
    //     $stmt->bindValue(":cep", $endereco);
    //     $stmt->bindParam(":menor", $valormenor, PDO::PARAM_INT);
    //     $stmt->bindParam(":maior", $valormaior, PDO::PARAM_INT);
    //     $executa=$stmt->execute();
    //     if ($executa) {
    //         if ($stmt->rowCount() > 0) {
    //             while ($result=$stmt->fetch(PDO::FETCH_OBJ)) {
    //                 $pedido = new pedido();
    //                 $pedido->setCod_pedido($result->cod_pedido);
    //                 $pedido->setData(new DateTime($result->data));
    //                 $pedido->setValor($result->valor);
    //                 $pedido->setStatus($result->status);
    //                 $pedido->setCliente($result->nome);
    //                 $pedido->telefone=($result->telefone);
    //                 $pedido->rua=($result->rua);
    //                 $pedido->numero=($result->numero);
    //                 $pedido->cep=($result->cep);
    //                 array_push($pedidos,$pedido);
    //             }
    //         }else{
    //             return -1;

    //         }
    //         return $pedidos;
    //     }else{
    //         return -1;
    //     }

    // }

    function alterarStatusPedido($cod_pedido,$status){
        $parametro=$cod_pedido;
        $stmt=$this->pdo->prepare("UPDATE pedido_wpp SET status=:status WHERE cod_pedido=:parametro");
        $stmt->bindParam(":status",$status,PDO::PARAM_INT);
        $stmt->bindParam(":parametro",$parametro,PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            return 1;
        }else{
            return -1;
        }
    }
}
?>