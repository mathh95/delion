<?php
//  session_start();
ini_set("allow_url_include", true);
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";    
include_once MODELPATH."/produto.php";
include_once MODELPATH."/pedido.php";
include_once MODELPATH."/pedido_produto.php";
include_once CONTROLLERPATH. "/controlCupom.php";
include_once CONTROLLERPATH. "/controlClienteCupom.php";


class controlerCarrinho{

    private $pdo;

    function __construct($pdo){
        $this->pdo=$pdo;
    }

    public function setPedido($endereco, $fk_origem_pedido, $produtos){

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

            $clcu_fk_cliente = $idCliente;
            $clcu_fk_cupom = $codcupom;

            $sql=$this->pdo->prepare("INSERT INTO rl_cliente_cupom SET clcu_fk_cliente = :clcu_fk_cliente, clcu_fk_cupom = :clcu_fk_cupom, clcu_ultimo_uso = NOW()");
            $sql->bindValue(":clcu_fk_cliente", $clcu_fk_cliente);
            $sql->bindValue(":clcu_fk_cupom", $clcu_fk_cupom);
            $sql->execute();

            $parametro = $codigocupom;
            $sql=$this->pdo->prepare("UPDATE tb_cupom SET cup_qtde_atual = qtde_atual - 1 WHERE cup_codigo=:parametro");
            $sql->bindValue(":parametro",$parametro);
            $sql->execute();

            $status = 1;//recebido, pronto, saiu
            if ($endereco == null){
                $sql = $this->pdo->prepare("INSERT INTO tb_pedido SET ped_fk_cliente = :idCliente, ped_data = NOW(), ped_valor = :valor, ped_desconto = :desconto , ped_taxa_entrega = :taxa_entrega, ped_subtotal = :subtotal, ped_fk_forma_pgto = :formaPgt ,status = :status, ped_fk_origem_pedido = :origem");
            }else{
                $sql = $this->pdo->prepare("INSERT INTO tb_pedido SET ped_fk_cliente = :idCliente, ped_data = NOW(), ped_valor = :valor, ped_desconto = :desconto , taxa_entrega = :taxa_entrega, ped_subtotal = :subtotal, ped_fk_forma_pgto = :formaPgt , ped_status = :status, ped_fk_origem_pedido = :origem, ped_fk_endereco_cliente = :endereco, ped_tempo_entrega = :tempo_entrega");

                $sql->bindValue(":endereco", $endereco);
                $sql->bindValue(":tempo_entrega", $tempo_entrega);
            }

            $sql->bindValue(":idCliente", $idCliente);
            // $sql->bindValue(":data", $data);
            $sql->bindValue(":valor", $valor);
            $sql->bindValue(":desconto", $desconto);
            $sql->bindValue(":taxa_entrega", $taxa_entrega);
            $sql->bindValue(":subtotal", $subtotal);
            $sql->bindValue(":formaPgt", $formaPgt);
            $sql->bindValue(":status", $status);
            $sql->bindValue(":origem", $fk_origem_pedido);

            $sql->execute();

            $idPedido = $this->pdo->lastInsertId();


            foreach($_SESSION['carrinho'] as $key => $value){
                $sql = $this->pdo->prepare("INSERT INTO rl_pedido_produto SET pepr_fk_produto = :cod_produto, pepr_fk_pedido = :cod_pedido, pepr_quantidade = :quantidade, pepr_observacao = :observacao, pepr_preco = :pepr_preco");

                $sql->bindValue(":cod_produto", $_SESSION['carrinho'][$key]);
                $sql->bindValue(":cod_pedido", $idPedido);
                $sql->bindValue(":quantidade", $_SESSION['qtd'][$key]);
                $sql->bindValue(":observacao", $_SESSION['observacao'][$key]);
                $sql->bindValue(":pepr_preco", $produtos[$key]['pro_preco']);

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
            $status = 1;


            if ($endereco == null){
                $sql = $this->pdo->prepare("INSERT INTO tb_pedido SET ped_fk_cliente = :idCliente,  ped_data = NOW(),  ped_valor = :valor,  ped_desconto = :desconto, ped_taxa_entrega = :taxa_entrega,  ped_subtotal = :subtotal, ped_fk_forma_pgto = :formaPgt,  ped_status = :status,  ped_fk_origem_pedido = :origem");
            
            }else{
            
                $sql = $this->pdo->prepare("INSERT INTO tb_pedido SET ped_fk_cliente = :idCliente, ped_data = NOW(), ped_valor = :valor, ped_desconto = :desconto, ped_taxa_entrega = :taxa_entrega, ped_subtotal = :subtotal, ped_fk_forma_pgto = :formaPgt, ped_status = :status, ped_fk_origem_pedido = :origem, ped_fk_endereco_cliente = :endereco, ped_tempo_entrega = :tempo_entrega");

                $sql->bindValue(":endereco", $endereco);
                $sql->bindValue(":tempo_entrega", $tempo_entrega);
            }
    
            $sql->bindValue(":idCliente", $idCliente);
            // $sql->bindValue(":data", $data);
            $sql->bindValue(":valor", $valor);
            $sql->bindValue(":desconto",$desconto);
            $sql->bindValue(":taxa_entrega", $taxa_entrega);
            $sql->bindValue(":subtotal", $subtotal);
            $sql->bindValue(":formaPgt", $formaPgt);
            $sql->bindValue(":status", $status);
            $sql->bindValue(":origem", $fk_origem_pedido);
    
            $sql->execute();
    
            $idPedido = $this->pdo->lastInsertId();
            
            foreach($_SESSION['carrinho'] as $key => $value){
    
                $sql = $this->pdo->prepare("INSERT INTO  rl_pedido_produto SET pepr_fk_produto = :cod_produto, pepr_fk_pedido = :cod_pedido, pepr_quantidade = :quantidade, pepr_observacao = :observacao, pepr_preco = :pepr_preco");
    
                $sql->bindValue(":cod_produto", $_SESSION['carrinho'][$key]);
                $sql->bindValue(":cod_pedido", $idPedido);
                $sql->bindValue(":quantidade", $_SESSION['qtd'][$key]);
                $sql->bindValue(":observacao", $_SESSION['observacao'][$key]);
                $sql->bindValue(":pepr_preco", $produtos[$key]['pro_preco']);

                $sql->execute();
            }
    
            $_SESSION['carrinho'] = array();
            $_SESSION['qtd'] = array();
            $_SESSION['observacao'] = array();
            $_SESSION['totalCarrinho'] = array();
        }
    }

