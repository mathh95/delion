<?php
include_once "seguranca.php";

function register($stmte,$cod_app,$texto){
    try{
        $data=date('Y-m-d');
        $hora=date('H-i-s');
        $cod_usuario = $_SESSION['usuarioID'];
        $stmte="INSERT INTO log(cod_app, cod_usuario, texto, data, hora) VALUES ('$cod_app','$cod_usuario','$texto','$data','$hora')";
        $stmte->bindParam(":cod_app", $cod_app , PDO::PARAM_INT);
        $stmte->bindParam(":cod_usuario", $_SESSION['usuarioID'] , PDO::PARAM_INT);
        $stmte->bindParam(":texto", $action , PDO::PARAM_INT);
        $stmte->bindParam(":data", $data , PDO::PARAM_STR);
        $stmte->bindParam(":hora", $hora , PDO::PARAM_STR);
        $executa = $stmte->execute();
        if($executa){
            return 1;
        }
        else{
            return -1;
       }
   }
   catch(PDOException $e){
      echo $e->getMessage();
      return -1;
   }
}
?>