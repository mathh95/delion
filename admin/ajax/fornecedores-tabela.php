<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlFornecedor.php";
include_once MODELPATH."/fornecedor.php";
protegePagina();

$controle=new controlerFornecedor($_SG['link']);
$fornecedores = $controle->selectAll();
	$permissao =  json_decode($usuarioPermissao->getPermissao());

			if(in_array('gerenciar_fornecededor', $permissao)){

			}else{
				echo "
				<div class='table-responsive'>
					<table class='table' id='tbFornecedor style='text-align = center;'>
					<thead>
					<h1 >Lista de Fornecedores</h1>
					<tr>
						<th width='20%' style='text-align: center;'>Nome</th>
						<th width='20%' style='text-align: center;'>Endereço</th>
						<th width='15%' style='text-align: center;'>CNPJ</th>
						<th width='15%' style='text-align: center;'>Telefone</th>
						<th width='15%' style='text-align: center;'>Tipo Fornecedor</th>
						<th width='20%' style='text-align: center;'>Dias p/ Pagamento</th>
						<th width='10%' style='text-align: center;'>Editar</th>
					</tr>
				<tbody>";
				
				if($fornecedores != -1){
					foreach ($fornecedores as &$fornecedor) {
						echo "<tr name='resutaldo' id='status".$fornecedor->getPkId()."'>
						<td style='text-align: center;' name='nome'>".$fornecedor->getNome()."</td>
						<td style='text-align: center;' name='endereco'>".$fornecedor->getTxtEndereco()."</td>
						<td style='text-align: center;' name='cnpj'>".$fornecedor->getCnpj()."</td>
						<td style='text-align: center;' name='telefone'>".$fornecedor->getFone()."</td>
						<td style='text-align: center;' name='tipofornecedor'>".$fornecedor->tipo_fornecedor."</td>
						<td style='text-align: center;' name='qtddias'>".$fornecedor->getQtdDias()."</td>
						<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='fornecedor-view.php?cod=".$fornecedor->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>&nbsp;Editar</button></a></td>
						</tr>";
						}
					}else{
						echo "<h3>SEM RESULTADOS</h3>";
					}
			}

		echo "</tbody></table>
		</div>";
?>