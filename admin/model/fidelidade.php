<?php
/**
 *Classe de definição de Fidelidade
 */
    class fidelidade {

        private $fid_pk_id;
        private $fid_taxa_conversao_pts;
        private $fid_fk_empresa;


        function getPkId(){
            return $this->fid_pk_id;
        }
        function getTaxaConversaoPts(){
            return $this->fid_taxa_conversao_pts;
        }
        function getFkEmpresa(){
            return $this->fid_fk_empresa;
        }

        function setPkId($fid_pk_id){
            $this->fid_pk_id = $fid_pk_id;
        }
        function setTaxaConversaoPts($fid_taxa_conversao_pts){
            $this->fid_taxa_conversao_pts = $fid_taxa_conversao_pts;
        }
        function setFkEmpresa($fid_fk_empresa){
            $this->fid_fk_empresa = $fid_fk_empresa;
        }


        function __construct(){
        }
        function construct($fid_taxa_conversao_pts, $fid_fk_empresa = null){
            $this->fid_taxa_conversao_pts = $fid_taxa_conversao_pts;
            $this->fid_fk_empresa = $fid_fk_empresa;
        }
        function show(){
            echo "Código da fidelidade:".$this->fid_pk_id."<br>";
            echo "Taxa de Conversao Pts:".$this->fid_taxa_conversao_pts."<br>";
            echo "Fk Empresa:".$this->fid_fk_empresa."<br>";
        }
    }
?>