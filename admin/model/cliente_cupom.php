<?php
/* Classe de definicao da tabela Cupom_Cliente */

class cliente_cupom{

    private $clcu_pk_id;
    private $clcu_fk_cliente;
    private $clcu_fk_cupom;
    private $clcu_ultimo_uso;

    /* Getters */

    function getPkId(){
        return $this->clcu_pk_id;
    }

    function getFkCliente(){
        return $this->clcu_fk_cliente;
    }


    function getFkCupom(){
        return $this->clcu_fk_cupom;
    }

    function getUltimo_uso(){
        return $this->clcu_ultimo_uso;
    }

    /* Setters */

    function setPkId($clcu_pk_id){
        $this->clcu_pk_id = $clcu_pk_id;
    }

    function setFkCLiente($clcu_fk_cliente){
        $this->clcu_fk_cliente = $clcu_fk_cliente;
    }

    function setFkCupom($clcu_fk_cupom){
        $this->clcu_fk_cupom = $clcu_fk_cupom;
    }

    function setUltimo_uso($clcu_ultimo_uso){
        $this->clcu_ultimo_uso = $clcu_ultimo_uso;
    }

    function __construct(){
    }

    function construct($clcu_fk_cupom, $clcu_fk_cliente, $clcu_ultimo_uso){
        $this->clcu_fk_cupom = $clcu_fk_cupom;
        $this->clcu_fk_cliente = $clcu_fk_cliente;
        $this->clcu_ultimo_uso = $clcu_ultimo_uso;
    }

    function show(){
        echo "PK: ".$this->clcu_pk_id."<br>";
        echo "Código Cupom: ".$this->clcu_cod_cupom."<br>";
        echo "Código Cliente: ".$this->clcu_cod_cliente."<br>";
        echo "Dia e Hora de uso: ".$this->clcu_ultimo_uso."<br>";
    }
}