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
			<h1 >Lista de tipos de avaliações:</h1>
            <tr>
                <th width='20%' style='text-align: center;'>Id</th>
	    		<th width='20%' style='text-align: center;'>Nome</th>
                <th width='20%' style='text-align: center;'>Ativo</th>
                <th width='20%' style='text-align: center;'>Editar</th>
	            <th width='20%' style='text-align: center;'>Apagar</th>
	        </tr>
        <tbody>";
    
    foreach($tipos as &$tipo){
        $mensagem = "Tipo de avaliação excluído com sucesso!";
        $titulo = "Excluir";
        echo "<tr name='resutaldo' id='status".$tipo->getCod_tipo_avaliacao()."'>
                <td style='text-align: center;' name='id'>".$tipo->getCod_tipo_avaliacao()."</td>
                <td style='text-align: center;' name='nome'>".$tipo->getNome()."</td>
                <td style='text-align: center;' name='ativo'>".(($tipo->getFlag_ativo() == 1) ? "sim" : "nao")."</td>
                <td style='text-align: center;' name='editar'><a href='tipoAvaliacao-view.php?cod=".$tipo->getCod_tipo_avaliacao()."' style='font-size: 20px;' href='#'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
                <td style='text-align: center;' name='status'  ><button type='button' onclick='removeTipoAvaliacao(".$tipo->getCod_tipo_avaliacao().")' class='btn btn-kionux'><i class='fa fa-remove'></i>Excluir</button></td>
                </tr>";
    }

}
echo "</tbody></table>";

?>