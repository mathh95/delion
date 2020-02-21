<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";

include_once CONTROLLERPATH . "/controlSmsMensagem.php";
include_once MODELPATH . "/sms_mensagem.php";

protegePagina();

$controle = new controlerSmsMensagem($_SG['link']);

$envios = $controle->selectAll();

	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('enviar_sms', $permissao)){
	
		echo "<table class='table table-responsive' style='text-align = center;'>
		<thead>
			<h1 >Sms Enviados</h1>
			<tr>
	    		<th width='25%' style='text-align: center;'>Código</th>
	    		<th width='25%' style='text-align: center;'>Mensagem Enviada</th>
	            <th width='25%' style='text-align: center;'>Descrição</th>
	            <th width='25%' style='text-align: center;'>Data de Envio</th>
	        </tr>
		<tbody>";
	
		foreach ($envios as $key => $envio) {
			
			echo "<tr>
				<td style='text-align: center;'>".$envio->getCod_sms_mensagem()."</td>
			 	<td style='text-align: center;'>".$envio->getMsg()."</td>
			 	<td style='text-align: center;'>".$envio->getDescricao()."</td>
			 	<td style='text-align: center;'>".$envio->getData_envio()."</td>
			</tr>";
		}
	}

echo "</tbody></table>";

?>