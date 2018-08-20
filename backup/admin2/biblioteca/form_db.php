<?
/** 
* Autor : Alexandre martins da silva 
* Data  : 15/10/2004 
* Desc  : Objeto para cadastrar o formul�rio... 
*/ 

class form_db {
	////////////////Atributos da class////////////////// 
	public $db;		//vari�vel que guarda o objeto de conex�o com mysql
    public $form; 		//array com todos os campos e valores do formul�rio
	public $form_db; 	//array com os campos da tabela a ser utilizada
	public $tabela;	//nome da tabela a ser manipulada
	public $session;	//array com todos os campos da sessao
	public $tabela_log;	//nome da tabela de log a ser manipulada
	public $log_db;	//campos da tabela de log a ser utilizada
	public $tela;	//codigo da tela a ser usada no log 
	
	////////////////Metodos da classe/////////////// 
    // Metodo Contrutor
	public function __construct($db, $form, $tabela, $tela, $session = '', $tabela_log = '')
	{	
		$this->db = $db;
		$this->form = $form;
		$this->tabela = $tabela;
		$this->tela = $tela;
		if ($this->tabela)
			$this->form_db = $this->db->get_fields($this->tabela);
		$this->session = $session;
		$this->tabela_log = $tabela_log;
		if ($tabela_log != '') {
			$this->log_db = $this->db->get_fields($this->tabela_log);	
		}	
	}
	
	// Metodo para redimensionar fotos
	public function resize_image($src_file, $dest_file_med, $new_width_med, $method)
	{
		$imginfo = getimagesize($src_file);
		if ($imginfo == null)
			return false;
	   // Altura/Comprimento
		$srcWidth = $imginfo[0];
		$srcHeight = $imginfo[1];
		
		if ($srcHeight > $srcWidth)
		 {
		  $new_heigth_med = 180;
		  $ratio = $srcHeight / $new_heigth_med;
		  $ratio = max($ratio, 1.0);
		  $destWidth_med = (int)($srcWidth / $ratio);
		  $destHeight_med = (int)($srcHeight / $ratio);
		} 
		else
		   {
			$ratio = $srcWidth / $new_width_med;
		   $ratio = max($ratio, 1.0);
		   $destWidth_med = (int)($srcWidth / $ratio);
		   $destHeight_med = (int)($srcHeight / $ratio);
		  }
	
	 // Metodo de criacao do thumbmail
		switch ($method) {
		case "im" :
			$output = array();
			$cmd = "/usr/bin/convert -quality 90 -antialias -geometry {$destWidth_med}x{$destHeight_med} $src_file $dest_file_med";
			exec ($cmd, $output, $retval);
			if ($retval) {
			   $ERROR = "Error executing ImageMagick - Return value: $retval";
			   @unlink($src_file);
			   return false;
			}
			break;
		}
		return true;
	}
	
	//m�todo para postagem de arquivos
	public function postar_arquivo_resize($array_arquivo,$campo_imagem, $campo_nome, $largura, $extencoes, $diretorio, $codigo = -1)
	{
		//trata a extens�o do arquivo
		$nomefile = strtolower($array_arquivo[$campo_imagem]['name']);
		$ext = strrchr($nomefile,'.');
		
		if (in_array($ext,$extencoes)) {
		    
			$nomearquivo = uniqid(md5(time()));
			if ($codigo > 0 ){
			  $caminho = $this->cria_diretorio(ROOTPATH .$diretorio,$codigo);
			  //cria o caminho relativo
			  $caminhobd = $diretorio . '/' . $codigo . '/thumb_' . $nomearquivo. $ext;
			} else {
			   $caminho = ROOTPATH .$diretorio . '/';
			   //cria o caminho relativo
			   $caminhobd = $diretorio . '/thumb_' . $nomearquivo. $ext;
			}
			
			$caminhonovo = $caminho . $nomearquivo. $ext;
			$caminhoresize = $caminho . 'thumb_' . $nomearquivo. $ext;
			
			$metodo = "im";
			
			if ($array_arquivo[$campo_imagem]['tmp_name'] != '') {
			
				if (!$this->resize_image($array_arquivo[$campo_imagem]['tmp_name'], $caminhoresize, $largura, $metodo)){
					return 0;
				}else {			
					//adiciona o campo no array do formulario
					$this->form["$campo_imagem"] = $caminhobd;
					$this->form["$campo_nome"] = $array_arquivo[$campo_imagem]['name'];
					return 1;
				}
				
				@unlink($array_arquivo[$campo_imagem]['tmp_name']); 
			}				
		
		} else {
			return 0;
			echo "N�o � um arquivo v�lido!";
		}
	
	}
	
