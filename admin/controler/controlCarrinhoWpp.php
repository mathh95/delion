<?php
//  session_start();
ini_set("allow_url_include", true);
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";    
include_once MODELPATH."/cardapio.php";
include_once MODELPATH."/pedido-wpp.php";
include_once MODELPATH."/itemWpp.php";

class controlerCarrinhoWpp{

    private $pdo;

    function __construct($pdo){

        $this->pdo=$pdo;
    }

    function index(){}

    function calcTotal($pedidowpp){
        $valor_total = 0;

        foreach($pedidowpp->carrinho as $item){
            $valor_total += $item['qtd'] * $item['valor'];
        }

        return $valor_total;
    }

    function insereItensCarrinhoWpp($cod_pedido, $pedidowpp){
        foreach($pedidowpp->carrinho as $item){
            $sql = $this->pdo->prepare("INSERT INTO item_pedido_wpp SET cod_produto = :cod_produto, cod_pedido_wpp = :cod_pedido_wpp, quantidade = :quantidade");
    
            $sql->bindValue(":cod_produto", $item['prod_id']);
            $sql->bindValue(":cod_pedido_wpp", $cod_pedido);
            $sql->bindValue(":quantidade", $item['qtd']);
    
            $sql->execute();
        }
    }

    public function setPedidoWpp($pedidowpp){
        $sql = $this->pdo->prepare("INSERT INTO pedido_wpp SET cod_cliente_wpp = :idClienteWpp, data = NOW(), valor = :valor, status = :status");

        $sql->bindValue(":idClienteWpp", $pedidowpp->getCliente_wpp());
        $sql->bindValue(":status", $pedidowpp->getStatus());
        $sql->bindValue(":valor", $this->calcTotal($pedidowpp));

        $sql->execute();

        $idPedido = $this->pdo->lastInsertId();

        $this->insereItensCarrinhoWpp($idPedido, $pedidowpp);

        $_SESSION['carrinhoWpp'] = Null;
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
        $stmt=$this->pdo->prepare("SELECT itpw.cod_item_pedido_wpp, itpw.quantidade, cardapio.nome, cardapio.preco 
        FROM item_pedido_wpp AS itpw INNER JOIN cardapio ON itpw.cod_produto=cardapio.cod_cardapio 
        WHERE itpw.cod_pedido_wpp=:parametro");
        $stmt->bindParam(":parametro", $parametro, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0 ){
                while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                    $item = new item();
                    $item->setCod_item($result->cod_item_pedido_wpp);
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
        $stmt=$this->pdo->prepare("SELECT pw.cod_pedido_wpp, pw.cod_cliente_wpp, pw.data, pw.valor, pw.status, cw.nome, cw.telefone, cw.rua, cw.numero, cw.bairro, cw.complemento
        FROM pedido_wpp as pw
        INNER JOIN
        cliente_wpp AS cw ON
        pw.cod_cliente_wpp = cw.cod_cliente_wpp");
        $stmt->bindValue(":nome", $parametro);
        $stmt->bindParam(":menor", $valormenor, PDO::PARAM_INT);
        $stmt->bindParam(":maior", $valormaior, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0) {
                while ($result=$stmt->fetch(PDO::FETCH_OBJ)) {


                    $pedido = new PedidoWpp();
                    $pedido->setCod_pedido_wpp($result->cod_pedido_wpp);
                    $pedido->setData(new DateTime($result->data));
                    $pedido->setValor($result->valor);
                    $pedido->setStatus($result->status);
                    $pedido->setCliente_wpp($result->nome);
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
        try{
            $parametro=$cod_pedido;
            $stmt=$this->pdo->prepare("UPDATE pedido_wpp SET status=:status WHERE cod_pedido_wpp=:parametro");
            $stmt->bindParam(":status",$status,PDO::PARAM_INT);
            $stmt->bindParam(":parametro",$parametro,PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
}
?>