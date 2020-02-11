<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlTipoAvaliacao.php";
include_once MODELPATH."/tipo_avaliacao.php";
protegePagina();

$controle = new controlerItemComposicao($_SG['link']);
$itens = $controle->select();
$permissao =  json_decode($usuarioPermissao->getPermissao());
if(in_array('avaliacao', $permissao)){

    echo "<table class='table table-responsive' id='tbCardapio' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de itens de composição:</h1>
            <tr>
                <th width='20%' style='text-align: center;'>Id</th>
	    		<th width='20%' style='text-align: center;'>Nome</th>
                <th width='20%' style='text-align: center;'>Unid. de Medida</th>
                <th width='20%' style='text-align: center;'>Quantidade</th>
                <th width='20%' style='text-align: center;'>Valor</th>
                <th width='20%' style='text-align: center;'>Editar</th>
	            <th width='20%' style='text-align: center;'>Apagar</th>
	        </tr>
        <tbody>";
    
    foreach($itens as &$item){
        $mensagem = "Tipo de avaliação excluído com sucesso!";
        $titulo = "Excluir";
        echo "<tr name='resultado' id='status".$item->getCod_itemComposicao()."'>
                <td style='text-align: center;' name='id'>".$item->getCod_itemComposicao()."</td>
                <td style='text-align: center;' name='nome'>".$item->getNome()."</td>
                <td style='text-align: center;' name='medida'>".$item->getMedida()."</td>
                <td style='text-align: center;' name='medida'>".$item->getQuantidade()."</td>
                <td style='text-align: center;' name='medida'>".$item->getValor()."</td>
                <td style='text-align: center;' name='editar'><a href='itemComposicao-view.php?cod=".$item->getCod_itemComposicao()."' style='font-size: 20px;' href='#'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
                <td style='text-align: center;' name='status'  ><button type='button' onclick='removeItemComposicao(".$item->getCod_itemComposicao().")' class='btn btn-kionux'><i class='fa fa-remove'></i>Excluir</button></td>
                </tr>";
    }

}
echo "</tbody></table>";

?>