	//Cria um diretorio randomico, se ele ainda nao existir
	public function cria_diretorio($caminhonovo, $codigo){
	  //$first_user_cat = 10000;
	  $valor = (int)$codigo;
	  //$valor = $first_user_cat + $valor;
	  $caminhonovo = $caminhonovo . "/" . $valor . "/";
	  echo $caminhonovo;
	  if(!is_dir($caminhonovo)) {
		  mkdir ($caminhonovo, 0777);
	  }
	  clearstatcache();  
	  return($caminhonovo);
	}
	
	//m�todo para postagem de arquivos
	public function postar_arquivo($array_arquivo,$campo_imagem, $campo_nome, $extencoes, $diretorio, $diretorio_bd, $codigo)
	{
		//trata a extens�o do arquivo
		$nomefile = strtolower($array_arquivo[$campo_imagem]['name']);
		$ext = strrchr($nomefile,'.');
		
		if (in_array($ext,$extencoes)) {
		
			$nomearquivo = uniqid(md5(time()));
			$caminhonovo = $this->cria_diretorio($diretorio,$codigo);
			$caminhonovo = $caminhonovo . $nomearquivo. $ext;
			
			//cria o caminho relativo
			$caminhobd = $diretorio_bd . '/' . $codigo . '/' . $nomearquivo. $ext;
			
			copy($array_arquivo[$campo_imagem]['tmp_name'], $caminhonovo);
			
			@unlink($array_arquivo[$campo_imagem]['tmp_name']); 			
				
			//adiciona o campo no array do formulario
			$this->form["$campo_imagem"] = $caminhobd;
			$this->form["$campo_nome"] = $array_arquivo[$campo_imagem]['name'];
			return 1;	
		
		} else {
			return 0;
			echo "N�o � um arquivo v�lido!";
		}
	
	}
	
	// M�todo inserir no banco
	function insere()
	{
		if ($this->monta_sql_insert($sql)) {
		   
		   $sql_log = "SELECT * FROM tela where cod_tela = " .  $this->tela . ' limit 0,1';	  
		
		   $res = $this->db->sql($sql_log);
			
		   $valores = $this->db->fetch_array();
		   
		   $this->cria_log($sql, '', 0 , 'Inser��o', "O $valores[nome] foi inserido"); 
		   		   
		   if ($this->db->sql($sql)) {		   
			   
				return 1;
		   } else {
				return 0;
		   }
		   
		 }else {
		 	return 0;
		 }			
	}
	// M�todo para retirar caracteres especiais
	function trata_char( $string )
   {
       $string = str_replace ("&", "&amp;" ,$string);
       $string = str_replace ( "'", "&#039;", $string );
       $string = str_replace ( "\"", "&quot;", $string );
       $string = str_replace ( "<", "&lt;", $string );
       $string = str_replace ( ">", "&gt;", $string );
       
       return $string;
   }
	
	
	// M�todo que monta a sql pegando os campos da tabela com os campos no formul�rio
	function monta_sql_insert(&$sql)
	{
		$sql = 	"insert into " .$this->tabela ;
		
		$campos = " (";
		$valores = " values (";		
		
		$form_campos = array_keys($this->form); //extrai o nome dos campos do formulario
		
		if (count($this->form) > 0 ) {
		
		    $count_campos = 0; //conta quantos campos vao bater no banco
					
			//percorre o vetor de variaveis do formulatorio para bater com os campos da tabela
			for ($i = 0; $i < count($this->form); $i++) {
			
				//se o campo do formulatorio existe na tabela entao cadastra o campo
				if (array_key_exists( $form_campos[$i], $this->form_db) ) {
				
					$count_campos++; //conta quantos campos vao bater no banco
					
					if ($count_campos == 1 ) {
						$campos = $campos . $form_campos[$i] ;
					    $valores = $valores . "'" . $this->trata_char(addslashes($this->form[$form_campos[$i]])) . "'";
					} else {
					    $campos = $campos . "," . $form_campos[$i] ;
					    $valores = $valores . "," . "'" .  $this->trata_char(addslashes($this->form[$form_campos[$i]])) . "'";
					}
					
					
				}
						
			}
			
			if ($count_campos > 0 ) {
			
				$campos = $campos . ") ";
				$valores = $valores . ") ";
				
				$sql = $sql . $campos . $valores;
				return 1;
			}else {
				return 0;
			}

		
		} else {
			return 0;
		}	
	}
	
