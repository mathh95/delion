<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlerGerenciaSite.php";
include_once MODELPATH."/gerencia_site.php";
protegePagina();

$controle=new controlerGerenciarSite($_SG['link']);
$configs = $controle->selectAll();
	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('gerenciar_site', $permissao)){ 
	
		echo "<table class='table table-responsive' id='tbImagem' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de Configurações</h1>
			<tr>
	    		<th width='20%' style='text-align: center;'>Imagem</th>
	    		<th width='15%' style='text-align: center;'>Nome Configuração</th>
	    		<th width='10%' style='text-align: center;'>Cor Primária</th>
				<th width='10%' style='text-align: center;'>Cor Secundária</th>
				<th width='15%' style='text-align: center;'>Status</th>
                <th width='15%' style='text-align: center;'>Ativar/Desativar</th>
				<th width='15%' style='text-align: center;'>Editar</th>
				<th width='15%' style='text-align: center;'>Excluir</th>
	        </tr>
		<tbody>";
	
		foreach ($configs as &$config) {

			if($config->getFlag_ativo() == 1){
				$status = "Configuracão Ativa";
			}else{
				$status = "Configuração Desativada";
			}

			echo "<tr name='resultado' id='status".$config->getPkId()."'>
			 	<td style='text-align: center;' name='imagem'><img src='../../".$config->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
				 <td style='text-align: center;' name='nome'>".$config->getNome()."</td>
				 
				<td style='text-align: center;' name='corPrimaria'>
					<input type='color' id='corPrimaria' name='corPrimaria' value=".$config->getCorPrimaria()." disabled>
				</td>
				
				<td style='text-align: center;' name='corSecundaria'>
					<input type='color' id='corSegundaria' name='corSegundaria' value=".$config->getCorSecundaria()." disabled>
				</td>
				
				<td style='text-align: center;' name='corSecundaria'>".$status."</td>";
				if($config->getFlag_ativo() == 1){
					echo "<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='../../ajax/desativa-config-site.php?cod=".$config->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Desativar</button></a></td>";
				}else{
					echo "<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='../../ajax/ativar-config-site.php?cod=".$config->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Ativar</button></a></td>";
				}
				
				echo "<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='gerenciarSite-view.php?cod=".$config->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>&nbsp;Editar</button></a></td>
				<td style='text-align: center;' name='status'  ><button type='button' onclick=\"removeConfig(".$config->getPkId().");\" class='btn btn-kionux'><i class='fa fa-remove'></i> Excluir</button></td>
			</tr>";
		}
	}else{

	}

echo "</tbody></table>";
?>