<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlSubCat.php";
include_once MODELPATH."/subcat.php";
protegePagina();

$controle=new controlerSubCat($_SG['link']);
$subcategorias = $controle->selectAll();

	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('categoria', $permissao)){
	
		echo "
		<div class='table-responsive'>
			<table class='table' id='tbCategoria' style='text-align = center;'>
			<thead>
				<h1 >Lista de categoria</h1>";
			if(isset($subcategorias)){
				echo "<tr>
						<th width='25%' style='text-align: center;'>Nome</th>
                        <th width='25%' style='text-align: center;'>Icone</th>
                        <th width='25%' style='text-align: center;'>Categoria Associada</th>
						<th width='25%' style='text-align: center;'>Editar</th>
						<th width='25%' style='text-align: center;'>Apagar</th>
					</tr>
				<tbody>";
	
		foreach ($subcategorias as &$subcategoria) {
			echo "<tr name='resutaldo' id='status".$subcategoria->getPkId()."'>
				<td style='text-align: center;' name='nome'>".$subcategoria->getNome()."</td>
			 	<td style='text-align: center;' name='icone'><img src='../../".$subcategoria->getIcone()."' style='max-height: 50px; background-color: #BE392A;' alt='' class='img-thumbnail'/></td>
				<td style='text-align: center;' name='categoria'>".$subcategoria->getFkcategoria()."</td> 
				<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='subcat-view.php?cod=".$subcategoria->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>&nbsp;Editar</button></a></td>
			 	<td style='text-align: center;' name='status'  ><button type='button' onclick=\"removeCategoria(".$subcategoria->getPkId().",'../".$subcategoria->getIconeAbsoluto()."');\" class='btn btn-kionux'><i class='fa fa-remove'></i>&nbsp;Excluir</button></td>
			</tr>";
		}
	}else{
		echo "<h4>SEM RESULTADOS 😕</h4>";
	}

	}else{
		echo "<h3>SEM PERMISSÃO 😕</h3>";
	}

echo 	 "</tbody></table>
		</div>";
?>