	// M�todo atualizar no banco
	function atualiza($campo_codigo, $acao = '', $descricao = '')
	{
		if ($this->monta_sql_update($sql, $campo_codigo)) {
		   		   
		   //echo $sql;
		   //exit;
		   if ($this->db->sql($sql)) {
		   
		   		$sql_log = "SELECT * FROM tela where cod_tela = " .  $this->tela . ' limit 0,1';	  
		
				$res = $this->db->sql($sql_log);
				
				$valores = $this->db->fetch_array();
				
				if ($acao == '') {
				  $acao = 'Atualiza��o';
				}
				
				if ($descricao == '') {
				  $descricao = "O $valores[nome] foi alterado";
				}
				
				$this->cria_log($sql, $campo_codigo, $this->form[$campo_codigo], $acao, $descricao );
								
				return 1;
		   } else {
				return 0;
		   }
		   
		 }else {
		 	return 0;
		 }			
	}
	
	// M�todo que monta a sql pegando os campos da tabela com os campos no formul�rio
	function monta_sql_update(&$sql, $campo_codigo)
	{
		//print_r($this->form_db);
		//exit;
		
		//verifica se o campo passado existe no array de campos
		if (array_key_exists( $campo_codigo, $this->form)) {
		
			$sql = 	"update " .$this->tabela . " set " ;
			
			$campos = " ";
			
			$form_campos = array_keys($this->form); //extrai o nome dos campos do formulario
			
			if (count($this->form) > 0 ) {
			
				$count_campos = 0; //conta quantos campos vao bater no banco
							
				//percorre o vetor de variaveis do formulatorio para bater com os campos da tabela
				for ($i = 0; $i < count($this->form); $i++) {
				
					//se o campo do formulatorio existe na tabela entao cadastra o campo
					if (array_key_exists( $form_campos[$i], $this->form_db) ) {
						
						
						$count_campos++; //conta quantos campos vao bater no banco
						
						if ($count_campos == 1 ) {
							$campos = $campos . $form_campos[$i] . " = " . "'" .  $this->trata_char(addslashes($this->form[$form_campos[$i]])) . "'";
						} else {
							$campos = $campos . ", ". $form_campos[$i] . " = " . "'" .  $this->trata_char(addslashes($this->form[$form_campos[$i]])) . "'";
						}
					}
							
				}
				
				if ($count_campos > 0 ) {
					
					$sql = $sql . $campos . " where " . $campo_codigo . " = " . $this->form[$campo_codigo];
					
					
					
					return 1;
				}else {
					
					return 0;
				}
	
			
			} else {
				echo "nenhum campo existe no banco de dados";
				return 0;
			}
		
		} else 	{
			echo "erro na verifica��o do c�digo: $campo_codigo";
			return 0;
		}
	}
	
