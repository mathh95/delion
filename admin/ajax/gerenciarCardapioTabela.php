<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once MODELPATH."/usuario.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlProduto.php";
include_once CONTROLLERPATH."/controlCategoria.php";
include_once MODELPATH."/produto.php";

$_SESSION['permissaoPagina']=0;
protegePagina();
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle_cardapio=new controlerProduto($_SG['link']);
$controle_categoria=new controlerCategoria($_SG['link']);

$permissao =  json_decode($usuarioPermissao->getPermissao());
if(in_array('cardapio', $permissao)){ 

	//Flag_servido
	if(
		(isset($_POST['filtro']) &&
		!empty($_POST['filtro'])) ||
		isset($_POST['producao'])) {

		$filtro = $_POST['filtro'];
		$flag_servindo = $_POST['producao'];
	}

	echo "<table class='table table-responsive table-striped table-hover' id='tbCardapio' 			style='text-align = center;'>
		<thead>
			<h1 >Gerenciar Cardapio</h1>
			<tr>
				<th width='30%' style='text-align: left;'>Item</th>
				<th width='10%' style='text-align: center;'>Preço</th>
				<th width='10%' style='text-align: center;'>Situação</th>
				<th width='10%' style='text-align: center;'>Prioridade</th>
				<th width='10%' style='text-align: center;'>Delivery</th>
				<th width='15%' style='text-align: center;'>Serviço</th>
				<th width='15%' style='text-align: center;'>Editar</th>
			</tr>
		<tbody>";


		$categorias = $controle_categoria->selectAllByPos();
		//itens por categoria ordenados
		foreach ($categorias as $key_cat => $categoria) {

			echo "<tr>
					<td colspan='7' style='background-color:#ee6938; color:white; font-size:20px;' >
						<img src='../../".$categoria->getIcone()."' style='max-height: 25px; border-radius:5px;' alt=''/>
						".$categoria->getNome()."
					</td>
				</tr>";

			
			//Condição para listar itens com filtro
			if(
				(isset($filtro) && strlen($filtro) > 3) ||
				isset($flag_servindo) && $flag_servindo != null
			) {

				$itens = $controle_cardapio->selectByCategoriaFilterPos(
					$categoria->getPkId(),
					$filtro,
					$flag_servindo
				);

			//todos os itens ordenados
			}else{
				$itens = $controle_cardapio->selectByCategoriaByPos(
					$categoria->getPkId()
				);
			}	
			
			foreach ($itens as $key_item => $item){		
	
				$mensagem='Cardápio excluído com sucesso!';
				$titulo='Excluir';
			
				echo "<tr name='resutaldo' id='status".$item->getPkId()."'>
					<td style='text-align: left;' name='nome'>"
						.$item->getNome().
						"&nbsp;<span style='cursor: pointer; font-size: 20px; top: 4px;' class='glyphicon glyphicon-camera glyphicon' aria-hidden='true' data-toggle='modal' data-target='#itemModal".$item->getPkId()."'></span>	

					</td>
					<td style='text-align: center;' name='preco'>R$ ".$item->getPreco()."</td>
					<td style='text-align: center;' name='flag_ativo'>".$item->getDsAtivo()."</td>
					<td style='text-align: center;' name='prioridade'>".$item->getDsPrioridade()."</td>
					<td style='text-align: center;' name='delivery'>".$item->getDsDelivery()."</td>";

					//serviço
					if($item->getFlag_servindo() == 1){

						echo "<td style='text-align: center;' name='status'><a href='../../ajax/alterar-servindo.php?op=pausar&cod=".$item->getPkId()."'><button type='button' class='btn btn-kionux' style='width: 100px'><i class='fa fa-pause'></i> Pausar</button></a></td>";
					
					}else{
						//Ativa o item
						echo "<td style='text-align: center;' name='status'><a href='../../ajax/alterar-servindo.php?op=ativar&cod=".$item->getPkId()."'><button type='button' class='btn btn-kionux' style='width: 100px'><i class='fa fa-play'></i> Ativar</button></a></td>";
		
					}

					echo "<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='produto-view.php?cod=".$item->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Editar</button></a></td>";

				echo "</tr>";
			}
		}
	}else{

		/*Sem PERMISSÃO*/
	}

echo "</tbody></table>";

//Modals fotos dos itens
//itens por categoria ordenados
foreach ($categorias as $key_cat => $categoria) {

	$itens = $controle_cardapio->selectByCategoriaByPos(
		$categoria->getPkId()
	);

	foreach ($itens as $key_item => $item){	

		echo '
		<div class="modal fade" id="itemModal'.$item->getPkId().'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						
						<h4 style="text-align:center;" class="modal-title" id="myModalLabel">
							<img src="../../'.$categoria->getIcone().'" style="max-height: 35px; background-color: #BE392A; border-radius:5px; alt=""/>

							&nbsp;'.$item->getNome().'
						</h4>
					</div>
					<div style="height:350px; text-align:center;"  class="modal-body">
						<img src="../../'.$item->getFoto().'" style="max-height: 300px" alt="Imagem não encontrada :/"/>
					</div>
				</div>
			</div>
		</div>';
	}
}

?>