    function selectPedido($fk_cliente){
        $parametro = $fk_cliente;
        $pedidos= array();
        $stmt=$this->pdo->prepare("SELECT *
        FROM tb_pedido
        WHERE ped_fk_cliente=:parametro
        ORDER BY ped_data DESC, ped_pk_id DESC");

        $stmt->bindParam(":parametro", $parametro, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0 ){
                while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                    $pedido = new pedido();
                    $pedido->setPkId($result->ped_pk_id);
                    $pedido->setData(new DateTime($result->ped_data));
                    $pedido->setValor($result->ped_valor);
                    $pedido->setDesconto($result->ped_desconto);
                    $pedido->setTaxa_entrega($result->ped_taxa_entrega);
                    $pedido->setTempo_entrega($result->ped_tempo_entrega);
                    $pedido->setSubtotal($result->ped_subtotal);
                    $pedido->setFormaPgt($result->ped_fk_forma_pgto);
                    $pedido->setStatus($result->ped_status);
                    $pedido->setFKOrigemPedido($result->ped_fk_origem_pedido);
                    $pedido->setHora_print($result->ped_hora_print);
                    $pedido->setHora_delivery($result->ped_hora_delivery);
                    $pedido->setHora_retirada($result->ped_hora_retirada);
                    array_push($pedidos, $pedido);  
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
        $delivery = true;
        $pedidos = array();
        try{
            if ($delivery == true){

                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_pedido as PED
                INNER JOIN
                tb_cliente AS CLI ON
                PED.ped_fk_cliente = CLI.cli_pk_id
                INNER JOIN
                rl_endereco_cliente AS ENCL ON
                PED.ped_fk_endereco_cliente = ENCL.encl_pk_id
                INNER JOIN
                tb_endereco AS ENCO ON
                ENCL.encl_fk_endereco = ENCO.end_pk_id
                ORDER BY PED.ped_data DESC, cli_nome ASC LIMIT :offset, :por_pagina");

                $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
                $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
                $executa=$stmte->execute();

            }else{

                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_pedido AS PED
                INNER JOIN
                tb_cliente AS CLI ON
                PED.ped_fk_cliente = CLI.cli_pk_id
                INNER JOIN
                rl_endereco_cliente AS ENCL ON
                PED.ped_fk_endereco_cliente = ENCL.encl_pk_id
                INNER JOIN
                tb_endereco AS ENCO ON
                ENCO.end_pk_id = ENCL.encl_pk_id
                ORDER BY PED.ped_data DESC, cli_nome ASC LIMIT :offset, :por_pagina");
                $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
                $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
                $executa=$stmte->execute();

            }
            if ($executa) {
                if ($stmte->rowCount() > 0) {
                    while ($result=$stmte->fetch(PDO::FETCH_OBJ)) {
                        $pedido = new pedido();
                        $pedido->setPkId($result->ped_pk_id);
                        $pedido->setData(new DateTime($result->ped_data));
                        $pedido->setValor($result->ped_valor);
                        $pedido->setDesconto($result->ped_desconto);
                        $pedido->setTaxa_entrega($result->ped_taxa_entrega);
                        $pedido->setTempo_entrega($result->ped_tempo_entrega);
                        $pedido->setSubtotal($result->ped_subtotal);
                        $pedido->setFormaPgt($result->ped_fk_forma_pgto);
                        $pedido->setStatus($result->ped_status);
                        $pedido->setFkOrigemPedido($result->ped_fk_origem_pedido);
                        $pedido->setHora_print($result->ped_hora_print);
                        $pedido->setHora_delivery($result->ped_hora_delivery);
                        $pedido->setHora_retirada($result->ped_hora_retirada);
                        $pedido->setFKCliente($result->cli_nome);//texto em campo de fk

                        $pedido->telefone=($result->cli_telefone);
                        $pedido->numero=($result->encl_numero);
                        $pedido->complemento=($result->encl_complemento);
                        $pedido->bairro=($result->end_bairro);
                        $pedido->rua=($result->end_logradouro);
                        $pedido->cep=($result->end_cep);

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
        $produtos=array();
        $stmt=$this->pdo->prepare("SELECT * 
        FROM rl_pedido_produto AS PEPR
        INNER JOIN tb_produto AS PRO
        ON PRO.pro_pk_id = PEPR.pepr_fk_produto
        WHERE PEPR.pepr_fk_pedido = :parametro");
        
        $stmt->bindParam(":parametro", $parametro, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0 ){
                while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                    $pedido_produto = new pedido_produto();
                    $pedido_produto->setFkProduto($result->pepr_fk_produto);
                    $pedido_produto->setQuantidade($result->pepr_quantidade);
                    $pedido_produto->setObservacao($result->pepr_observacao);
                    $pedido_produto->preco=($result->pepr_preco);
                    $pedido_produto->nome=($result->pro_nome);

                    array_push($produtos,$pedido_produto);  
                }
            }else{
                echo "Sem resultados";
                return -1;
            }
            return $produtos;
        }else {
            return -1;
        }        
    }

    //Filtro para nome, valormenor e valormaior
    function filter($parametro,$valormenor, $valormaior){

        $pedidos=array();
        $parametro = "%".$parametro."%";

        $stmt=$this->pdo->prepare("SELECT *
        FROM tb_pedido as PED
        INNER JOIN
        tb_cliente AS CLI ON
        PED.ped_fk_cliente = CLI.cli_pk_id
        INNER JOIN
        rl_endereco_cliente AS ENCL ON
        PED.ped_fk_endereco_cliente = ENCL.encl_pk_id
        INNER JOIN
        tb_endereco AS ENCO ON
        ENCL.encl_fk_endereco = ENCO.end_pk_id
        WHERE CLI.cli_nome like :parametro AND PED.ped_valor > :valormenor AND PED.ped_valor < :valormaior
        ORDER BY PED.ped_data DESC");

        $stmt->bindValue(":parametro", $parametro, PDO::PARAM_STR);
        $stmt->bindParam(":valormenor", $valormenor, PDO::PARAM_INT);
        $stmt->bindParam(":valormaior", $valormaior, PDO::PARAM_INT);
        $executa=$stmt->execute();

        if ($executa) {
            if ($stmt->rowCount() > 0) {
                while ($result=$stmt->fetch(PDO::FETCH_OBJ)) {
                    $pedido = new pedido();
                    $pedido->setPkId($result->ped_pk_id);
                    $pedido->setData(new DateTime($result->ped_data));
                    $pedido->setValor($result->ped_valor);
                    $pedido->setDesconto($result->ped_desconto);
                    $pedido->setTaxa_entrega($result->ped_taxa_entrega);
                    $pedido->setTempo_entrega($result->ped_tempo_entrega);
                    $pedido->setSubtotal($result->ped_subtotal);
                    $pedido->setFormaPgt($result->ped_fk_forma_pgto);
                    $pedido->setStatus($result->ped_status);
                    $pedido->setFkOrigemPedido($result->ped_fk_origem_pedido);
                    $pedido->setHora_print($result->ped_hora_print);
                    $pedido->setHora_delivery($result->ped_hora_delivery);
                    $pedido->setHora_retirada($result->ped_hora_retirada);
                    $pedido->setFKCliente($result->cli_nome);//texto em campo de fk

                    $pedido->telefone=($result->cli_telefone);
                    $pedido->numero=($result->encl_numero);
                    $pedido->complemento=($result->encl_complemento);
                    $pedido->bairro=($result->end_bairro);
                    $pedido->rua=($result->end_logradouro);
                    $pedido->cep=($result->end_cep);

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

        $stmt=$this->pdo->prepare("SELECT *
        FROM tb_pedido as PED
        INNER JOIN
        tb_cliente AS CLI ON
        PED.cliente = CLI.cod_cliente
        INNER JOIN
        rl_endereco_cliente AS ENCL ON
        PED.ped_fk_endereco_cliente = ENCL.encl_pk_id
        INNER JOIN
        tb_endereco AS ENCO ON
        ENCL.encl_fk_endereco = ENCO.end_pk_id
        ORDER BY PED.data DESC"); //Ordenação por cod do pedido

        $stmt->bindValue(":nome", $parametro);
        $stmt->bindParam(":menor", $valormenor, PDO::PARAM_INT);
        $stmt->bindParam(":maior", $valormaior, PDO::PARAM_INT);
        $executa=$stmt->execute();

        if ($executa) {
            if ($stmt->rowCount() > 0) {
                while ($result=$stmt->fetch(PDO::FETCH_OBJ)) {
                    $pedido = new pedido();
                    $pedido->setPkId($result->ped_pk_id);
                    $pedido->setData(new DateTime($result->ped_data));
                    $pedido->setValor($result->ped_valor);
                    $pedido->setDesconto($result->ped_desconto);
                    $pedido->setTaxa_entrega($result->ped_taxa_entrega);
                    $pedido->setTempo_entrega($result->ped_tempo_entrega);
                    $pedido->setSubtotal($result->ped_subtotal);
                    $pedido->setFormaPgt($result->ped_fk_forma_pgto);
                    $pedido->setStatus($result->ped_status);
                    $pedido->setFkOrigemPedido($result->ped_fk_origem_pedido);
                    $pedido->setHora_print($result->ped_hora_print);
                    $pedido->setHora_delivery($result->ped_hora_delivery);
                    $pedido->setHora_retirada($result->ped_hora_retirada);
                    $pedido->setFKCliente($result->cli_nome);//texto em campo de fk

                    $pedido->telefone=($result->cli_telefone);
                    $pedido->numero=($result->encl_numero);
                    $pedido->complemento=($result->encl_complemento);
                    $pedido->bairro=($result->end_bairro);
                    $pedido->rua=($result->end_logradouro);
                    $pedido->cep=($result->end_cep);

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

        $stmt=$this->pdo->prepare("SELECT *
        FROM tb_pedido as PED
        INNER JOIN
        tb_cliente AS CLI ON
        PED.ped_fk_cliente = CLI.cli_pk_id
        INNER JOIN
        rl_endereco_cliente AS ENCL ON
        PED.ped_fk_endereco_cliente = ENCL.encl_pk_id
        INNER JOIN
        tb_endereco AS ENCO ON
        ENCL.encl_fk_endereco = ENCO.end_pk_id
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
                    $pedido->setPkId($result->ped_pk_id);
                    $pedido->setData(new DateTime($result->ped_data));
                    $pedido->setValor($result->ped_valor);
                    $pedido->setDesconto($result->ped_desconto);
                    $pedido->setTaxa_entrega($result->ped_taxa_entrega);
                    $pedido->setTempo_entrega($result->ped_tempo_entrega);
                    $pedido->setSubtotal($result->ped_subtotal);
                    $pedido->setStatus($result->ped_status);
                    $pedido->setFKOrigemPedido($result->ped_fk_origem_pedido);

                    $pedido->cliente=($result->cli_nome);
                    $pedido->telefone=($result->cli_telefone);
                    $pedido->numero=($result->encl_numero);
                    $pedido->complemento=($result->encl_complemento);
                    $pedido->bairro=($result->end_bairro);
                    $pedido->rua=($result->end_logradouro);
                    $pedido->cep=($result->end_cep);

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
                $stmt=$this->pdo->prepare("UPDATE tb_pedido SET ped_status=:status, ped_hora_print=:hora_print WHERE ped_pk_id=:parametro");
                $stmt->bindParam(":status",$status,PDO::PARAM_INT);
                $stmt->bindParam(":hora_print", $hora_print, PDO::PARAM_STR);
                $stmt->bindParam(":parametro",$parametro,PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }else if($status =="3"){

                date_default_timezone_set('America/Bahia');
                $hora_delivery = date('H:i');
                $parametro=$cod_pedido;
                $stmt=$this->pdo->prepare("UPDATE tb_pedido SET ped_status=:status, ped_hora_delivery=:hora_delivery WHERE ped_pk_id=:parametro");
                $stmt->bindParam(":status", $status,PDO::PARAM_INT);
                $stmt->bindParam(":hora_delivery", $hora_delivery, PDO::PARAM_STR);
                $stmt->bindParam(":parametro", $parametro,PDO::PARAM_INT);
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
                $stmt=$this->pdo->prepare("UPDATE tb_pedido SET ped_status=:status, ped_hora_retirada=:hora_retirada WHERE ped_pk_id=:parametro");
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