	// M�todo atualizar no banco
	function deleta($campo_codigo)
	{
		if ($this->monta_sql_delete($sql, $campo_codigo)) {
			
			$sql_log = "SELECT * FROM tela where cod_tela = " .  $this->tela . ' limit 0,1';	  
		
			$res = $this->db->sql($sql_log);
			
			$valores = $this->db->fetch_array();
			 
			$this->cria_log($sql, $campo_codigo, $this->form[$campo_codigo], 'Dele��o', "O $valores[nome] foi deletado");   
		   
		   
		   if ($this->db->sql($sql)) {	
		   				
				return 1;
		   } else {
				return 0;
		   }
		   
		 }else {
		 	return 0;
		 }			
	}
	
	// M�todo que monta a sql pegando os campos da tabela com os campos no formul�rio
	function monta_sql_delete(&$sql, $campo_codigo)
	{
		//verifica se o campo passado existe no array de campos
		if (array_key_exists( $campo_codigo, $this->form)) {
		
			$sql = 	"delete from " .$this->tabela . " where " . $campo_codigo . " = " . $this->form[$campo_codigo];
			
			return 1;
		
		} else 	{
		    echo "erro na verifica��o do c�digo: $campo_codigo";
			return 0;
		}
	}
	
	// M�todo que cria o log
	function cria_log($sql,$campo_codigo, $codigo, $tipo, $descricao)
	{
		
		if ($this->tabela_log != '' ) {
		
			 
			
			//coloca os campos na sessao pra criar o log
			$this->session['data_cad'] = date('Y-m-d');
			$this->session['hora_cad'] = date('H:i:s');
			$this->session['tabela_atualizada'] = $this->tabela;
			$this->session['tela'] = $this->tela;
			$this->session['cod_tabela_atualizada'] = $codigo;
			$this->session['tipo_acao'] = $tipo;
			$this->session['consulta'] = $sql;
			$this->session['acao'] = $descricao;
			
			
			
			if ($codigo > 0) {
				
				$this->session['dados_originais'] = $this->monta_dados_originais($campo_codigo);
			}	
			
						
			
			if ($this->monta_sql_log($sql_log)) {
			
			   			
			   if ($this->db->sql($sql_log)) {
					return 1;
			   } else {
					return 0;
			   }
			   
			 }else {
				return 0;
			 }			
		}
	}
	
	
	// M�todo que monta a sql pegando os campos da tabela com os campos no formul�rio
	function monta_dados_originais($campo_codigo)
	{
		
		$sql = 	"select * from " .$this->tabela . " where " . $campo_codigo . " = " . $this->form[$campo_codigo];
		
		$res = $this->db->sql($sql);
		
		$valores = $this->db->fetch_array();
		
			
			$campos = " ";
			
			$select_campos = array_keys($valores); //extrai o nome dos campos do formulario
			
			if (count($valores) > 0 ) {
			
				$count_campos = 0; //conta quantos campos vao bater no banco
				
				
							
				//percorre o vetor de variaveis do formulatorio para bater com os campos da tabela
				for ($i = 0; $i < count($valores); $i++) {
									
						if (!is_int($select_campos[$i])) {
						
							$count_campos++; //conta quantos campos vao bater no banco
							
							if ($count_campos == 1 ) {
								$campos = $campos . $select_campos[$i] . " = " . "'" .  addslashes($valores[$select_campos[$i]]) . "'";
							} else {
								$campos = $campos . ", ". $select_campos[$i] . " = " . "'" .  addslashes($valores[$select_campos[$i]]) . "'";
							}
						}
					
							
				}
				
				return $campos;
			
			} else {
				echo "nenhum campo existe no banco de dados";
				return 0;
			}
	}
	
	
	// M�todo que monta a sql pegando os campos da tabela com os campos da sessao
	function monta_sql_log(&$sql)
	{
		$sql = 	"insert into " .$this->tabela_log ;
		
		$campos = " (";
		$valores = " values (";		
		
		$session_campos = array_keys($this->session); //extrai o nome dos campos da session	
		
		if (count($this->session) > 0 ) {
		
		    $count_campos = 0; //conta quantos campos vao bater no banco
			
			
					
			//percorre o vetor de variaveis do formulatorio para bater com os campos da tabela
			for ($i = 0; $i < count($this->session); $i++) {
			
				//print_r($this->session);
				//echo "<br><br>";
				//print_r($this->log_db);
				//exit;
				
				//se o campo do formulatorio existe na tabela entao cadastra o campo
				if (array_key_exists( $session_campos[$i], $this->log_db) ) {
				
				
					$count_campos++; //conta quantos campos vao bater no banco
					
					if ($count_campos == 1 ) {
						$campos = $campos . $session_campos[$i] ;
					    $valores = $valores . "'" . addslashes($this->session[$session_campos[$i]]) . "'";
					} else {
					    $campos = $campos . "," . $session_campos[$i] ;
					    $valores = $valores . "," . "'" .  addslashes($this->session[$session_campos[$i]]) . "'";
					}
					
					
				}
						
			}
			
			if ($count_campos > 0 ) {
			
				$campos = $campos . ") ";
				$valores = $valores . ") ";
				
				$sql = $sql . $campos . $valores;
				
				//echo $sql;
				//exit;
				
				return 1;
			}else {
				return 0;
			}

		
		} else {
			return 0;
		}	
	}
	
}

