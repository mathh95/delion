<?php
/**
 *Classe de definição de evento
 */
    class evento {

        private $cod_evento;
        private $nome;
        private $data;
        private $flag_antigo;
        private $foto;


        function getCod_evento(){
            return $this->cod_evento;
        }
        function getNome(){
            return $this->nome;
        }
        function getData(){
            return $this->data;
        }
        function getFlag_antigo(){
            return $this->flag_antigo;
        }
        function getFotoAbsoluto(){
            return $this->foto;
        }
        function getFoto(){
            $pos = strpos($this->foto, "upload");
            return substr($this->foto, $pos);
        }


        function setCod_evento($cod_evento){
            $this->cod_evento=$cod_evento;
        }
        function setNome($nome){
            $this->nome=$nome;
        }
        function setData($data){
            $this->data=$data;
        }
        function setFlag_antigo($flag_antigo){
            $this->flag_antigo=$flag_antigo;
        }
        function setFoto($foto){
            $this->foto=$foto;
        }

        function getDsAntigo(){
            $antigo = ($this->flag_antigo == 1) ? "Antigo" : "Novo" ;
            return $antigo;
        }

        function __construct(){
        }
        function construct($nome,$data,$flag_antigo,$foto){
            $this->nome=$nome;
            $this->data=$data;
            $this->flag_antigo=$flag_antigo;
            $this->foto=$foto;
        }
        function show(){
            echo "Código do evento:".$this->cod_evento."<br>";
            echo "Nome:".$this->nome."<br>";
            echo "Data:".$this->data."<br>";
            echo "Flag antigo:".$this->flag_antigo."<br>";
            echo "Foto:".$this->foto."<br>";
        }
    }
?>