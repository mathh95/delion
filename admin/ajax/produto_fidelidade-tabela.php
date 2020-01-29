<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlProduto.php";
include_once MODELPATH."/produto.php";
protegePagina();

$controle = new controlerProduto($_SG['link']);
$produtos = $controle->selectAllByFidelidade();

	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('gerenciar_fidelidade', $permissao) && $produtos){
	
		echo "<table class='table table-responsive' id='tbProduto_fidelidade' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Produtos em Fidelidade</h1>
			<tr>
	    		<th width='15%' style='text-align: center;'>Img</th>
	    		<th width='10%' style='text-align: center;'>Pontos p/ Resgate</th>
	    		<th width='50%' style='text-align: center;'>Produto</th>
	            <th width='10%' style='text-align: center;'>Remover</th>
	        </tr>
		<tbody>";
	
		foreach ($produtos as $produto) {
			
			echo "<tr name='resultado' id='status".$produto->getPkId()."'>

				<td style='text-align: center;' name='cardapio'><img src='../../".$produto->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>

				<td style='text-align: center;' name='pontos_resgate'>".$produto->getPtsResgateFidelidade()."</td>
				
				<td style='text-align: center;' name='nome'>".$produto->getNome()."</td>
				 				 
				<td style='text-align: center;' name='status'><button type='button' onclick=\"removeProdutoFidelidade(".$produto->getPkId().");\" class='btn btn-kionux'><i class='fa fa-remove'></i>&nbsp;Remover</button></td>
				
			</tr>";
		}
	}else{
		echo "<h1>Sem Resultados</h1>";
	}

echo "</tbody></table>";
?>