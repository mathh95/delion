<?php
    /*
    Classe de defininção da gerencia do site
    */
    class gerencia_site{

        private $gesi_pk_id;
        private $gesi_nome;
        private $gesi_ima_foto;
        private $gesi_flag_ativo;
        private $gesi_cor_primaria;
        private $gesi_cor_secundaria;


        function getPkId(){
            return $this->gesi_pk_id;
        }

        function getNome(){
            return $this->gesi_nome;
        }

        function getFotoAbsoluto(){
            return $this->gesi_ima_foto;
        }

        function getFoto(){
            $pos = strpos($this->gesi_ima_foto, "upload");
            return substr($this->gesi_ima_foto, $pos);
        }

        function getFlag_ativo(){
            return $this->gesi_flag_ativo;
        }

        function getCorPrimaria(){
            return $this->gesi_cor_primaria;
        }

        function getCorSecundaria(){
            return $this->gesi_cor_secundaria;
        }

        function setPkId($gesi_pk_id){
            $this->gesi_pk_id=$gesi_pk_id;
        }

        function setNome($gesi_nome){
            $this->gesi_nome=$gesi_nome;
        }

        function setFoto($gesi_ima_foto){
            $this->gesi_ima_foto=$gesi_ima_foto;
        }

        function setFlag_ativo($gesi_flag_ativo){
            $this->gesi_flag_ativo=$gesi_flag_ativo;
        }

        function setCorPrimaria($gesi_cor_primaria){
            $this->gesi_cor_primaria=$gesi_cor_primaria;
        }

        function setCorSecundaria($gesi_cor_secundaria){
            $this->gesi_cor_secundaria=$gesi_cor_secundaria;
        }

        function __construct(){
            
        }

        function construct($gesi_nome,$gesi_ima_foto,$gesi_flag_ativo,$gesi_cor_primaria,$gesi_cor_secundaria){
            $this->gesi_nome=$gesi_nome;
            $this->gesi_ima_foto=$gesi_ima_foto;
            $this->gesi_flag_ativo=$gesi_flag_ativo;
            $this->gesi_cor_primaria=$gesi_cor_primaria;
            $this->gesi_cor_secundaria=$gesi_cor_secundaria;
        }

        function show(){
            echo "Código da configuração".$this->gesi_pk_id."<br>";
            echo "Nome da configuração".$this->gesi_pk_id."<br>";
            echo "Foto".$this->gesi_ima_foto."<br>";
            echo "Flag Ativo".$this->gesi_flag_ativo."<br>";
            echo "Cor Primária".$this->gesi_cor_primaria."<br>";
            echo "Cor Segundária".$this->gesi_cor_secundaria."<br>";
        }

    }

?>