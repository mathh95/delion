<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlComposicao.php";
include_once MODELPATH."/composicao.php";
include_once CONTROLLERPATH."/controlUsuario.php";
protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle=new controlerComposicao($_SG['link']);

$cod = $_GET['cod'];


$ingredientes = $controle->selectByFkComposicao($cod);

$permissao =  json_decode($usuarioPermissao->getPermissao());	
if ($ingredientes == -1){
	echo "<h1> SEM RESULTADOS</h1>";
}else{

if(in_array('gerenciar_composicao', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 >Dados do Pedido</h1>
		<div class=\"pull-right\">
			<a href=\"composicaoLista.php\" class=\"btn btn-kionux\"><i class=\"fa fa-arrow-left\"></i> Voltar</a>
		</div class=\"pull-right\">
		<tr>
    		<th width='8%' style='text-align: center;'>Nome do Ingrediente</th>
			<th width='10%' style='text-align: center;'>Quantidade Utilizada</th>
			<th width='10%' style='text-align: center;'>Valor Calculado</th>
        </tr>
    <tbody>";
    
	// var_dump($ingredientes);
	// exit;
            
        foreach($ingredientes as $key=>$ingrediente){

			$cod_ingrediente = $ingredientes[$key]["coig_pk_id"];
			$nome_ingrediente = $ingredientes[$key]["igr_nome"];
			$qtd_utilizada = $ingredientes[$key]["coig_qtde_utilizada"];
			$valorCalculado = $ingredientes[$key]["coig_valor_calculado"];
			$unidade = $ingredientes[$key]["igr_unidade"];


            echo "<tr name='resultado' id='cod".$cod_ingrediente."'>
                <td style='text-align: center;' name='nomeIngrediente'>".$nome_ingrediente."</td>
                <td style='text-align: center;' name='qtdUtilizada'>".($qtd_utilizada+0)." ".$unidade."</td>
                <td style='text-align: center;' name='valorCalc'>R$ ".$valorCalculado."</td>";
            }	

        }

		}
	echo "</tbody></table>";
?>