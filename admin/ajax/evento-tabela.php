<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlEvento.php";
include_once MODELPATH."/evento.php";
protegePagina();
setlocale (LC_ALL, 'ptb');

$controle=new controlerEvento($_SG['link']);
$eventos = $controle->selectAll();
$permissao =  json_decode($usuarioPermissao->getPermissao());

	if(in_array('evento', $permissao)){ 
		echo "<table class='table table-responsive' id='tbEvento' style='text-align = center;'>
		<thead>
			<h1 >Lista de evento</h1>";
		
		if(isset($eventos)){
			echo 	"<tr>
						<th width='20%' style='text-align: center;'>Foto</th>
						<th width='20%' style='text-align: center;'>Nome do evento</th>
						<th width='20%' style='text-align: center;'>Data</th>
						<th width='20%' style='text-align: center;'>Editar</th>
						<th width='20%' style='text-align: center;'>Apagar</th>
					</tr>
				<tbody>";
				foreach ($eventos as &$evento) {
					echo "<tr name='resutaldo' id='status".$evento->getCod_evento()."'>
						 <td style='text-align: center;' name='evento'><img src='../../".$evento->getFoto()."' style='max-height: 175px' alt='' class='img-thumbnail'/></td>
						 <td style='text-align: center;' name='nome'>".$evento->getNome()."</td>";
					if ($evento->getFlag_antigo() == 1) {
						echo "<td style='text-align: center;' name='data'>".ucfirst(strftime('%b/%Y',strtotime($evento->getData())))."</td>";
					}else{
						echo "<td style='text-align: center;' name='data'></td>";
					}
					echo"<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='evento-view.php?cod=".$evento->getCod_evento()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
						 <td style='text-align: center;' name='status'  ><button type='button' onclick=\"removeEvento(".$evento->getCod_evento().",'../".$evento->getFotoAbsoluto()."');\" class='btn btn-kionux'><i class='fa fa-remove'></i>Excluir</button></td>
					</tr>";
				}
		}
		else{
			echo "<h4>SEM RESULTADOS 😕</h4>";
		}
	
	}else{
		echo "<h3>SEM PERMISSÃO 😕</h3>";
	}

echo "</tbody></table>";

?>