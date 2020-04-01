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

    public function setPedido(
        $fk_endereco = NULL,
        $fk_origem_pedido,
        $itens_carrinho = array(),
        $adicionais_selecionados = NULL,
        $fidelidade_valida = TRUE,
        $itens_resgate = array()
    ){

        $cli_pk_id = $_SESSION['cod_cliente'];
        $subtotal = $_SESSION['valor_subtotal'];
        $desconto = $_SESSION['valor_cupom_var'];
        $total = $_SESSION['valor_total'];
        
        //valor sem frete
        $operacao_fidelidade = $_SESSION['total_com_desconto'];

        if(isset($_SESSION['delivery_time_var'])){
            $tempo_entrega = $_SESSION['delivery_time_var'];
        }else{
            $tempo_entrega = NULL;
        }

        if(isset($_SESSION['delivery_time_var'])){
            $taxa_entrega = $_SESSION['delivery_price_var'];
        }else{
            $taxa_entrega = NULL;
        }

        $formaPgt = $_SESSION['forma_pagamento'];
        $status = 1;//pedido recebido

        //Cupom settado
        if(
            isset($_SESSION['codigo_cupom']) && !empty($_SESSION['codigo_cupom'])
            && isset($_SESSION['pk_cupom']) && !empty($_SESSION['pk_cupom'])
        ){
            $pk_cupom = $_SESSION['pk_cupom'];
            $clcu_fk_cliente = $cli_pk_id;
            $clcu_fk_cupom = $pk_cupom;

            $sql = $this->pdo->prepare("INSERT INTO rl_cliente_cupom SET clcu_fk_cliente = :clcu_fk_cliente, clcu_fk_cupom = :clcu_fk_cupom, clcu_ultimo_uso = NOW()");
            $sql->bindValue(":clcu_fk_cliente", $clcu_fk_cliente);
            $sql->bindValue(":clcu_fk_cupom", $clcu_fk_cupom);
            if(!$sql->execute()) return FALSE;

            $sql=$this->pdo->prepare("UPDATE tb_cupom SET cup_qtde_atual = cup_qtde_atual - 1 WHERE cup_pk_id=:cup_pk_id");
            $sql->bindValue(":cup_pk_id",$pk_cupom);
            if(!$sql->execute()) return FALSE;

        }else{
            $pk_cupom = NULL;
        }

        //Total de pontos utilizados
        $pts_utilizados = 0;
        foreach($itens_resgate as $key => $item){
            $qtd_aux = $_SESSION['carrinho_resgate'][$item['pro_pk_id']]['qtd'];
            $pts_utilizados +=  ($qtd_aux * $item['pro_pts_resgate_fidelidade']);
        }
        //desconta pontos de resgate
        $operacao_fidelidade -= $pts_utilizados;

        //delivery / balcao (fk_endereco == null)
        $sql = $this->pdo->prepare("INSERT INTO tb_pedido SET ped_fk_cliente = :idCliente, ped_data = NOW(), ped_total = :total, ped_desconto = :desconto , ped_taxa_entrega = :taxa_entrega, ped_subtotal = :subtotal, ped_operacao_fidelidade = :operacao_fidelidade, ped_fk_forma_pgto = :formaPgt , ped_status = :status, ped_fk_origem_pedido = :origem, ped_fk_endereco_cliente = :endereco, ped_tempo_entrega = :tempo_entrega, ped_fk_cupom = :fk_cupom");

        $sql->bindValue(":idCliente", $cli_pk_id);
        $sql->bindValue(":subtotal", $subtotal);
        $sql->bindValue(":desconto",$desconto);
        $sql->bindValue(":total", $total);
        $sql->bindValue(":operacao_fidelidade", $operacao_fidelidade);
        $sql->bindValue(":formaPgt", $formaPgt);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":origem", $fk_origem_pedido);
        
        $sql->bindValue(":endereco", $fk_endereco);
        $sql->bindValue(":tempo_entrega", $tempo_entrega);
        $sql->bindValue(":taxa_entrega", $taxa_entrega);
        $sql->bindValue(":fk_cupom", $pk_cupom);

        if(!$sql->execute()) return FALSE;
        $id_pedido = $this->pdo->lastInsertId();


        //set itens Carrinho Convencional
        foreach($_SESSION['carrinho'] as $key => $value){
            $sql = $this->pdo->prepare("INSERT INTO rl_pedido_produto SET pepr_fk_produto = :cod_produto, pepr_fk_pedido = :cod_pedido, pepr_quantidade = :quantidade, pepr_preco = :pepr_preco, pepr_observacao = :observacao, pepr_arr_adicionais = :adicionais");
            
            $pk_item = $itens_carrinho[$key]['pro_pk_id'];

            $sql->bindValue(":cod_pedido", $id_pedido);
            $sql->bindValue(":cod_produto", $_SESSION['carrinho'][$key]);
            $sql->bindValue(":quantidade", $_SESSION['qtd'][$key]);
            $sql->bindValue(":pepr_preco", $itens_carrinho[$key]['pro_preco']);
            $sql->bindValue(":observacao", $_SESSION['observacao'][$key]);
            $sql->bindValue(":adicionais", json_encode($adicionais_selecionados[$pk_item]));
            
            if(!$sql->execute()) return FALSE;
        }
        
        
        //set itens Resgate de Fidelidade
        foreach($itens_resgate as $key => $item){

            $qtd_aux = $_SESSION['carrinho_resgate'][$item['pro_pk_id']]['qtd'];

            $sql = $this->pdo->prepare("INSERT INTO rl_pedido_produto SET pepr_fk_produto = :cod_produto, pepr_fk_pedido = :cod_pedido, pepr_quantidade = :quantidade, pepr_pts_resgate_fidelidade = :pts_resgate");

            $sql->bindValue(":cod_produto", $item['pro_pk_id']);
            $sql->bindValue(":cod_pedido", $id_pedido);
            $sql->bindValue(":quantidade", $qtd_aux);
            $sql->bindValue(":pts_resgate", $item['pro_pts_resgate_fidelidade']);
            

            if(!$sql->execute()) return FALSE;

        }

        //++ pontos de fidelidade em Cliente
        if($fidelidade_valida){
            $sql = $this->pdo->prepare("UPDATE tb_cliente
            SET cli_pontos_fidelidade = IFNULL(cli_pontos_fidelidade, 0) + :operacao_fidelidade
            WHERE cli_pk_id = :cli_pk_id");

            $sql->bindValue(":cli_pk_id", $cli_pk_id);
            $sql->bindValue(":operacao_fidelidade", $operacao_fidelidade);

            if(!$sql->execute()) return FALSE;
        }

        return TRUE;
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
                    $pedido->setTotal($result->ped_total);
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
         

            $stmte = $this->pdo->prepare("SELECT *
            FROM tb_pedido as PED
            INNER JOIN
            tb_cliente AS CLI ON
            PED.ped_fk_cliente = CLI.cli_pk_id
            LEFT JOIN
            rl_endereco_cliente AS ENCL ON
            PED.ped_fk_endereco_cliente = ENCL.encl_pk_id
            LEFT JOIN
            tb_endereco AS ENCO ON
            ENCL.encl_fk_endereco = ENCO.end_pk_id
            LEFT JOIN
            tb_origem_pedido AS ORPE ON
            PED.ped_fk_origem_pedido = ORPE.orpe_pk_id
            ORDER BY PED.ped_data DESC, cli_nome ASC LIMIT :offset, :por_pagina");

            $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
            $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
            $executa=$stmte->execute();

            if ($executa) {
                if ($stmte->rowCount() > 0) {
                    while ($result=$stmte->fetch(PDO::FETCH_OBJ)) {
                        $pedido = new pedido();
                        $pedido->setPkId($result->ped_pk_id);
                        $pedido->setData(new DateTime($result->ped_data));
                        $pedido->setTotal($result->ped_total);
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
                        $pedido->origem_pedido=($result->orpe_origem);

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


    function selectItens($pk_id){
    
        $produtos = array();

        $stmt=$this->pdo->prepare("SELECT * 
        FROM rl_pedido_produto AS PEPR
        LEFT JOIN tb_produto AS PRO
        ON PRO.pro_pk_id = PEPR.pepr_fk_produto
        WHERE PEPR.pepr_fk_pedido = :pk_id");
        
        $stmt->bindParam(":pk_id", $pk_id, PDO::PARAM_INT);
        $executa=$stmt->execute();
        if ($executa) {
            if ($stmt->rowCount() > 0 ){
                while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                    $pedido_produto = new pedido_produto();
                    $pedido_produto->setFkProduto($result->pepr_fk_produto);
                    $pedido_produto->setFkPedido($result->pepr_fk_pedido);
                    $pedido_produto->setQuantidade($result->pepr_quantidade);
                    $pedido_produto->setObservacao($result->pepr_observacao);
                    $pedido_produto->setPreco($result->pepr_preco);
                    $pedido_produto->nome=($result->pro_nome);
                    $pedido_produto->arr_adicionais=($result->pepr_arr_adicionais);

                    array_push($produtos,$pedido_produto);
                }
            }else{
                // echo "Pedido inconsistente...contate o Suporte!";
                return -1;
            }
            return $produtos;
        }else {
            return -1;
        }        
    }

    //Filtro para nome, valormenor e valormaior
    function filter($parametro,$totalmenor, $totalmaior){

        $pedidos=array();
        $parametro = "%".$parametro."%";

        $stmt=$this->pdo->prepare("SELECT *
        FROM tb_pedido as PED
        INNER JOIN
        tb_cliente AS CLI ON
        PED.ped_fk_cliente = CLI.cli_pk_id
        LEFT JOIN
        rl_endereco_cliente AS ENCL ON
        PED.ped_fk_endereco_cliente = ENCL.encl_pk_id
        LEFT JOIN
        tb_endereco AS ENCO ON
        ENCL.encl_fk_endereco = ENCO.end_pk_id
        LEFT JOIN
        tb_origem_pedido AS ORPE ON
        PED.ped_fk_origem_pedido = ORPE.orpe_pk_id
        WHERE CLI.cli_nome like :parametro AND PED.ped_total > :totalmenor AND PED.ped_total < :totalmaior
        ORDER BY PED.ped_data DESC");

        $stmt->bindValue(":parametro", $parametro, PDO::PARAM_STR);
        $stmt->bindParam(":totalmenor", $totalmenor, PDO::PARAM_INT);
        $stmt->bindParam(":totalmaior", $totalmaior, PDO::PARAM_INT);
        $executa=$stmt->execute();

        if ($executa) {
            if ($stmt->rowCount() > 0) {
                while ($result=$stmt->fetch(PDO::FETCH_OBJ)) {
                    $pedido = new pedido();
                    $pedido->setPkId($result->ped_pk_id);
                    $pedido->setData(new DateTime($result->ped_data));
                    $pedido->setTotal($result->ped_total);
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
                    $pedido->origem_pedido=($result->orpe_origem);

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


    function selectAllPedido($parametro, $totalmenor, $totalmaior){

        $pedidos=array();
        $parametro = "%".$parametro."%";

        $stmt=$this->pdo->prepare("SELECT *
        FROM tb_pedido as PED
        INNER JOIN
        tb_cliente AS CLI ON
        PED.ped_fk_cliente = CLI.cli_pk_id
        LEFT JOIN
        rl_endereco_cliente AS ENCL ON
        PED.ped_fk_endereco_cliente = ENCL.encl_pk_id
        LEFT JOIN
        tb_endereco AS ENCO ON
        ENCL.encl_fk_endereco = ENCO.end_pk_id
        ORDER BY PED.ped_data DESC"); //Ordenação por cod do pedido

        $stmt->bindValue(":nome", $parametro);
        $stmt->bindParam(":menor", $totalmenor, PDO::PARAM_INT);
        $stmt->bindParam(":maior", $totalmaior, PDO::PARAM_INT);
        $executa=$stmt->execute();

        if ($executa) {
            if ($stmt->rowCount() > 0) {
                while ($result=$stmt->fetch(PDO::FETCH_OBJ)) {
                    $pedido = new pedido();
                    $pedido->setPkId($result->ped_pk_id);
                    $pedido->setData(new DateTime($result->ped_data));
                    $pedido->setTotal($result->ped_total);
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

    function filterEndereco($nome_cliente, $totalmenor, $totalmaior, $endereco){

        $pedidos=array();
        $nome_cliente = "%".$nome_cliente."%";
        $endereco = "%" . $endereco . "%";

        $stmt=$this->pdo->prepare("SELECT *
        FROM tb_pedido as PED
        INNER JOIN
        tb_cliente AS CLI ON
        PED.ped_fk_cliente = CLI.cli_pk_id
        LEFT JOIN
        rl_endereco_cliente AS ENCL ON
        PED.ped_fk_endereco_cliente = ENCL.encl_pk_id
        LEFT JOIN
        tb_endereco AS ENCO ON
        ENCL.encl_fk_endereco = ENCO.end_pk_id
        LEFT JOIN
        tb_origem_pedido AS ORPE ON
        PED.ped_fk_origem_pedido = ORPE.orpe_pk_id
        WHERE CLI.cli_nome like :nome AND PED.ped_total > :menor AND PED.ped_total < :maior
        AND ENCO.end_logradouro LIKE :rua OR ENCL.encl_numero LIKE :numero OR ENCO.end_cep LIKE :cep");

        $stmt->bindValue(":nome", $nome_cliente);
        $stmt->bindValue(":rua", $endereco);
        $stmt->bindValue(":numero", $endereco);
        $stmt->bindValue(":cep", $endereco);
        $stmt->bindParam(":menor", $totalmenor, PDO::PARAM_INT);
        $stmt->bindParam(":maior", $totalmaior, PDO::PARAM_INT);
        $executa=$stmt->execute();

        if ($executa) {
            if ($stmt->rowCount() > 0) {
                while ($result=$stmt->fetch(PDO::FETCH_OBJ)) {
                    $pedido = new pedido();
                    $pedido->setPkId($result->ped_pk_id);
                    $pedido->setData(new DateTime($result->ped_data));
                    $pedido->setTotal($result->ped_total);
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
                    $pedido->origem_pedido=($result->orpe_origem);

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