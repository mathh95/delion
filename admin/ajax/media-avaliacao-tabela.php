<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlTipoAvaliacao.php";
include_once MODELPATH."/tipo_avaliacao.php";
protegePagina();
$controle = new controlerTipoAvaliacao($_SG['link']);
$tipos = $controle->select();

$permissao =  json_decode($usuarioPermissao->getPermissao());
if(in_array('avaliacao', $permissao)){

    echo "<table class='table table-responsive' id='tbCardapio' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de tipos de avaliações:</h1>
            <tr>
                <th width='20%' style='text-align: center;'>Id</th>
	    		<th width='20%' style='text-align: center;'>Nome</th>
                <th width='20%' style='text-align: center;'>Ativo</th>
                <th width='20%' style='text-align: center;'>Média</th>
	        </tr>
        <tbody>";
    
    foreach($tipos as &$tipo){
        $media = $controle->mediaPorId($tipo->getCod_tipo_avaliacao());
        $mensagem = "Tipo de avaliação excluído com sucesso!";
        $titulo = "Excluir";
        echo "<tr name='resutaldo' id='status".$tipo->getCod_tipo_avaliacao()."'>
                <td style='text-align: center;' name='id'>".$tipo->getCod_tipo_avaliacao()."</td>
                <td style='text-align: center;' name='nome'>".$tipo->getNome()."</td>
                <td style='text-align: center;' name='ativo'>".(($tipo->getFlag_ativo() == 1) ? "sim" : "nao")."</td>
                <td style='text-align: center;' name='media'>".sprintf("%2.2f", $media['media'])."</td>
            </tr>";
    }

}
echo "</tbody></table>
    <label>Escolha uma data para saber as médias dela:</label><br>
    <input id='data' type='date'>
    <button id='buscaMediaData'>Buscar</button><br>
    <label>Insira o mês(formato numérico) para ver as médias das avaliações daquele período:</label><br>
    <input id='mes' type='number' min='1' max='12'>
    <button id='buscaMediaMes'>Buscar</button>
    <div id='mediaData' class='container'></div>";

?>