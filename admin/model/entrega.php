<?php
/**
 * Classe de definição de Entrega 
 */

        class entrega {
            private $ent_pk_id;

            private $ent_raio_km;
            
            private $ent_taxa_entrega;

            private $ent_valor_minimo;
            
            private $ent_tempo;
            
            private $ent_min_taxa_gratis;

            private $ent_flag_ativo;
            
            /**
             * GET'S and SET'S
             */
            
            function getPkId(){
                return $this->ent_pk_id;
            }

            function getTempo(){
                return $this->ent_tempo;
            }

            function getRaio_km(){
                return $this->ent_raio_km;
            }

            function getTaxa_entrega(){
                return $this->ent_taxa_entrega;
            }

            function getValor_minimo(){
                return $this->ent_valor_minimo;
            }

            function getMin_taxa_gratis(){
                return $this->ent_min_taxa_gratis;
            }

            function getFlag_ativo(){
                return $this->ent_flag_ativo;
            }

            function setPkId($ent_pk_id){
                $this->ent_pk_id = $ent_pk_id;
            }

            function setTempo($ent_tempo){
                $this->ent_tempo = $ent_tempo;
            }
            
            function setRaio_km($ent_raio_km){
                $this->ent_raio_km = $ent_raio_km;
            }
            
            function setTaxa_entrega($ent_taxa_entrega){
                $this->ent_taxa_entrega = $ent_taxa_entrega;
            }

            function setValor_minimo($ent_valor_minimo){
                $this->ent_valor_minimo = $ent_valor_minimo;
            }
            
            function setMin_taxa_gratis($ent_min_taxa_gratis){
                $this->ent_min_taxa_gratis = $ent_min_taxa_gratis;
            }

            function setFlag_ativo($ent_flag_ativo){
                $this->ent_flag_ativo = $ent_flag_ativo;
            }
            
            function construct($ent_raio_km, $ent_taxa_entrega, $ent_tempo, $ent_valor_minimo, $ent_min_taxa_gratis, $ent_flag_ativo=1){
                $this->ent_tempo = $ent_tempo;
                $this->ent_raio_km = $ent_raio_km;
                $this->ent_taxa_entrega = $ent_taxa_entrega;
                $this->ent_valor_minimo = $ent_valor_minimo;
                $this->ent_min_taxa_gratis = $ent_min_taxa_gratis;
                $this->ent_flag_ativo = $ent_flag_ativo;
            }

            function __construct(){
                
            }

            function show(){
                echo "Código da Entrega: ".$this->ent_pk_id."<br>";
                echo "Tempo p/ Entrega: ".$this->ent_tempo."<br>";
                echo "Alcance raio: ".$this->ent_raio_km."<br>";
                echo "Taxa de Entrega: ".$this->ent_taxa_entrega."<br>";
                echo "Valor Min. p/ entrega: ".$this->ent_valor_minimo."<br>";
                echo "Valor Min. p/ Taxa Grátis: ".$this->ent_min_taxa_gratis."<br>";
                echo "Raio Ativado: ".$this->ent_flag_ativo."<br>";
            }
        }
?>