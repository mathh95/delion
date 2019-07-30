<?

/* Classe de definicao do Cliente via Whatsapp. */
class ClienteWpp {
    private $cod_cliente_wpp;
    private $nome;
    private $telefone;
    private $rua;
    private $numero;
    private $bairro;
    private $complemento;

    /* GETTERS */
    function getCod_cliente_wpp(){
        return $this->cod_cliente_wpp;
    }

    function getNome(){
        return $this->nome;
    }

    function getTelefone(){
        return $this->telefone;
    }
    

    
    function getRua(){
        return $this->rua;
    }

    function getNumero(){
        return $this->numero;
    }

    function getBairro(){
        return $this->bairro;
    }
    function getComplemento(){
        return $this->complemento;
    }


    /* SETTERS */
    function setCod_cliente_wpp($cod_cliente_wpp){
        $this->cod_cliente_wpp = $cod_cliente_wpp;
    }

    function setNome($nome){
        $this->nome = $nome;
    }

    function setTelefone($telefone){
        $this->telefone = $telefone;
    }


    function setRua($rua){
        $this->rua = $rua;
    }

    function setNumero($numero){
        $this->numero = $numero;
    }

    function setBairro($bairro){
        $this->bairro = $bairro;
    }

    function setComplemento($complemento){
        $this->complemento = $complemento;
    }

    function construct($nome, $telefone_cliente, $rua, $numero, $bairro, $complemento){
        $this->nome = $nome;
        $this->telefone_cliente = $telefone_cliente;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->complemento = $complemento;
    }
    function __construct(){
        
    }
    function show(){
        echo "Código do Cliente do Whatsapp: ".$this->cod_cliente_wpp."<br>";
        echo "Nome: ".$this->nome."<br>";
        echo "Telefone: ".$this->telefone_cliente."<br>";
        echo "Rua: ".$this->rua."<br>";
        echo "Numero: ".$this->numero."<br>";
        echo "Bairro: ".$this->bairro."<br>";
        echo "Complemento: ".$this->complemento."<br>";

    }
}