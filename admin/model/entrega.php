<?php
/**
 * Classe de definição de Entrega 
 */

        class entrega {
            private $cod_entrega;

            private $raio_km;
            
            private $taxa_entrega;
            
            private $tempo;
            
            private $min_frete_gratis;

            private $flag_ativo;
            
            /**
             * GET'S and SET'S
             */
            
            function getCod_entrega(){
                return $this->cod_entrega;
            }

            function getTempo(){
                return $this->tempo;
            }

            function getRaio_km(){
                return $this->raio_km;
            }

            function getTaxa_entrega(){
                return $this->taxa_entrega;
            }

            function getMin_frete_gratis(){
                return $this->min_frete_gratis;
            }

            function getFlag_ativo(){
                return $this->flag_ativo;
            }




            function setCod_entrega($cod_entrega){
                $this->cod_entrega = $cod_entrega;
            }

            function setTempo($tempo){
                $this->tempo = $tempo;
            }
            
            function setRaio_km($raio_km){
                $this->raio_km = $raio_km;
            }
            
            function setTaxa_entrega($taxa_entrega){
                $this->taxa_entrega = $taxa_entrega;
            }
            
            function setMin_frete_gratis($min_frete_gratis){
                $this->min_frete_gratis = $min_frete_gratis;
            }

            function setFlag_ativo($flag_ativo){
                $this->flag_ativo = $flag_ativo;
            }
            
            function construct($raio_km, $taxa_entrega, $tempo, $min_frete_gratis, $flag_ativo=1){
                $this->tempo = $tempo;
                $this->raio_km = $raio_km;
                $this->taxa_entrega = $taxa_entrega;
                $this->min_frete_gratis = $min_frete_gratis;
                $this->flag_ativo = $flag_ativo;
            }

            function __construct(){
                
            }

            function show(){
                echo "Código da Entrega: ".$this->cod_entrega."<br>";
                echo "Tempo p/ Entrega: ".$this->tempo."<br>";
                echo "Alcance raio: ".$this->raio_km."<br>";
                echo "Taxa de Entrega: ".$this->taxa_entrega."<br>";
                echo "Valor Min. p/ Frete Grátis: ".$this->min_frete_gratis."<br>";
                echo "Raio Ativado: ".$this->flag_ativo."<br>";
            }
        }
?>