<?
 include("../biblioteca/online.php");
 
                                                                  
   $db->sql("delete  FROM foto where cod_foto = '$_GET[cod_foto]' ");
   
  /*
  //executa query
  $db->sql("SELECT * FROM foto where codigo = $_GET[cod_produto] and tabela = 'produto' order by cod_foto ");
  
  echo "SELECT * FROM foto where codigo = $_GET[cod_produto] and tabela = 'produto' order by cod_foto ";
  
  $i = 0;      
//Verifica ate aonde encontra os dados
  while ($valores = $db->fetch_array()) { 
		echo "<img src=\"/$valores[foto_pq]\" style=\"margin: 5px; opacity: 1;\" onclick=\"deletar_foto($_GET[cod_foto], $valores[cod_foto])\">";
		
		$i++;
		if ($i == 6) {
			echo "<br>";
			$i = 0;
		}
		
  }								

	*/	  
?>
