<?php
/* Classe de definicao da tabela Cupom_Cliente */

class cupom_cliente{
    private $cod_cupom_cliente;
    private $cod_cliente;
    private $nome;
    private $cod_cupom;
    private $codigo;
    private $ultimo_uso;

    /* Getters */

    function getCod_cupom_cliente(){
        return $this->cod_cupom_cliente;
    }

    function getCod_cliente(){
        return $this->cod_cliente;
    }
    
    function getNome(){
        return $this->nome;
    }

    function getCod_cupom(){
        return $this->cod_cupom;
    }
    
    function getCodigo(){
        return $this->codigo;
    }

    function getUltimo_uso(){
        return $this->ultimo_uso;
    }

    /* Setters */

    function setCod_cupom_cliente($cod_cupom_cliente){
        $this->cod_cupom_cliente = $cod_cupom_cliente;
    }

    function setCod_cliente($cod_cliente){
        $this->cod_cliente = $cod_cliente;
    }

    function setNome($nome){
        $this->nome = $nome;
    }

    function setCod_cupom($cod_cupom){
        $this->cod_cupom = $cod_cupom;
    }

    function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    function setUltimo_uso($ultimo_uso){
        $this->ultimo_uso = $ultimo_uso;
    }

    function __construct(){
                
    }

    function construct($cod_cupom, $cod_cliente, $ultimo_uso){
        $this->cod_cupom = $cod_cupom;
        $this->cod_cliente = $cod_cliente;
        $this->ultimo_uso = $ultimo_uso;
    }

    function construct1($cod_cupom, $codigo, $cod_cliente, $nome, $ultimo_uso){
        $this->cod_cliente = $cod_cliente;
        $this->nome = $nome;
        $this->cod_cupom = $cod_cupom;
        $this->codigo = $codigo;
        $this->ultimo_uso = $ultimo_uso;
    }

    function show(){
        echo "Código Cupom_cliente: ".$this->cod_cupom_cliente."<br>";
        echo "Código Cupom: ".$this->cod_cupom."<br>";
        echo "Código Cliente: ".$this->cod_cliente."<br>";
        echo "Dia e Hora de uso: ".$this->ultimo_uso."<br>";
    }
}