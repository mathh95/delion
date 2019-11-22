<?php
//  session_start();
ini_set("allow_url_include", true);
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";    
include_once MODELPATH."/cardapio.php";
include_once MODELPATH."/pedido.php";
include_once MODELPATH."/item.php";
include_once CONTROLLERPATH. "/controlCupom.php";
include_once CONTROLLERPATH. "/controlCupom_cliente.php";


class controlerCarrinho{

    private $pdo;

    function __construct($pdo){

        $this->pdo=$pdo;
    }

    public function setPedido($endereco){

        // echo "<pre>";
        // print_r($_SESSION);
        // echo "</pre>";
        // exit;
        if(isset($_SESSION['codigocupom']) && !empty($_SESSION['codigocupom']) && isset($_SESSION['codcupom']) && !empty($_SESSION['codcupom'])){
            $idCliente = $_SESSION['cod_cliente'];
            $valor = $_SESSION['totalCorrigido'];
            $desconto = $_SESSION['valorcupom_var'];
            $taxa_entrega = $_SESSION['delivery_price_var'];
            $tempo_entrega = $_SESSION['delivery_time_var'];
            $subtotal = $_SESSION['totalCarrinho'];
            $formaPgt = $_SESSION['formaPagamento'];
            $codigocupom = $_SESSION['codigocupom'];
            $codcupom = $_SESSION['codcupom'];

            $cod_cliente=$idCliente;
            $cod_cupom=$codcupom;
            $sql=$this->pdo->prepare("INSERT INTO cupom_cliente SET cod_cliente = :cod_cliente, cod_cupom = :cod_cupom, ultimo_uso = NOW()");
            $sql->bindValue(":cod_cliente",$cod_cliente);
            $sql->bindValue(":cod_cupom",$cod_cupom);
            $sql->execute();

            $parametro = $codigocupom;
            $sql=$this->pdo->prepare("UPDATE cupom SET qtde_atual = qtde_atual - 1 WHERE codigo=:parametro");
            $sql->bindValue(":parametro",$parametro);
            $sql->execute();

            $origem = "Site";
            $status = 1;
            if ($endereco == null){
                $sql = $this->pdo->prepare("INSERT INTO pedido SET cliente = :idCliente, data = NOW(), valor = :valor, desconto = :desconto , taxa_entrega = :taxa_entrega, subtotal = :subtotal ,formaPgt = :formaPgt ,status = :status ,origem = :origem");
            }else{
                $sql = $this->pdo->prepare("INSERT INTO pedido SET cliente = :idCliente, data = NOW(), valor = :valor, desconto = :desconto , taxa_entrega = :taxa_entrega, subtotal = :subtotal ,formaPgt = :formaPgt ,status = :status ,origem = :origem, endereco = :endereco, tempo_entrega = :tempo_entrega");

                $sql->bindValue(":endereco", $endereco);
                $sql->bindValue(":tempo_entrega", $tempo_entrega);
            }

            $sql->bindValue(":idCliente", $idCliente);
            // $sql->bindValue(":data", $data);
            $sql->bindValue(":valor", $valor);
            $sql->bindValue(":desconto",$desconto);
            $sql->bindValue(":taxa_entrega",$taxa_entrega);
            $sql->bindValue(":subtotal",$subtotal);
            $sql->bindValue(":formaPgt",$formaPgt);
            $sql->bindValue(":status", $status);
            $sql->bindValue(":origem", $origem);

            $sql->execute();

            $idPedido = $this->pdo->lastInsertId();

            // $_SESSION['teste1'] = array("teste1", "teste2", "teste3", "teste4");
            // $teste = "Teste1";

            // print_r($_SESSION['observacao']);
            // exit;

            foreach($_SESSION['carrinho'] as $key => $value){
                $sql = $this->pdo->prepare("INSERT INTO item_pedido SET cod_produto = :cod_produto, cod_pedido = :cod_pedido, quantidade = :quantidade, observacao = :observacao");

                $sql->bindValue(":cod_produto", $_SESSION['carrinho'][$key]);
                $sql->bindValue(":cod_pedido", $idPedido);
                $sql->bindValue(":quantidade", $_SESSION['qtd'][$key]);
                $sql->bindValue(":observacao", $_SESSION['observacao'][$key]);

                $sql->execute();
            }

            

            $_SESSION['carrinho'] = array();
            $_SESSION['qtd'] = array();
            $_SESSION['observacao'] = array();
            $_SESSION['totalCorrigido'] = array();

        }else {

            $idCliente = $_SESSION['cod_cliente'];
            $valor = $_SESSION['totalCorrigido'];       //valor com a correção do cupom
            $desconto = $_SESSION['valorcupom_var'];
            $taxa_entrega = $_SESSION['delivery_price_var'];
            $tempo_entrega = $_SESSION['delivery_time_var'];
            $subtotal = $_SESSION['totalCarrinho'];
            $formaPgt = $_SESSION['formaPagamento'];
            $origem = "Site";
            $status = 1;


            if ($endereco == null){
                $sql = $this->pdo->prepare("INSERT INTO pedido SET cliente = :idCliente, data = NOW(), valor = :valor, desconto = :desconto, taxa_entrega = :taxa_entrega, subtotal = :subtotal ,formaPgt = :formaPgt ,status = :status ,origem = :origem");
            }else{
                $sql = $this->pdo->prepare("INSERT INTO pedido SET cliente = :idCliente, data = NOW(), valor = :valor, desconto = :desconto, taxa_entrega = :taxa_entrega, subtotal = :subtotal ,formaPgt = :formaPgt ,status = :status ,origem = :origem, endereco = :endereco, tempo_entrega = :tempo_entrega");

                $sql->bindValue(":endereco", $endereco);
                $sql->bindValue(":tempo_entrega", $tempo_entrega);
            }
    
            $sql->bindValue(":idCliente", $idCliente);
            // $sql->bindValue(":data", $data);
            $sql->bindValue(":valor", $valor);
            $sql->bindValue(":desconto",$desconto);
            $sql->bindValue(":taxa_entrega",$taxa_entrega);
            $sql->bindValue(":subtotal",$subtotal);
            $sql->bindValue(":formaPgt",$formaPgt);
            $sql->bindValue(":status", $status);
            $sql->bindValue(":origem", $origem);
    
            $sql->execute();
    
            $idPedido = $this->pdo->lastInsertId();
            
            // $_SESSION['observacaoItem']

            foreach($_SESSION['carrinho'] as $key => $value){
    
                $sql = $this->pdo->prepare("INSERT INTO item_pedido SET cod_produto = :cod_produto, cod_pedido = :cod_pedido, quantidade = :quantidade, observacao = :observacao");
    
                $sql->bindValue(":cod_produto", $_SESSION['carrinho'][$key]);
                $sql->bindValue(":cod_pedido", $idPedido);
                $sql->bindValue(":quantidade", $_SESSION['qtd'][$key]);
                $sql->bindValue(":observacao", $_SESSION['observacao'][$key]);

                $sql->execute();
            }
            
            
    
            $_SESSION['carrinho'] = array();
            $_SESSION['qtd'] = array();
            $_SESSION['observacao'] = array();
            $_SESSION['totalCarrinho'] = array();
        }
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
                    $pedido->setDesconto($result->desconto);
                    $pedido->setTaxa_entrega($result->taxa_entrega);
                    $pedido->setTempo_entrega($result->tempo_entrega);
                    $pedido->setSubtotal($result->subtotal);
                    $pedido->setFormaPgt($result->formaPgt);
                    $pedido->setStatus($result->status);
                    $pedido->setOrigem($result->origem);
                    $pedido->setHora_print($result->hora_print);
                    $pedido->setHora_delivery($result->hora_delivery);
                    $pedido->setHora_retirada($result->hora_retirada);
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

    function selectPaginadoPedidos($offset, $por_pagina){
        $stmte;
        $delivery = true;
        $pedidos = array();
        try{
            if ($delivery == true){
                $stmte = $this->pdo->prepare("SELECT p.cod_pedido, p.data, p.valor,p.desconto,p.taxa_entrega,p.subtotal,p.formaPgt,p.status, p.endereco, p.tempo_entrega, p.cliente, p.origem, p.hora_print, p.hora_delivery,p.hora_retirada,c.nome, c.telefone, e.rua, e.numero,e.bairro, e.complemento ,e.cep
                FROM pedido as p
                INNER JOIN
                cliente AS c ON
                p.cliente = c.cod_cliente
                LEFT JOIN
                endereco AS e ON
                p.endereco = e.cod_endereco
                ORDER BY p.data DESC, nome ASC LIMIT :offset, :por_pagina");
                $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
                $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
                $executa=$stmte->execute();
            }else{
                $stmte = $this->pdo->prepare("SELECT p.cod_pedido, p.data, p.valor,p.desconto,p.taxa_entrega,p.subtotal,p.formaPgt,p.status, p.endereco, p.tempo_entrega, p.cliente, p.origem, p.hora_print, p.hora_delivery,p.hora_retirada,c.nome, c.telefone, e.rua, e.numero,e.bairro, e.complemento ,e.cep
                FROM pedido as p
                INNER JOIN
                cliente AS c ON
                p.cliente = c.cod_cliente
                LEFT JOIN
                endereco AS e ON
                p.endereco = e.cod_endereco
                ORDER BY p.data DESC, nome ASC LIMIT :offset, :por_pagina");
                $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
                $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
                $executa=$stmte->execute();
            }
            if ($executa) {
                if ($stmte->rowCount() > 0) {
                    while ($result=$stmte->fetch(PDO::FETCH_OBJ)) {
                        $pedido = new pedido();
                        $pedido->setCod_pedido($result->cod_pedido);
                        $pedido->setData(new DateTime($result->data));
                        $pedido->setValor($result->valor);
                        $pedido->setDesconto($result->desconto);
                        $pedido->setTaxa_entrega($result->taxa_entrega);
                        $pedido->setTempo_entrega($result->tempo_entrega);
                        $pedido->setSubtotal($result->subtotal);
                        $pedido->setFormaPgt($result->formaPgt);
                        $pedido->setStatus($result->status);
                        $pedido->setCliente($result->nome);
                        $pedido->setOrigem($result->origem);
                        $pedido->telefone=($result->telefone);
                        $pedido->rua=($result->rua);
                        $pedido->numero=($result->numero);
                        $pedido->bairro=($result->bairro);
                        $pedido->complemento=($result->complemento);
                        $pedido->cep=($result->cep);
                        $pedido->setHora_print($result->hora_print);
                        $pedido->setHora_delivery($result->hora_delivery);
                        $pedido->setHora_retirada($result->hora_retirada);
                        array_push($pedidos,$pedido);
                    }
                }
            }
            return $pedidos;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    function selectItens($cod_pedido){
        $parametro = $cod_pedido;
        $itens=array();
        $stmt=$this->pdo->prepare("SELECT item_pedido.cod_item_pedido, item_pedido.quantidade, item_pedido.observacao ,cardapio.nome, cardapio.preco 
        FROM item_pedido 
        INNER JOIN cardapio ON item_pedido.cod_produto=cardapio.cod_cardapio WHERE item_pedido.cod_pedido=:parametro");
        $stmt->bindParam(":parametro", $parametro, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0 ){
                while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                    $item = new item();
                    $item->setCod_item($result->cod_item_pedido);
                    $item->setProduto($result->nome);
                    $item->setQuantidade($result->quantidade);
                    $item->setObservacao($result->observacao);
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

    //Filtro para nome
    function filter($parametro,$valormenor, $valormaior){
        $pedidos=array();
        $parametro = "%".$parametro."%";
        $stmt=$this->pdo->prepare("SELECT p.cod_pedido, p.data, p.valor,p.desconto,p.taxa_entrega,p.subtotal,p.formaPgt,p.status, p.endereco, p.tempo_entrega, p.cliente, p.origem, p.hora_print, p.hora_delivery,p.hora_retirada,c.nome, c.telefone, e.rua, e.numero,e.bairro, e.complemento ,e.cep
        FROM pedido as p
        INNER JOIN
        cliente AS c ON
        p.cliente = c.cod_cliente
        LEFT JOIN
        endereco AS e ON
        p.endereco = e.cod_endereco
        WHERE c.nome like :parametro AND p.valor > :valormenor AND p.valor < :valormaior
        ORDER BY p.data DESC");       //Ordenação por cod do pedido
        $stmt->bindValue(":parametro", $parametro, PDO::PARAM_STR);
        $stmt->bindParam(":valormenor", $valormenor, PDO::PARAM_INT);
        $stmt->bindParam(":valormaior", $valormaior, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0) {
                while ($result=$stmt->fetch(PDO::FETCH_OBJ)) {
                    $pedido = new pedido();
                    $pedido->setCod_pedido($result->cod_pedido);
                    $pedido->setData(new DateTime($result->data));
                    $pedido->setValor($result->valor);
                    $pedido->setDesconto($result->desconto);
                    $pedido->setTaxa_entrega($result->taxa_entrega);
                    $pedido->setTempo_entrega($result->tempo_entrega);
                    $pedido->setSubtotal($result->subtotal);
                    $pedido->setFormaPgt($result->formaPgt);
                    $pedido->setStatus($result->status);
                    $pedido->setCliente($result->nome);
                    $pedido->setOrigem($result->origem);
                    $pedido->telefone=($result->telefone);
                    $pedido->rua=($result->rua);
                    $pedido->numero=($result->numero);
                    $pedido->bairro=($result->bairro);
                    $pedido->complemento=($result->complemento);
                    $pedido->cep=($result->cep);
                    $pedido->setHora_print($result->hora_print);
                    $pedido->setHora_delivery($result->hora_delivery);
                    $pedido->setHora_retirada($result->hora_retirada);
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


    function selectAllPedido($parametro, $valormenor, $valormaior){
        $pedidos=array();
        $parametro = "%".$parametro."%";
        $stmt=$this->pdo->prepare("SELECT p.cod_pedido, p.data, p.valor,p.desconto,p.taxa_entrega,p.subtotal,p.formaPgt,p.status, p.endereco, p.tempo_entrega, p.cliente, p.origem, p.hora_print, p.hora_delivery,p.hora_retirada,c.nome, c.telefone, e.rua, e.numero,e.bairro, e.complemento ,e.cep
        FROM pedido as p
        INNER JOIN
        cliente AS c ON
        p.cliente = c.cod_cliente
        LEFT JOIN
        endereco AS e ON
        p.endereco = e.cod_endereco
        ORDER BY p.data DESC");       //Ordenação por cod do pedido
        // WHERE c.nome like :nome AND p.valor > :menor AND p.valor < :maior");
        $stmt->bindValue(":nome", $parametro);
        $stmt->bindParam(":menor", $valormenor, PDO::PARAM_INT);
        $stmt->bindParam(":maior", $valormaior, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0) {
                while ($result=$stmt->fetch(PDO::FETCH_OBJ)) {
                    $pedido = new pedido();
                    $pedido->setCod_pedido($result->cod_pedido);
                    $pedido->setData(new DateTime($result->data));
                    $pedido->setValor($result->valor);
                    $pedido->setDesconto($result->desconto);
                    $pedido->setTaxa_entrega($result->taxa_entrega);
                    $pedido->setTempo_entrega($result->tempo_entrega);
                    $pedido->setSubtotal($result->subtotal);
                    $pedido->setFormaPgt($result->formaPgt);
                    $pedido->setStatus($result->status);
                    $pedido->setCliente($result->nome);
                    $pedido->setOrigem($result->origem);
                    $pedido->telefone=($result->telefone);
                    $pedido->rua=($result->rua);
                    $pedido->numero=($result->numero);
                    $pedido->bairro=($result->bairro);
                    $pedido->complemento=($result->complemento);
                    $pedido->cep=($result->cep);
                    $pedido->setHora_print($result->hora_print);
                    $pedido->setHora_delivery($result->hora_delivery);
                    $pedido->setHora_retirada($result->hora_retirada);
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

    function filterEndereco($parametro, $valormenor, $valormaior, $endereco){
        $pedidos=array();
        $parametro = "%".$parametro."%";
        $endereco = "%" . $endereco . "%";
        $stmt=$this->pdo->prepare("SELECT p.cod_pedido, p.data, p.valor, p.desconto,p.taxa_entrega, p.tempo_entrega, p.subtotal,p.status, p.endereco, p.cliente, p.origem,p.observacao,c.nome, c.telefone, e.rua, e.numero,e.bairro, e.complemento ,e.cep
        FROM pedido as p
        INNER JOIN
        cliente AS c ON
        p.cliente = c.cod_cliente
        INNER JOIN
        endereco AS e ON
        p.endereco = e.cod_endereco
        WHERE c.nome like :nome AND p.valor > :menor AND p.valor < :maior
        AND e.rua LIKE :rua OR e.numero LIKE :numero OR e.cep LIKE :cep");
        $stmt->bindValue(":nome", $parametro);
        $stmt->bindValue(":rua", $endereco);
        $stmt->bindValue(":numero", $endereco);
        $stmt->bindValue(":cep", $endereco);
        $stmt->bindParam(":menor", $valormenor, PDO::PARAM_INT);
        $stmt->bindParam(":maior", $valormaior, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0) {
                while ($result=$stmt->fetch(PDO::FETCH_OBJ)) {
                    $pedido = new pedido();
                    $pedido->setCod_pedido($result->cod_pedido);
                    $pedido->setData(new DateTime($result->data));
                    $pedido->setValor($result->valor);
                    $pedido->setDesconto($result->desconto);
                    $pedido->setTaxa_entrega($result->taxa_entrega);
                    $pedido->setTempo_entrega($result->tempo_entrega);
                    $pedido->setSubtotal($result->subtotal);
                    $pedido->setStatus($result->status);
                    $pedido->setCliente($result->nome);
                    $pedido->setOrigem($result->origem);
                    $pedido->setObservacao($result->observacao);
                    $pedido->telefone=($result->telefone);
                    $pedido->rua=($result->rua);
                    $pedido->numero=($result->numero);
                    $pedido->bairro=($result->bairro);
                    $pedido->complemento=($result->complemento);
                    $pedido->cep=($result->cep);
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

    function alterarStatusPedido($cod_pedido,$status){
        try{
            if($status == "2"){
                date_default_timezone_set('America/Bahia');
                $hora_print = date('H:i');
                $parametro=$cod_pedido;
                $stmt=$this->pdo->prepare("UPDATE pedido SET status=:status, hora_print=:hora_print WHERE cod_pedido=:parametro");
                $stmt->bindParam(":status",$status,PDO::PARAM_INT);
                $stmt->bindParam(":hora_print", $hora_print, PDO::PARAM_STR);
                $stmt->bindParam(":parametro",$parametro,PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }else if($status =="3"){
                date_default_timezone_set('America/Bahia');
                $hora_delivery = date('H:i');
                $parametro=$cod_pedido;
                $stmt=$this->pdo->prepare("UPDATE pedido SET status=:status, hora_delivery=:hora_delivery WHERE cod_pedido=:parametro");
                $stmt->bindParam(":status",$status,PDO::PARAM_INT);
                $stmt->bindParam(":hora_delivery", $hora_delivery, PDO::PARAM_STR);
                $stmt->bindParam(":parametro",$parametro,PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }else {
                return 0;
            }
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    function alteraStatusPedidoRetirada($cod_pedido,$status){
        try{
            if($status == "3"){
                date_default_timezone_set('America/Bahia');
                $hora_retirada = date('H:i');
                $parametro=$cod_pedido;
                $stmt=$this->pdo->prepare("UPDATE pedido SET status=:status, hora_retirada=:hora_retirada WHERE cod_pedido=:parametro");
                $stmt->bindParam(":status",$status,PDO::PARAM_INT);
                $stmt->bindParam(":hora_retirada", $hora_retirada, PDO::PARAM_STR);
                $stmt->bindParam(":parametro",$parametro,PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }else{
                return 0;
            }
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

}
?>