<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once MODELPATH."/usuario.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlCardapio.php";
include_once MODELPATH."/cardapio.php";

$_SESSION['permissaoPagina']=0;
protegePagina();
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle=new controlerCardapio($_SG['link']);
if((isset($_POST['nome']) && 
!empty($_POST['nome'])) || 
isset($_POST['flag']) || 
isset($_POST['delivery']) || 
isset($_POST['prioridade']) || 
isset($_POST['categoria'])){

	$nome = $_POST['nome'];
	$flag_ativo= $_POST['flag'];
	$prioridade=$_POST['prioridade'];
	$categoria=$_POST['categoria'];
	$cardapios = $controle->filterDelivery($nome, $flag_ativo, $prioridade, $categoria);
}
else{
	$cardapios = $controle->selectAllDelivery();
}


$permissao = json_decode($usuarioPermissao->getPermissao());
if(in_array('pedidoWpp', $permissao)){ 
    echo "
    <h1 class=\"page-header\">Lista de cardapio</h1>
    <table class='table table-responsive' id='tbCardapio' style='text-align = center;'>
        <thead>
            <tr>
                <th width='14%' style='text-align: center;'>Item</th>
                <th width='14%' style='text-align: center;'>Nome</th>
                <th width='8%' style='text-align: center;'>Preço</th>
                <th width='8%' style='text-align:center;'>Desconto</th>
                <th width='14%' style='text-align: center;'>Descrição</th>
                <th width='8%' style='text-align: center;'>Categoria</th>
                <th width='8%' style='text-align: center;'>Situação</th>
                <th width='8%' style='text-align: center;'>Prioridade</th>
                <th width='8%' style='text-align:center;'>Delivery</th>
            </tr>
        </thead>
        <tbody>";

    foreach ($cardapios as &$cardapio) {
        echo "
        <tr name='resutaldo' id='status".$cardapio->getCod_cardapio()."'>
            <td style='text-align: center;' name='cardapio'><img src='../../".$cardapio->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
            <td style='text-align: center;' name='nome'>".$cardapio->getNome()."</td>
            <td style='text-align: center;' name='preco'>"."R$ ".$cardapio->getPreco()."</td>
            <td style='text-align: center;' name='desconto'>".$cardapio->getDesconto()."%</td>
            <td style='text-align: center;' name='descricao'>".substr(html_entity_decode($cardapio->getDescricao()), 0, 200). "</td>
            <td style='text-align: center;' name='categoria'>".$cardapio->getCategoria()."</td>
            <td style='text-align: center;' name='flag_ativo'>".$cardapio->getDsAtivo()."</td>
            <td style='text-align: center;' name='prioridade'>".$cardapio->getDsPrioridade()."</td>
            <td style='text-align: center;' name='delivery'>".$cardapio->getDsDelivery()."</td>
            <td style='text-align: center;' name='adicionar'><input type='button' class='btn btn-kionux btn-add' data-id='".$cardapio->getCod_cardapio()."' value='Adicionar'></input></td>
        </tr>";
    }
    echo "</tbody></table>";
}

?>