/////////////////FIM DA CLASSE//////////////// 

class paginacao extends form_db{
	////////////////Atributos da class//////////////////
	public $maxpag; 	//numero m�ximo de resultatos por p�gina
    public $maxlnk;	    //numero m�ximo de links por p�gina
	public $id;		//numero da p�gina passada por par�metro
	//public $db;		//classe para conex�o no banco
	public $sql;		//sql para consulta da paginacao
	public $totreg;	//total de registros
	public $parcreg;	//parcial de registros
	
	public $temp;		//esse atributo pega o valor temporario do id
	public $param;		//pega o calculo da pagina atual
	
	public $n_paginas;	//numero de p�ginas
	public $pg_Prior;	//pagina anterior
	public $pg_proxima;//proxima pagina
	public $pg_atual;	//pagina atual
	public $reg_inicial; //registro inicial
	
	////////////////Metodos da classe/////////////// 
    // Metodo Contrutor
	public function __construct($db, $sql, $maxpag, $maxlnk, $id, $tela, $session) 
	{
		$this->db = $db;
		$this->maxpag = $maxpag;
		$this->maxlnk = $maxlnk;
		$this->id = $id;
		$this->sql = $sql;
		$this->tela = $tela;
		$this->session = $session;
		
		$this->paginacao_log();
		
		$this->processa_parametro();
		$this->filtra_banco();
		$this->calcula_paginas();
	}
	
	// M�todo processa parametro
	public function paginacao_log()
	{
		$sql = "SELECT * FROM tela where cod_tela = " .  $this->tela . ' limit 0,1';	  
		
		$res = $this->db->sql($sql);
			
		$valores = mysql_fetch_array($res);
		
				
		parent::__construct($this->db, '', '', $this->tela, $this->session, 'log_usuario');
		
		
		 
		$this->cria_log($this->sql, '', 0 , 'Consulta', "Entrou na Consulta de $valores[nome] "); 
	}
	
	// M�todo processa parametro
	public function processa_parametro()
	{
		if ($this->id == ''){
		   $this->param = 0;
		} else {
		$this->temp = $this->id;
		$passo1 = $this->temp - 1;
		$passo2 = $passo1*$this->maxpag;
		$this->param = $passo2;
		}
	}
	
	///m�todo de filtro do banco de dados
	public function filtra_banco()
	{
		$this->db->sql($this->sql);
		$this->totreg = $this->db->num_rows();
				
		$this->db->sql($this->sql . " limit  " . $this->param .' , ' . $this->maxpag);
		$this->pacreg = $this->db->num_rows();
	}
	
