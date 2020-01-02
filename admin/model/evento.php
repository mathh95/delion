<?php
/**
 *Classe de definição de evento
 */
    class evento {

        private $eve_pk_id;
        private $eve_nome;
        private $eve_data;
        private $eve_flag_antigo;
        private $eve_foto;


        function getCod_evento(){
            return $this->eve_pk_id;
        }
        function getNome(){
            return $this->eve_nome;
        }
        function getData(){
            return $this->eve_data;
        }
        function getFlag_antigo(){
            return $this->eve_flag_antigo;
        }
        function getFotoAbsoluto(){
            return $this->eve_foto;
        }
        function getFoto(){
            $pos = strpos($this->eve_foto, "upload");
            return substr($this->eve_foto, $pos);
        }


        function setCod_evento($eve_pk_id){
            $this->eve_pk_id=$eve_pk_id;
        }
        function setNome($eve_nome){
            $this->eve_nome=$eve_nome;
        }
        function setData($eve_data){
            $this->eve_data=$eve_data;
        }
        function setFlag_antigo($eve_flag_antigo){
            $this->eve_flag_antigo=$eve_flag_antigo;
        }
        function setFoto($eve_foto){
            $this->eve_foto=$eve_foto;
        }

        function getDsAntigo(){
            $antigo = ($this->eve_flag_antigo == 1) ? "Antigo" : "Novo" ;
            return $antigo;
        }

        function __construct(){
        }
        function construct($eve_nome,$eve_data,$eve_flag_antigo,$eve_foto){
            $this->eve_nome=$eve_nome;
            $this->eve_data=$eve_data;
            $this->eve_flag_antigo=$eve_flag_antigo;
            $this->eve_foto=$eve_foto;
        }
        function show(){
            echo "Código do evento:".$this->eve_pk_id."<br>";
            echo "Nome:".$this->eve_nome."<br>";
            echo "Data:".$this->eve_data."<br>";
            echo "Flag antigo:".$this->eve_flag_antigo."<br>";
            echo "Foto:".$this->eve_foto."<br>";
        }
    }
?>