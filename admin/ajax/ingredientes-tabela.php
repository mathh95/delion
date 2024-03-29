<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlIngrediente.php";
include_once MODELPATH."/ingrediente.php";
protegePagina();

$controle = new controlerIngrediente($_SG['link']);
$itens = $controle->selectAll();
$permissao =  json_decode($usuarioPermissao->getPermissao());
if(in_array('gerenciar_composicao', $permissao)){

    echo "
    <div class='table-responsive'>
        <table class='table' id='tbCardapio' style='text-align = center;'>
		<thead>
			<h1>Ingredientes Cadastrados</h1>
            <tr>
                <th width='12%' style='text-align: center;'>#Id</th>
	    		<th width='20%' style='text-align: center;'>Nome</th>
                <th width='20%' style='text-align: center;'>Unidade de Medida</th>
                <th width='15%' style='text-align: center;'>Valor</th>
                <th width='15%' style='text-align: center;'>Editar</th>
	            <th width='15%' style='text-align: center;'>Apagar</th>
	        </tr>
        <tbody>";
    
    foreach($itens as &$item){
        $mensagem = "Tipo de avaliação excluído com sucesso!";
        $titulo = "Excluir";
        echo "<tr name='resultado' id='status".$item->getPkId()."'>
                <td style='text-align: center;' name='id'>".$item->getPkId()."</td>
                <td style='text-align: center;' name='nome'>".$item->getNome()."</td>
                <td style='text-align: center;' name='unidade'>".$item->getUnidade()."</td>
                <td style='text-align: center;' name='valor'>R$ ".$item->getValor()."</td>
                <td style='text-align: center;' name='editar'><a href='ingrediente-view.php?cod=".$item->getPkId()."' style='font-size: 20px;' href='#'>
                    <button class='btn btn-kionux'><i class='fa fa-edit'></i> Editar</button></a>
                </td>
                <td style='text-align: center;' name='status'>
                    <button type='button' onclick='removeIngrediente(".$item->getPkId().")' class='btn btn-kionux'><i class='fa fa-remove'></i> Excluir</button>
                    </td>
                </tr>";
    }

}
echo "</tbody></table>
    </div>";

?>