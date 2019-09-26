<?php
/* Classe de definicao da tabela Cupom_Cliente */

class cupom_cliente{
    private $cod_cupom_cliente;
    private $cod_cliente;
    private $nome;
    private $cod_cupom;
    private $codigo;
    private $uso;

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

    function getUso(){
        return $this->uso;
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

    function setUso($uso){
        $this->uso = $uso;
    }

    function __construct(){
                
    }

    function construct($cod_cupom, $cod_cliente, $uso){
        $this->cod_cupom = $cod_cupom;
        $this->cod_cliente = $cod_cliente;
        $this->uso = $uso;
    }

    function construct1($cod_cupom, $codigo, $cod_cliente, $nome, $uso){
        $this->cod_cliente = $cod_cliente;
        $this->nome = $nome;
        $this->cod_cupom = $cod_cupom;
        $this->codigo = $codigo;
        $this->uso = $uso;
    }

    function show(){
        echo "Código Cupom_cliente: ".$this->cod_cupom_cliente."<br>";
        echo "Código Cupom: ".$this->cod_cupom."<br>";
        echo "Código Cliente: ".$this->cod_cliente."<br>";
        echo "Dia e Hora de uso: ".$this->uso."<br>";
    }
}