<?php

/**

 *Classe de definição de banner

 */

    class banner {

        private $ban_pk_id;
        private $ban_nome;
        private $ban_link;
        private $ban_legenda;
        private $ban_flag_tamanho;
        private $ban_foto;
        private $ban_pagina;


        function getPkId(){
            return $this->ban_pk_id;
        }

        function getNome(){
            return $this->ban_nome;
        }

        function getLink(){
            return $this->ban_link;
        }

        function getLegenda(){
            return $this->ban_legenda;
        }

        function getFlag_tamanho(){
            return $this->ban_flag_tamanho;
        }

        function getFotoAbsoluto(){
            return $this->ban_foto;
        }

        function getFoto(){
            $pos = strpos($this->ban_foto, "upload");
            return substr($this->ban_foto, $pos);
        }

        function getPagina(){
            return $this->ban_pagina;
        }

        function setPkId($ban_pk_id){
            $this->ban_pk_id=$ban_pk_id;
        }

        function setNome($ban_nome){
            $this->ban_nome=$ban_nome;
        }

        function setLink($ban_link){
            $this->ban_link=$ban_link;
        }

        function setLegenda($ban_legenda){
            $this->ban_legenda=$ban_legenda;
        }

        function setFlag_tamanho($ban_flag_tamanho){
            $this->ban_flag_tamanho=$ban_flag_tamanho;
        }

        function setFoto($ban_foto){
            $this->ban_foto=$ban_foto;
        }

        function setPagina($ban_pagina){
            $this->ban_pagina=$ban_pagina;
        }


        function getDsPagina(){
            $paginas=json_decode($this->ban_pagina);
            $tela = "";
            foreach ($paginas as $pagina) {
                if ($pagina == "inicialInferior") {
                    $tela .= "Inicial Inferior</br>";
                } elseif ($pagina == "inicialSuperior") {
                    $tela .= "Inicial Superior</br>";
                } elseif ($pagina == "localizacao") {
                    $tela .= "Localização</br>";
                }elseif ($pagina == "cardapio") {
                    $tela .= "Cardápio</br>";
                }elseif ($pagina == "historia") {
                    $tela .= "História</br>";
                }else {
                    $tela .= ucfirst($pagina)."</br>";
                }
            }
            return $tela;
        }

        function __construct(){

        }

        function construct($ban_nome,$ban_link,$ban_flag_tamanho,$ban_foto,$ban_pagina){
            $this->ban_nome=$ban_nome;
            $this->ban_link=$ban_link;
            $this->ban_flag_tamanho=$ban_flag_tamanho;
            $this->ban_foto=$ban_foto;
            $this->ban_pagina=$ban_pagina;
        }

        function show(){
            echo "Código do banner:".$this->ban_pk_id."<br>";
            echo "Nome:".$this->ban_nome."<br>";
            echo "Link:".$this->ban_link."<br>";
            // echo "Legenda:".$this->emp_legenda."<br>";
            echo "Flag tamanho:".$this->ban_flag_tamanho."<br>";
            echo "Foto:".$this->ban_foto."<br>";
            echo "Página:".$this->ban_pagina."<br>";
        }

    }

?>

