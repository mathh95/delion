<?php

class cardapio_turno{
    private $cod_cardapio_turno;
    private $nome;

    function getCod_cardapio_turno(){
        return $this->cod_cardapio_turno;
    }
    function getNome(){
        return $this->nome;
    }

    function setCod_cardapio_turno($cod_cardapio_turno){
        $this->cod_cardapio_turno = $cod_cardapio_turno;
    }
    function setNome($nome){
        $this->nome=$nome;
    }
    function __construct(){
    }
    function construct($nome){
        $this->nome=$nome;
    }
    function show(){
        echo "Código do turno:".$this->cod_cardapio_turno."<br>";
        echo "Nome:".$this->nome."<br>";
    }
}