	//m�todo para calcula das paginas
	public function calcula_paginas()
	{
		$results_tot =$this->totreg;
		$results_parc = $this->pacreg;
		$result_div = $results_tot/$this->maxpag;
		$n_inteiro = (int)$result_div;
		if ($n_inteiro < $result_div) {$this->n_paginas = $n_inteiro + 1;}
		else {$this->n_paginas = $result_div;}
		$this->pg_atual = $this->param/$this->maxpag+1;
		$this->reg_inicial = $this->param + 1;
		$this->pg_Prior = $this->pg_atual - 1;
		$this->pg_proxima = $this->pg_atual + 1;	
	}
	
	//m�todo para escrever a pagina��o
	public function escreve_paginacao($anterior, $proximo, $class, $parametros)
	{
		$saida = "<div align=\"center\">
  					<table border=\"0\" cellspacing=\"0\" width=\"100%\">
					<tr>";
									
		 if ($this->id > 1) {
		 	if ($anterior == "") {
				$saida = $saida. "<td width=\"33%\"><div align=\"left\"><a href=\"?id=$this->pg_Prior$parametros\" class=\"$class\"><b>&lt;&lt;Anterior</font></a></td>";
			} else {
				$saida = $saida. "<td width=\"33%\"><div align=\"left\"><a href=\"?id=$this->pg_Prior$parametros\" class=\"$class\"><b><img src=\"$anterior\" alt=\"p&aacute;gina anterior\" border=\"0\"></font></a></td>";
			}
		 } else {
			$saida = $saida . "<td width=\"33%\"><div align=\"left\"></div></td>";
		 }
		 $lnk_impressos = 0;
		 $saida = $saida . "<td width=\"33%\"><div align=\"center\" class=\"$class\"> <span class=\"titulo1\">";
			if ($this->temp >= $this->maxlnk){
				
					
						
						$aux = $this->maxlnk;
						$n_maxlnk = $this->temp + $this->maxlnk - round($this->maxlnk/2) ;
						$this->maxlnk = $n_maxlnk;
						$lnk_impressos = $this->maxlnk - $aux ;					
					
				
			}
			if  ($this->n_paginas > 1){
				//echo "temp: " . $this->temp . "<br>";
				//echo "n_paginas: " . $this->n_paginas . "<br>";
				//echo "maxlnk: " . $this->maxlnk . "<br>";
				//echo "lnk_impressos: " . $lnk_impressos . "<br>";
				while(($lnk_impressos < $this->n_paginas) and ($lnk_impressos < $this->maxlnk)){ 
					$lnk_impressos ++; 
					
					if ($this->pg_atual == $lnk_impressos){
			    		$saida = $saida . "<font color=\"#B7440D\"> $lnk_impressos </font>";
					} else {
						$saida = $saida . "<font color=\"#B7440D\"><a href=\"?id=$lnk_impressos$parametros\" class=\"$class\"> $lnk_impressos </a></font>";
						   
					  }
			      
				}
				$saida = $saida . "</span></div></td>";
			} 
		
			if  ($this->n_paginas > 1){ 
				if ($this->pg_atual < $this->n_paginas) {
					if ($proximo == "") {
						$saida = $saida . "<td width=\"33%\"><a href=\"?id=$this->pg_proxima$parametros\" class=\"$class\"><b>Pr�ximo&gt;&gt;</b></font></a></td>";
					} else {
						$saida = $saida. "<td width=\"33%\"><div align=\"right\"><a href=\"?id=$this->pg_proxima$parametros\" class=\"$class\"><b><img src=\"$proximo\" alt=\"p&aacute;gina anterior\" border=\"0\"></font></a></td>";
					}
				} else { 
			        $saida = $saida . "<td width=\"33%\"></td>";
			    }
			}

        $saida = $saida . "</tr>
         </table>
          </div>";
		  
		 echo $saida;
	
	}

}


class paginacao_ajax extends paginacao
{


