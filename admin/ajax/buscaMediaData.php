<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once MODELPATH."/usuario.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlTipoAvaliacao.php";
include_once MODELPATH."/tipo_avaliacao.php";
$_SESSION['permissaoPagina']=0;
protegePagina();
$controle = new controlerTipoAvaliacao($_SG['link']);
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$tipos = $controle->select();
if((isset($_POST['acao']) && !empty($_POST['acao'])) && $_POST['acao'] == 1){
    $acao = $_POST['acao'];
    $data = $_POST['data'];
}elseif((isset($_POST['acao']) && !empty($_POST['acao'])) && $_POST['acao'] == 2){
    $acao = $_POST['acao'];
    $data = $_POST['mes'];
}

$permissao =  json_decode($usuarioPermissao->getPermissao());
if(in_array('avaliacao', $permissao)){

    echo "<table class='table table-responsive' id='tbCardapio' style='text-align = center;'>
		<thead>
			<h1 >Lista de tipos de avaliações filtrados pela data:</h1>
            <tr>
                <th width='20%' style='text-align: center;'>Id</th>
	    		<th width='20%' style='text-align: center;'>Nome</th>
                <th width='20%' style='text-align: center;'>Ativo</th>
                <th width='20%' style='text-align: center;'>Média</th>
	        </tr>
        <tbody>";
    
    foreach($tipos as &$tipo){
        if($acao == 1){
            $media = $controle->mediaPorData($data, ($tipo->getCod_tipo_avaliacao()));
        }elseif($acao == 2){
            $media = $controle->mediaPorMes($data, ($tipo->getCod_tipo_avaliacao()));
        }
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
echo "</tbody></table>";

?>