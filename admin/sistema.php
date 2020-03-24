<?php
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once "controler/seguranca.php";
	protegePagina();
 ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
	<meta http-equiv="refresh" >
	<title><?= EMPRESA ?></title>
	<?php
      	if ($_SESSION['usuarioNivel']==1) {
          	echo "<script language=\"javascript\">
             window.location.href = \"view/admin/default.php\"
          	</script>";
        }else{
          	echo "<script language=\"javascript\">
             window.location.href = \"view/admin/default.php\"
          	</script>";
        }
	 ?>
	</head>
	<body>
	</body>
</html>