	//m�todo para escrever a pagina��o
	public function escreve_paginacao($anterior, $proximo, $class, $parametros)
	{
		$saida = "<div align=\"center\">
  					<table border=\"0\" cellspacing=\"0\" width=\"100%\">
					<tr>";
									
		 
		 if ($this->id > 1) {
		 	if ($anterior == "") {
				$saida = $saida. "<td width=\"33%\"><div align=\"left\"><a href=\"javascript:carrega_log('".$_REQUEST['cod_usuario']."','".$_REQUEST['nome']."','', '".$_REQUEST['data_inicio']."','".$_REQUEST['data_fim']."', '',$this->pg_Prior);\" class=\"$class\"><b>&lt;&lt;Anterior</font></a></td>";
			} else {
				$saida = $saida. "<td width=\"33%\"><div align=\"left\"><a href=\"javascript:carrega_log('".$_REQUEST['cod_usuario']."','".$_REQUEST['nome']."','', '".$_REQUEST['data_inicio']."','".$_REQUEST['data_fim']."', '',$this->pg_Prior);\" class=\"$class\"><b><img src=\"$anterior\" alt=\"p&aacute;gina anterior\" border=\"0\"></font></a></td>";
			}
		 } else {
			$saida = $saida . "<td width=\"33%\"><div align=\"left\"></div></td>";
		 }
		 $lnk_impressos = 0;
		 $saida = $saida . "<td width=\"33%\"><div align=\"center\" class=\"$class\"> <span class=\"titulo1\">";
			if ($this->temp >= $this->maxlnk){
				
					
						
						$aux = $this->maxlnk;
						$n_maxlnk = $this->temp + $this->maxlnk - round($this->maxlnk/2) ;
						$this->maxlnk = $n_maxlnk;
						$lnk_impressos = $this->maxlnk - $aux ;					
					
				
			}
			if  ($this->n_paginas > 1){
				//echo "temp: " . $this->temp . "<br>";
				//echo "n_paginas: " . $this->n_paginas . "<br>";
				//echo "maxlnk: " . $this->maxlnk . "<br>";
				//echo "lnk_impressos: " . $lnk_impressos . "<br>";
				while(($lnk_impressos < $this->n_paginas) and ($lnk_impressos < $this->maxlnk)){ 
					$lnk_impressos ++; 
					
					if ($this->pg_atual == $lnk_impressos){
			    		$saida = $saida . "<font color=\"#B7440D\"> $lnk_impressos </font>";
					} else {
						$saida = $saida . "<font color=\"#B7440D\"><a href=\"javascript:carrega_log('".$_REQUEST['cod_usuario']."','".$_REQUEST['nome']."','', '".$_REQUEST['data_inicio']."','".$_REQUEST['data_fim']."', '',$lnk_impressos);\" class=\"$class\"> $lnk_impressos </a></font>";
						   
					  }
			      
				}
				$saida = $saida . "</span></div></td>";
			} 
		
			if  ($this->n_paginas > 1){ 
				if ($this->pg_atual < $this->n_paginas) {
					if ($proximo == "") {
						$saida = $saida . "<td width=\"33%\"><a href=\"javascript:carrega_log('".$_REQUEST['cod_usuario']."','".$_REQUEST['nome']."','', '".$_REQUEST['data_inicio']."','".$_REQUEST['data_fim']."', '',$this->pg_proxima);\" class=\"$class\"><b>Pr�ximo&gt;&gt;</b></font></a></td>";
					} else {
						$saida = $saida. "<td width=\"33%\"><div align=\"right\"><a href=\"javascript:carrega_log('".$_REQUEST['cod_usuario']."','".$_REQUEST['nome']."','', '".$_REQUEST['data_inicio']."','".$_REQUEST['data_fim']."', '',$this->pg_proxima);\" class=\"$class\"><b><img src=\"$proximo\" alt=\"p&aacute;gina anterior\" border=\"0\"></font></a></td>";
					}
				} else { 
			        $saida = $saida . "<td width=\"33%\"></td>";
			    }
			}

        $saida = $saida . "</tr>
         </table>
          </div>";
		  
		 echo $saida;
	
	}






}

?>