<?php
  include("biblioteca/online.php");
  
  //grava no log que o usuário entrou na consulta
  $db->sql("insert into log_usuario (cod_usuario, ip,  hora_cad, data_cad, tipo_acao, acao) values (".$_SESSION["cod_usuario"]."  , '".$_SERVER["REMOTE_ADDR"]."' ,  '".date('H:i:s')."' , '".date('Y-m-d')."','Sair' ,'Saiu do Sistema') ");

  session_destroy();
  header("Location: /admin/include/index.php?msg=4");
  exit;
?>