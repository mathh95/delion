<?php
/**
 *Classe de definição de categoria
 */
    class faixaHorario {

        private $faho_pk_id;
        private $faho_inicio;
        private $faho_final;
        private $faho_nome;


        function getPkId(){
            return $this->faho_pk_id;
        }
        function getInicio(){
            return $this->faho_inicio;
        }
        function getFinal(){
            return $this->faho_final;
        }
        function getNome(){
            return $this->faho_nome;
        }

        function setPkId($faho_pk_id){
            $this->faho_pk_id=$faho_pk_id;
        }
        function setInicio($faho_inicio){
            $this->faho_inicio=$faho_inicio;
        }
        function setFinal($faho_final){
            $this->faho_final=$faho_final;
        }
        function setNome($faho_nome){
            $this->faho_nome=$faho_nome;
        }

        function __construct(){
        }
        function construct($faho_inicio, $faho_final, $faho_nome){
            $this->faho_inicio=$faho_inicio;
            $this->faho_final=$faho_final;
            $this->faho_nome=$faho_nome;
        }
        function show(){
            echo "Código da Faixa Horario:".$this->faho_pk_id."<br>";
            
        }
    }
?>