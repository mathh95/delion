<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once HOMEPATH."home/controler/controlCliente.php";
include_once HOMEPATH."home/controler/controlEndereco.php";
include_once MODELPATH."/usuario.php";
protegePagina();

include_once HELPERPATH."/mask.php";
$mask = new Mask;

$controle = new controlEndereco($_SG['link']);
$controleUsuario = new controlerUsuario($_SG['link']);
$controleCliente = new controlCliente($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);


$cod = $_GET['cod'];

    $cliente = $controleCliente->select($cod,2);
	$enderecos = $controle->selectByCliente($cod,1);

    // var_dump($enderecos);
    // exit;


$permissao =  json_decode($usuarioPermissao->getPermissao());	
if ($enderecos == -1){
    echo "<div class='table-responsive'>
    <table class='table' id='tbUsuarios' style='text-align = center;'>
    <thead>
        <h1 >Endereços Cadastrados do Cliente</h1>
    <div class=\"pull-right\">
        <a href=\"clienteLista.php\" class=\"btn btn-kionux\"><i class=\"fa fa-arrow-left\"></i> Voltar</a>
    </div class=\"pull-right\">

	<h1>Cliente não possui endereços para alterar</h1>";
}else{


if(in_array('pedido', $permissao)){
	echo "
	<div class='table-responsive'>
		<table class='table' id='tbUsuarios' style='text-align = center;'>
		<thead>
			<h1 >Endereços Cadastrados do Cliente</h1>
		<div class=\"pull-right\">
			<a href=\"clienteLista.php\" class=\"btn btn-kionux\"><i class=\"fa fa-arrow-left\"></i> Voltar</a>
		</div class=\"pull-right\">
		<tr>
    		<th width='8%' style='text-align: center;'>CEP</th>
			<th width='10%' style='text-align: center;'>Rua</th>
			<th width='10%' style='text-align: center;'>Bairro</th>
			<th width='10%' style='text-align: center;'>Cidade</th>
			<th width='10%' style='text-align: center;'>Complemento</th>
            <th width='10%' style='text-align: center;'>Referência</th>
            <th width='12%' style='text-align: center;'>Editar</th>
        </tr>
    <tbody>";
		foreach ($enderecos as &$endereco) {
				echo "<tr name='resultado' id='status".$endereco->getPkId()."'>
					<td style='text-align: center;' name='cliente'>".$endereco->cep."</td>
					<td style='text-align: center;' name='dataPedido'>".$endereco->logradouro. ', ' .$endereco->getNumero()."</td>
					<td style='text-align: center;' name='horaPedido'>".$endereco->bairro."</td>
                    <td style='text-align: center;' name='horaImpressão'>".$endereco->cidade."</td>";
                    
                    if($endereco->getComplemento() == ""){
                        $complemento = "Sem Complemento";
                        echo "<td style='text-align: center;' name='horaImpressão'>".$complemento."</td>";
                    }else{
                        $complemento = $endereco->getComplemento();
                        echo "<td style='text-align: center;' name='horaImpressão'>".$complemento."</td>";
                    }

                    if($endereco->getReferencia() == ""){
                        $referencia = "Sem Referência";
                        echo "<td style='text-align: center;' name='horaImpressão'>".$referencia."</td>";
                    }else{
                        $referencia = $endereco->getReferencia();
                        echo "<td style='text-align: center;' name='horaImpressão'>".$referencia."</td>";
                    }
                    echo "<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='cliente-view-endereco.php?codEnd=".$endereco->getPkId()."&codCliente=".$cliente->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>&nbsp;Editar</button></a></td>";
					echo "</tr>";
				}
			}		
        }
	echo "</tbody></table>
		</div>";
?>