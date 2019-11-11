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

	//order by pos -> categoria/itens
	// $cardapios = $controle->selectAllByPos();
	// $qtd_cardapios = sizeof($cardapios);
	
	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('cardapio', $permissao)){
		
		echo "<table class='table table-responsive table-striped table-hover' id='tbCardapio' 			style='text-align = center;'>
		<thead>
			<tr>
				<th width='30%' style='text-align: left;'>Item</th>
				<th width='10%' style='text-align: center;'>Preço</th>
				<th width='10%' style='text-align: center;'>Delivery</th>
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
					$categoria->getCod_categoria(),
					$filtro,
					$flag_servindo
				);

			//todos os itens ordenados
			}else{
				$itens = $controle_cardapio->selectByCategoriaByPos(
					$categoria->getCod_categoria()
				);
			}	
			
			foreach ($itens as $key_item => $item){		
	
				$mensagem='Cardápio excluído com sucesso!';
				$titulo='Excluir';
			
				echo "<tr name='resutaldo' id='status".$item->getCod_cardapio()."'>
					<td style='text-align: left;' name='nome'>"
						.$item->getNome()."&nbsp;	
                    </td>
                    
					<td style='text-align: center;' name='preco'>R$ ".$item->getPreco()."</td>
                    <td style='text-align: center;' name='delivery'>".$item->getDsDelivery()."</td>
                    </tr>";
                }
            }

	}else{
		echo "";
	}

	