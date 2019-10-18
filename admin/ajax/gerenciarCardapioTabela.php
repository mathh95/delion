<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once MODELPATH."/usuario.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlCardapio.php";
include_once CONTROLLERPATH."/controlCategoria.php";
include_once MODELPATH."/cardapio.php";

$_SESSION['permissaoPagina']=0;
protegePagina();
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle_cardapio=new controlerCardapio($_SG['link']);
$controle_categoria=new controlerCategoria($_SG['link']);

if((isset($_POST['nome']) && 
!empty($_POST['nome'])) || 		//Descrição do item
isset($_POST['producao'])){		//Flag_servido

	$nome = $_POST['nome'];
	$flag_servindo = $_POST['producao'];
	$cardapios = $controle->filterProducao($nome, $flag_servindo);	//Filtra pela descrição/flag_servido
}else{
	//order by pos -> categoria/itens
	$categorias = $controle_categoria->selectAllByPos();
	$cardapios = $controle_cardapio->selectAllByPos();
}
	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('cardapio', $permissao)){ 
		
		echo "<table class='table table-responsive table-striped table-hover' id='tbCardapio' style='text-align = center;'>
			<thead>
				<h1 class=\"page-header\">Gerenciar Cardapio</h1>
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

		//itens por categoria ordenados
		foreach ($categorias as $key_cat => $categoria) {

			echo "<tr>
					<td colspan='7' style='background-color:#ee6938; color:white; font-size:20px;' >
						<img src='../../".$categoria->getIcone()."' style='max-height: 25px; background-color: #BE392A; border-radius:5px;' alt=''/>
						".$categoria->getNome()."
					</td>
				</tr>";

			$itens = $controle_cardapio->selectByCategoriaByPos(
				$categoria->getCod_categoria()
			);

			foreach ($itens as $key_item => $item){		
	
				$mensagem='Cardápio excluído com sucesso!';
				$titulo='Excluir';
			
				echo "<tr name='resutaldo' id='status".$item->getCod_cardapio()."'>
					<td style='text-align: left;' name='nome'>"
						.$item->getNome().
						"&nbsp;<span style='cursor: pointer;' class='glyphicon glyphicon-camera glyphicon' aria-hidden='true' data-toggle='modal' data-target='#itemModal".$item->getCod_cardapio()."'></span>	

					</td>
					<td style='text-align: center;' name='preco'>R$ ".$item->getPreco()."</td>
					<td style='text-align: center;' name='flag_ativo'>".$item->getDsAtivo()."</td>
					<td style='text-align: center;' name='prioridade'>".$item->getDsPrioridade()."</td>
					<td style='text-align: center;' name='delivery'>".$item->getDsDelivery()."</td>";

					//serviço
					if($item->getFlag_servindo() == 1){

						echo "<td style='text-align: center;' name='status'><a href='../../ajax/alterar-flagPausado.php?cod=".$item->getCod_cardapio()."'><button type='button' class='btn btn-kionux' style='width: 100px'><i class='fa fa-pause'></i> Pausar</button></a></td>";
					
					}else{
						//Ativa o item
						echo "<td style='text-align: center;' name='status'><a href='../../ajax/alterar-flagAtivo.php?cod=".$item->getCod_cardapio()."'><button type='button' class='btn btn-kionux' style='width: 100px'><i class='fa fa-play'></i> Ativar</button></a></td>";
		
					}

					echo "<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='cardapio-view.php?cod=".$item->getCod_cardapio()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Editar</button></a></td>";

				echo "</tr>";
			}
		}
	}else{

		/*Sem PERMISSÃO*/
		
		// echo "<table class='table table-responsive' id='tbCardapio' style='text-align = center;'>
		// <thead>
		// 	<h1 class=\"page-header\">Lista de cardapio</h1>
		// 	<tr>
	    // 		<th width='14%' style='text-align: center;'>Item</th>
		// 		<th width='14%' style='text-align: center;'>Nome</th>
		// 		<th width='14%' style='text-align: center;'>Preço</th>
	    // 		<th width='14%' style='text-align: center;'>Descrição</th>
	    // 		<th width='12%' style='text-align: center;'>Categoria</th>
		// 		<th width='12%' style='text-align: center;'>Situação</th>
		// 		<th width='12%' style='text-align: center;'>Prioridade</th>
		// 		<th width='12%' style='text-align: center;'>Delivery</th>
	    //     </tr>
		// <tbody>";
	
		// foreach ($cardapios as &$cardapio) {
		// 	echo "<tr name='resutaldo' id='status".$cardapio->getCod_cardapio()."'>
		// 	 	<td style='text-align: center;' name='cardapio'><img src='../../".$cardapio->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
		// 		<td style='text-align: center;' name='nome'>".$cardapio->getNome()."</td>
		// 		<td style='text-align: center;' name='preco'>".$cardapio->getPreco()."</td>
		// 	 	<td style='text-align: center;' name='descricao'>".substr(html_entity_decode($cardapio->getDescricao()), 0, 200)."</td>
		// 	 	<td style='text-align: center;' name='categoria'>".$cardapio->getCategoria()."</td>
		// 		<td style='text-align: center;' name='flag_ativo'>".$cardapio->getDsAtivo()."</td>
		// 		<td style='text-align: center;' name='prioridade'>".$cardapio->getDsPrioridade()."</td>
		// 		<td style='text-align: center;' name='delivery'>".$cardapio->getDsDelivery()."</td>
		// 	</tr>";
		// }
	}

echo "</tbody></table>";

//Modals fotos dos itens
//itens por categoria ordenados
foreach ($categorias as $key_cat => $categoria) {

	$itens = $controle_cardapio->selectByCategoriaByPos(
		$categoria->getCod_categoria()
	);

	foreach ($itens as $key_item => $item){	

		echo '
		<div class="modal fade" id="itemModal'.$item->getCod_cardapio().'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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