<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."home/controler/controlEndereco.php";
protegePagina();

$controle=new controlEndereco($_SG['link']);

if(isset($_POST['parametro'])){ 
	$parametro = $_POST['parametro'];
	$enderecos = $controle->selectAll($parametro);
}else{
	$parametro = '';
	$enderecos = $controle->selectAll($parametro);
}
if ($enderecos != -1){


	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 >Lista de Endereços</h1>
		<tr>
    		<th width='10%' style='text-align: center;'>Rua</th>
    		<th width='10%' style='text-align: center;'>Número</th>
    		<th width='10%' style='text-align: center;'>CEP</th>
            <th width='10%' style='text-align: center;'>Complemento</th>
			<th width='10%' style='text-align: center;'>Bairro</th>
			<th width='10%' style='text-align: center;'>Cliente</th>
			<th width='10%' style='text-align: center;'>Situação</th>
        </tr>
	<tbody>";
	foreach ($enderecos as &$endereco) {
			$mensagem='Cliente excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$endereco->getCodEndereco()."'>
				<td style='text-align: center;' name='rua'>".$endereco->getRua()."</td>
			 	<td style='text-align: center;' name='numero'>".$endereco->getNumero()."</td>
			 	<td style='text-align: center;' name='cep'>".$endereco->getCep()."</td>
				<td style='text-align: center;' name='complemetno'>".$endereco->getComplemento()."</td>
				<td style='text-align: center;' name='bairro'>".$endereco->getBairro()."</td>
				<td style='text-align: center;' name='cliente'>".$endereco->clienteNome."</td>
				<td style='text-align: center;' name='flag'>".$endereco->getDsFlagCliente()."</td>
			</tr>";
	}
echo "</tbody></table>";
}else{
	echo "<h1 style='texc-align:center;'>Sem resultados</h1>";
}
?>