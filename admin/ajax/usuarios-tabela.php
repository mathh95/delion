<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once MODELPATH."/usuario.php";
protegePagina();

$controle=new controlerUsuario($_SG['link']);

$usuarios = $controleUsuario->selectAll();
// $usuarios = NULL;
$permissao =  json_decode($usuarioPermissao->getPermissao());
			if(in_array('usuario', $permissao)){
				echo "
				<div class='table-responsive'>
					<table class=' table w-auto' id='tbUsuarios' style='text-align: center;'>
					<thead>
					<h1>Lista de Usuários</h1>";
				if(isset($usuarios)){
					echo "<tr>
							<th width='20%' style='text-align: center;'>Nome</th>
							<th width='15%' style='text-align: center;'>Login</th>
							<th width='15%' style='text-align: center;'>Perfil</th>
							<th width='15%' style='text-align: center;'>Editar</th>
							<th width='15%' style='text-align: center;'>Apagar</th>
						</tr>
				</thead>
					<tbody>";
				
					foreach ($usuarios as &$usuario) {
					if(($usuario->getCod_usuario()!=$_SESSION['usuarioID']) && ($usuario->getFlag_bloqueado()==0)){
						echo "<tr name='resutaldo' id='status".$usuario->getCod_usuario()."'>
								<td style='text-align: center;' name='nome'>".$usuario->getNome()."</td>
								<td style='text-align: center;' name='login'>".$usuario->getLogin()."</td>
								<td style='text-align: center;' name='perfil'>".$usuario->getDsCod_perfil()."</td>
								<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='usuario-view.php?cod=".$usuario->getCod_usuario()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>&nbsp;Editar</button></a></td>
								<td style='text-align: center;' name='status'  ><button type='button' onclick=\"removeUsuario(".$usuario->getCod_usuario().");\" class='btn btn-kionux'><i class='fa fa-remove'></i>&nbsp;Excluir</button></td>
							</tr>";
						}
				}
			}else{
				echo "<h4>SEM RESULTADOS 😕</h4>";
			}
			echo "</tbody></table>
				</div>";

		}else{
			echo "<h2>SEM PERMISSÃO 😕</h2>";
		}
?>