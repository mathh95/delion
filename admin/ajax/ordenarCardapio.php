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

	$controle=new controlerCardapio($_SG['link']);
	$controle_categoria=new controlerCategoria($_SG['link']);

	//order by pos -> categoria/itens
	// $cardapios = $controle->selectAllByPos();
	// $qtd_cardapios = sizeof($cardapios);
	
	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('cardapio', $permissao)){
		
		$categorias = $controle_categoria->selectAllByPos();
		$qtd_categorias = sizeof($categorias);

		echo '<div id="list_categorias" class="col-sm-6 list-group" style="padding-right:0px!important">
		<label>Categorias</label>';	
		
		foreach ($categorias as $key => $categoria) {

			//itens por categoria ordenados
			$itens_categoria[$key] =  $controle->selectByCategoriaByPos(
				$categoria->getCod_categoria()
			);

			$qtd_itens[$key] = sizeof($itens_categoria[$key]);

			if ($key == 0){
				echo '<div data-id="'.$categoria->getCod_categoria().'" class="list-group-item active">
					<span
						style="cursor:move;"
						class="glyphicon glyphicon-menu-hamburger" aria-hidden="true">
					</span>
					'.$categoria->getNome().'
					<span class="badge">'.$qtd_itens[$key].'</span>
					</div>';
			}else{
				echo '<div data-id="'.$categoria->getCod_categoria().'" class="list-group-item">
					<span
						style="cursor:move;"
						class="glyphicon glyphicon-menu-hamburger" aria-hidden="true">
					</span>
					'.$categoria->getNome().'
					<span class="badge">'.$qtd_itens[$key].'</span>
					</div>';
			}
		}
		echo '</div>';


		echo '<div id="list_itens" class="col-sm-6 list-group">
				<label>Itens</label>';
		//itens por categoria ordenados
		foreach ($itens_categoria as $key_cat => $itens) {
			
			foreach ($itens as $key_item => $item){
				
				if($key_cat == 0){//primeira categoria
					echo '<div
						data-id="'.$item->getCod_cardapio().'"
						data-categoria='.$item->getCategoria().'
						class="list-group-item">
						<span
							style="cursor:move;"
							class="glyphicon glyphicon-menu-hamburger" aria-hidden="true">
						</span>
							'.$item->getNome().'
						<span style="float:right;">R$&nbsp;'.$item->getPreco().'</span>
					</div>';

				}else{//hide
					echo '<div
						style="display:none;"
						data-id="'.$item->getCod_cardapio().'"
						data-categoria='.$item->getCategoria().'
						class="list-group-item">
						<span
							style="cursor:move;"
							class="glyphicon glyphicon-menu-hamburger" aria-hidden="true">
						</span>
							'.$item->getNome().'
						<span style="float:right;">R$&nbsp;'.$item->getPreco().'</span>
					</div>';
				}
			}
		}
		echo '</div>';

	}else{
		echo "";
	}

	