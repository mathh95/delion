<?php

/**

 *Classe de definição de banner

 */

    class banner {



        private $emp_pk_id;
        private $emp_nome;
        private $emp_link;
        private $emp_legenda;
        private $emp_flag_tamanho;
        private $emp_foto;
        private $emp_pagina;


        function getPkId(){
            return $this->emp_pk_id;
        }

        function getNome(){
            return $this->emp_nome;
        }

        function getLink(){
            return $this->emp_link;
        }

        function getLegenda(){
            return $this->emp_legenda;
        }

        function getFlag_tamanho(){
            return $this->emp_flag_tamanho;
        }

        function getFotoAbsoluto(){
            return $this->emp_foto;
        }

        function getFoto(){
            $pos = strpos($this->emp_foto, "upload");
            return substr($this->emp_foto, $pos);
        }

        function getPagina(){
            return $this->emp_pagina;
        }

        function setPkId($emp_pk_id){
            $this->emp_pk_id=$emp_pk_id;
        }

        function setNome($emp_nome){
            $this->emp_nome=$emp_nome;
        }

        function setLink($emp_link){
            $this->emp_link=$emp_link;
        }

        function setLegenda($emp_legenda){
            $this->emp_legenda=$emp_legenda;
        }

        function setFlag_tamanho($emp_flag_tamanho){
            $this->emp_flag_tamanho=$emp_flag_tamanho;
        }

        function setFoto($emp_foto){
            $this->emp_foto=$emp_foto;
        }

        function setPagina($emp_pagina){
            $this->emp_pagina=$emp_pagina;
        }


        function getDsPagina(){

            $paginas=json_decode($this->emp_pagina);

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

        function construct($emp_nome,$emp_link/*,$emp_legenda*/,$emp_flag_tamanho,$emp_foto,$emp_pagina){

            $this->emp_nome=$emp_nome;

            $this->emp_link=$emp_link;

            // $this->emp_legenda=$emp_legenda;

            $this->emp_flag_tamanho=$emp_flag_tamanho;

            $this->emp_foto=$emp_foto;

            $this->emp_pagina=$emp_pagina;
        }

        function show(){

            echo "Código do banner:".$this->emp_pk_id."<br>";

            echo "Nome:".$this->emp_nome."<br>";

            echo "Link:".$this->emp_link."<br>";

            // echo "Legenda:".$this->emp_legenda."<br>";

            echo "Flag tamanho:".$this->emp_flag_tamanho."<br>";

            echo "Foto:".$this->emp_foto."<br>";

            echo "Página:".$this->emp_pagina."<br>";



        }

    }

?>

