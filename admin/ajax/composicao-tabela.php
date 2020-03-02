<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once CONTROLLERPATH."/controlComposicao.php";
include_once MODELPATH."/usuario.php";

protegePagina();

$controle=new controlerComposicao($_SG['link']);
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$composicoes = $controle->selectAll();


$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('gerenciar_composicao', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1>Lista de Produtos</h1>
		<tr>
		<th width='15%' style='text-align: center;'>#ID</th>
    		<th width='20%' style='text-align: center;'>Nome do Produto</th>
			<th width='15%' style='text-align: center;'>Preço de Custo Total</th>
			<th width='15%' style='text-align: center;'>Valor Extra</th>
			<th width='15%' style='text-align: center;'>Detalhes</th>
			<th width='15%' style='text-align: center;'>Editar</th>
        </tr>
	<tbody>";
	foreach ($composicoes as $composicao) {
		$soma_valores = $controle->sumValorTotal($composicao->getPkId());
		$soma_valores_format =(number_format($soma_valores[0]["soma_valores"], 2, '.', ''));
		
        $mensagem='Preço de custo excluído com sucesso!';
        echo "<tr name='resultado' id='status".$composicao->getPkId()."'>
            <td style='text-align: center;' name='id'>".$composicao->getPkId()."</td>
			<td style='text-align: center;' name='nome'>".$composicao->nome_prod."</td>
			<td style='text-align: center;' name='valor'>R$ ".$soma_valores_format."</td>
			<td style='text-align: center;' name='valorExtra'>R$ ".$composicao->getValorExtra()."</td>
			<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='composicaoDetalhes.php?cod=".$composicao->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Detalhes</button></a></td>
			<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='gerenciarComposicao.php?fk_produto=".$composicao->getFkProduto()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Editar</button></a></td>";

		echo "</tr>";
	}
}else{

}
echo "</tbody></table>";

?>