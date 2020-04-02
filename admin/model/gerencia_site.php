<?php
    /*
    Classe de defininção da gerencia do site
    */
    class gerencia_site{

        private $geren_pk_id;
        private $geren_nome;
        private $geren_ima_foto;
        private $geren_flag_ativo;
        private $geren_cor_primaria;
        private $geren_cor_secundaria;


        function getPkId(){
            return $this->geren_pk_id;
        }

        function getNome(){
            return $this->geren_nome;
        }

        function getFotoAbsoluto(){
            return $this->geren_ima_foto;
        }

        function getFoto(){
            $pos = strpos($this->geren_ima_foto, "upload");
            return substr($this->geren_ima_foto, $pos);
        }

        function getFlag_ativo(){
            return $this->geren_flag_ativo;
        }

        function getCorPrimaria(){
            return $this->geren_cor_primaria;
        }

        function getCorSecundaria(){
            return $this->geren_cor_secundaria;
        }

        function setPkId($geren_pk_id){
            $this->geren_pk_id=$geren_pk_id;
        }

        function setNome($geren_nome){
            $this->geren_nome=$geren_nome;
        }

        function setFoto($geren_ima_foto){
            $this->geren_ima_foto=$geren_ima_foto;
        }

        function setFlag_ativo($geren_flag_ativo){
            $this->geren_flag_ativo=$geren_flag_ativo;
        }

        function setCorPrimaria($geren_cor_primaria){
            $this->geren_cor_primaria=$geren_cor_primaria;
        }

        function setCorSecundaria($geren_cor_secundaria){
            $this->geren_cor_secundaria=$geren_cor_secundaria;
        }

        function __construct(){
            
        }

        function construct($geren_nome,$geren_ima_foto,$geren_flag_ativo,$geren_cor_primaria,$geren_cor_secundaria){
            $this->geren_nome=$geren_nome;
            $this->geren_ima_foto=$geren_ima_foto;
            $this->geren_flag_ativo=$geren_flag_ativo;
            $this->geren_cor_primaria=$geren_cor_primaria;
            $this->geren_cor_secundaria=$geren_cor_secundaria;
        }

        function show(){
            echo "Código da configuração".$this->geren_pk_id."<br>";
            echo "Nome da configuração".$this->geren_pk_id."<br>";
            echo "Foto".$this->geren_ima_foto."<br>";
            echo "Flag Ativo".$this->geren_flag_ativo."<br>";
            echo "Cor Primária".$this->geren_cor_primaria."<br>";
            echo "Cor Segundária".$this->geren_cor_secundaria."<br>";
        }

    }

?>