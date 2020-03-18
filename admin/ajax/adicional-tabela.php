<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once CONTROLLERPATH."/controlAdicional.php";
include_once MODELPATH."/usuario.php";
protegePagina();

$controle=new controlerAdicional($_SG['link']);
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$adicionais = $controle->selectAll();

$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('adicional', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 >Lista de Adicionais</h1>";
		
		if(isset($adicionais)){
			echo "<tr>
					<th width='20%' style='text-align: center;'>Nome</th>
					<th width='15%' style='text-align: center;'>Preço</th>
					<th width='15%' style='text-align: center;'>Ativo</th>
				</tr>
			<tbody>";
			foreach ($adicionais as &$adicional) {
			if($adicional->getFlag_ativo() == 1){
				$flag = "Ativo";
			}else{
				$flag = "Inativo";
			}
				echo "<tr name='resultado' id='status".$adicional->getPkId()."'>
					<td style='text-align: center;' name='nome'>".$adicional->getNome()."</td>
					<td style='text-align: center;' name='preco'>".$adicional->getPreco()."</td>
				<td style='text-align: center;' name='flag_ativo'>".$flag."</td>
					<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='adicional-view.php?cod=".$adicional->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>&nbsp;&nbsp;Editar</button></a></td>
					<td style='text-align: center;' name='status'><a href='../../ajax/excluir-adicional.php?cod=".$adicional->getPkId()."'><button type='button' class='btn btn-kionux'><i class='fa fa-remove'></i>&nbsp;&nbsp;Excluir</button></a></td>
				</tr>";
			}
		}else{
			echo "<h4>SEM RESULTADOS 😕</h4>";
		}
}else{
	echo "<h3>SEM PERMISSÃO 😕</h3>";
}
echo "</tbody></table>";
?>