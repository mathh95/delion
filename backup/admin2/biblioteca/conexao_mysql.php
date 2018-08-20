<? 
/** 
* Autor : Alexandre martins da silva 
* Data  : 15/10/2004 
* Desc  : Objeto para se conectar com o banco de dados mysql... 
*/ 

class conexao_mysql 
{ 
    ////////////////Atributos da class////////////////// 
    private $servidor; 
    private $usuario; 
    private $senha; 
    private $banco; 
    private $query; 
    private $conn;
	private $result; 
     
    ////////////////Metodos da classe/////////////// 
    // Metodo Contrutor 
    public function __construct($servidor,$banco,$usuario,$senha) 
    {         
        $this->servidor = $servidor;
		$this->banco = $banco;
		$this->usuario = $usuario;
		$this->senha = $senha;
		$this->conexao(); 
    } 
	
	// Método Destrutor
	public function __destruct()
	{
		if ($this->conn) {
			mysql_close($this->conn);
		}
	
	}

    // Metodo conexao com o banco 
    public function conexao() 
    { 
        $this->conn = mysql_connect($this->servidor,$this->usuario,$this->senha) or die ("Problema na conexão: servidor: $this->servidor, usuario: $this->usuario " . mysql_error()); 
        if (!$this->conn) { 
            return 0; 
        } else {
		
			if (mysql_select_db($this->banco,$this->conn)) { 
				return 1; 
			} else {
				die ("Problema na selecao da base: banco:$this->banco,  " . mysql_error());
			}
		}
    } 

    // Metodo sql 
    public function sql($query) 
    { 
        $this->query = $query; 
        if ($result = mysql_query($this->query,$this->conn)) { 
            $this->result = $result; 
			return $this->result;
        } else { 
            echo "Nao foi possivel realizar o select: " . $this->query . ", erro: " .  mysql_error();
			return 0; 
        } 
    }
	
	//Método para retornar o result
	public function get_result()
	{
		return $this->result;	
	}
	
	//Método para limpar o result
	public function free_result()
	{
		mysql_free_result($this->result);	
	}  
	
	//Metodo para verificar o numero de registros
	public function num_rows()
	{
		return mysql_num_rows($this->result);
	
	} 
	
	//Metodo para transformar um resultset em array
	public function fetch_array()
	{
		return mysql_fetch_array($this->result);
	}  

    // Metodo que retorna o ultimo id de um inserção 
    public function id() 
    { 
        return mysql_insert_id($this->conn); 
    } 

    // Metodo fechar conexao 
    public function fechar() 
    { 
        return mysql_close($this->conn); 
    } 
	
	// Método pra pegar a estrutura da tabela
	public function get_fields( $table )
    {
        // returns an array with filed properties
        $ret = array();
        $lfields = mysql_query("SHOW FIELDS FROM $table",$this->conn);
		while($row=mysql_fetch_array($lfields))
        {
            $field = $row["Field"];
            $type = strtolower($row["Type"]);
            $type = stripslashes($type);
            $type = str_replace("binary","",$type);
            $type = str_replace("zerofill","",$type);
            $type = str_replace("unsigned","",$type);
            $length = $type;
            $length = strstr($length,"(");
            $length = str_replace("(","",$length);
            $length = str_replace(")","",$length);
            $length = (int)chop($length);
            $type = chop(eregi_replace("\\(.*\\)", "", $type));
            //print "Field: $field - Mysql: ${row["Type"]} - Type: $type - Length: $length<br>";
            $ret[$field]["type"]=$type;
            $ret[$field]["maxlength"]=$length;
        }
        return $ret;
    }
} 
/////////////////FIM DA CLASSE//////////////// 
?>