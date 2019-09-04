<?php
//Horas do cardapio-turno
class cardapio_horas{
    private $cod_cardapio_horas;
    private $horario;

    function getCod_cardapio_horas(){
        return $this->cod_cardapio_horas;
    }
    function getHorario(){
        return $this->horario;
    }

    function setCod_cardapio_horas($cod_cardapio_horas){
        $this->cod_cardapio_horas = $cod_cardapio_horas;
    }
    function setHorario($horario){
        $this->horario=$horario;
    }
    function __construct(){
    }
    function construct($horario){
        $this->horario=$horario;
    }
    function show(){
        echo "Código do horario:".$this->cod_cardapio_horas."<br>";
        echo "Hora:".$this->horario."<br>";
    }
}