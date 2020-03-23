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
	echo "
	<div class='table-responsive'>
	<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1>Lista de Produtos</h1>
		<tr>
		<th width='5%' style='text-align: center;'>#ID</th>
    		<th width='20%' style='text-align: center;'>Nome do Produto</th>
			<th width='7%' style='text-align: center;'>Preço de Custo</th>
			<th width='7%' style='text-align: center;'>Custo Extra</th>
			<th width='7%' style='text-align: center;'>Custo Total</th>
			<th width='7%' style='text-align: center;'>Valor de Venda</th>
			<th width='5%' style='text-align: center;'>Detalhes</th>
			<th width='5%' style='text-align: center;'>Editar</th>
        </tr>
	<tbody>";

	// var_dump($composicoes);
	// exit;
		if($composicoes != -1){
			foreach ($composicoes as $composicao) {

				$ingredientes_composicao = $controle->selectByFkComposicao($composicao->getPkId());
				$valor_custo = 0;
				foreach ($ingredientes_composicao as $key => $ingr){
					$qtd_utilizada = $ingr["coig_qtde_utilizada"];
					$valor_ingrediente = $ingr["igr_valor"];
					$valor_calculado = $valor_ingrediente * $qtd_utilizada;

					$valor_custo += $valor_calculado;
				}

				$valor_c = number_format($valor_custo, 2, ',', ' ');
				$valor_e = number_format($composicao->getValorExtra(), 2, ',', ' ');
				$valor_t = number_format($valor_custo + $composicao->getValorExtra(), 2, ',', ' ');
				$valor_v = number_format($composicao->pro_preco, 2, ',', ' ');
				
				
				echo "<tr name='resultado' id='status".$composicao->getPkId()."'>
					<td style='text-align: center;' name='id'>".$composicao->getPkId()."</td>
					<td style='text-align: center;' name='nome'>".$composicao->nome_prod."</td>

					<td style='text-align: center;' name='valor_custo'>R$ ".$valor_c."</td>
					<td style='text-align: center;' name='valor_extra'>R$ ".$valor_e."</td>
					<td style='text-align: center;' name='valor_total'>R$ ".$valor_t."</td>
					<td style='text-align: center;' name='valor_venda'>R$ ".$valor_v."</td>

					<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='composicaoDetalhes.php?cod=".$composicao->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Detalhes</button></a></td>
					<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='gerenciarComposicao.php?fk_produto=".$composicao->getFkProduto()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Editar</button></a></td>";

				echo "</tr>";
			}

		}else{
			echo "<h3>SEM RESULTADOS</h3>";
		}

		}else{

		}
		echo "</tbody></table>
				</div>";

		?>