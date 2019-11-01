<?php
/**
 * Classe de definição de Entrega 
 */

        class entrega {
            private $cod_entrega;

            private $raio_km;
            
            private $taxa_entrega;

            private $valor_minimo;
            
            private $tempo;
            
            private $min_taxa_gratis;

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

            function getValor_minimo(){
                return $this->valor_minimo;
            }

            function getMin_taxa_gratis(){
                return $this->min_taxa_gratis;
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

            function setValor_minimo($valor_minimo){
                $this->valor_minimo = $valor_minimo;
            }
            
            function setMin_taxa_gratis($min_taxa_gratis){
                $this->min_taxa_gratis = $min_taxa_gratis;
            }

            function setFlag_ativo($flag_ativo){
                $this->flag_ativo = $flag_ativo;
            }
            
            function construct($raio_km, $taxa_entrega, $tempo, $valor_minimo, $min_taxa_gratis, $flag_ativo=1){
                $this->tempo = $tempo;
                $this->raio_km = $raio_km;
                $this->taxa_entrega = $taxa_entrega;
                $this->valor_minimo = $valor_minimo;
                $this->min_taxa_gratis = $min_taxa_gratis;
                $this->flag_ativo = $flag_ativo;
            }

            function __construct(){
                
            }

            function show(){
                echo "Código da Entrega: ".$this->cod_entrega."<br>";
                echo "Tempo p/ Entrega: ".$this->tempo."<br>";
                echo "Alcance raio: ".$this->raio_km."<br>";
                echo "Taxa de Entrega: ".$this->taxa_entrega."<br>";
                echo "Valor Min. p/ entrega: ".$this->valor_minimo."<br>";
                echo "Valor Min. p/ Taxa Grátis: ".$this->min_taxa_gratis."<br>";
                echo "Raio Ativado: ".$this->flag_ativo."<br>";
            }
        }
?>