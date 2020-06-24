<?php
/**
 *Classe de definição de categoria
 */
    class faixaHorario {

        private $faho_pk_id;
        private $faho_inicio;
        private $faho_final;
        private $faho_turno;
        private $faho_fk_produto;


        function getPkId(){
            return $this->faho_pk_id;
        }
        function getInicio(){
            return $this->faho_inicio;
        }
        function getFinal(){
            return $this->faho_final;
        }
        function getTurno(){
            return $this->faho_turno;
        }
        function getFkProduto(){
            return $this->faho_fk_produto;
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
        function setTurno($faho_turno){
            $this->faho_turno=$faho_turno;
        }
        function setFkProduto($faho_fk_produto){
            $this->faho_fk_produto=$faho_fk_produto;
        }

        function __construct(){
        }
        function construct($faho_inicio, $faho_final, $faho_turno, $faho_fk_produto=""){
            $this->faho_turno=$faho_turno;
            $this->faho_inicio=$faho_inicio;
            $this->faho_final=$faho_final;
            $this->faho_fk_produto=$faho_fk_produto;
        }
        function show(){
            echo "Código da Faixa Horario:".$this->faho_pk_id."<br>";
            
        }
    }
?>