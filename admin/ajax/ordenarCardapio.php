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

	//order by pos -> categoria/itens
	// $cardapios = $controle->selectAllByPos();
	// $qtd_cardapios = sizeof($cardapios);
	
	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('cardapio', $permissao)){
		
		$categorias = $controle_categoria->selectAllByPos();
		
		echo '<div id="list_categorias" class="col-sm-6 list-group" style="padding-right:0px!important">
		<label>Categorias (qtde. itens)</label>';	
		
		foreach ($categorias as $key => $categoria) {

			//itens por categoria ordenados
			$itens_categoria[$key] = $controle_cardapio->selectByCategoriaByPos(
				$categoria->getCod_categoria()
			);

			$qtd_itens[$key] = sizeof($itens_categoria[$key]);

			if ($key == 0){
				echo '<div data-id="'.$categoria->getCod_categoria().'" class="list-group-item categoria active">
					<span
						style="cursor:move;"
						class="glyphicon glyphicon-menu-hamburger" aria-hidden="true">
					</span>
					<span style="cursor:pointer;">'.$categoria->getNome().'</span>
					<span class="badge">'.$qtd_itens[$key].'</span>
					</div>';
			}else{
				echo '<div data-id="'.$categoria->getCod_categoria().'" class="list-group-item categoria">
					<span
						style="cursor:move;"
						class="glyphicon glyphicon-menu-hamburger" aria-hidden="true">
					</span>
					<span style="cursor:pointer;">'.$categoria->getNome().'</span>
					<span class="badge">'.$qtd_itens[$key].'</span>
					</div>';
			}
		}
		echo '</div>';


		echo '<div id="list_itens" class="col-sm-6 list-group">
			<label>Itens</label>';

		//itens por categoria ordenados
		foreach ($categorias as $key_cat => $categoria) {

			$itens = $controle_cardapio->selectByCategoriaByPos(
				$categoria->getCod_categoria()
			);

			foreach ($itens as $key_item => $item){
				
				if($key_cat == 0){//primeira categoria
					echo '<div
						data-id="'.$item->getCod_cardapio().'"
						data-cod_categoria='.$categoria->getCod_categoria().'
						class="list-group-item item">
						<span
							style="cursor:move;"
							class="glyphicon glyphicon-menu-hamburger" aria-hidden="true">
						</span>
						<span style="cursor:pointer;">'.$item->getNome().'</span>
						<span style="float:right;">R$&nbsp;'.$item->getPreco().'</span>
					</div>';

				}else{//hide
					echo '<div
						style="display:none;"
						data-id="'.$item->getCod_cardapio().'"
						data-cod_categoria='.$categoria->getCod_categoria().'
						class="list-group-item item">
						<span
							style="cursor:move;"
							class="glyphicon glyphicon-menu-hamburger" aria-hidden="true">
						</span>
						<span style="cursor:pointer;">'.$item->getNome().'</span>
						<span style="float:right;">R$&nbsp;'.$item->getPreco().'</span>
					</div>';
				}
			}
		}
		echo '</div>';

	}else{
		echo "";
	}

	