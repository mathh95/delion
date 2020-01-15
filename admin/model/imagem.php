<?php
/**
 *Classe de definição de imagem
 */
    class imagem {

        private $ima_pk_id;
        private $ima_nome;
        private $ima_foto;
        private $ima_pagina;


        function getPkId(){
            return $this->ima_pk_id;
        }
        function getNome(){
            return $this->ima_nome;
        }
        function getFotoAbsoluto(){
            return $this->ima_foto;
        }
        function getFoto(){
            $pos = strpos($this->ima_foto, "upload");
            return substr($this->ima_foto, $pos);
        }
        function getPagina(){
            return $this->ima_pagina;
        }

        function setPkId($ima_pk_id){
            $this->ima_pk_id=$ima_pk_id;
        }
        function setNome($nome){
            $this->ima_nome=$nome;
        }
        function setFoto($foto){
            $this->ima_foto=$foto;
        }
        function setPagina($pagina){
            $this->ima_pagina=$pagina;
        }
        function getDsPagina(){
            $paginas=json_decode($this->ima_pagina);
            $tela = "";
            foreach ($paginas as $pagina) {
                if ($pagina == "inicialInferior") {
                    $tela .= "Inicial Inferior</br>";
                } elseif ($pagina == "inicialSuperior") {
                    $tela .= "Inicial Superior</br>";
                } elseif ($pagina == "inicialEvento") {
                    $tela .= "Inicial Evento</br>";
                } elseif ($pagina == "localizacao") {
                    $tela .= "Localização</br>";
                }elseif ($pagina == "cardapio") {
                    $tela .= "Cardápio</br>";
                }elseif ($pagina == "historia") {
                    $tela .= "História</br>";
                }elseif ($pagina == "homeQuemSomos") {
                    $tela .= "Quem Somos</br>";
                }elseif ($pagina == "homeEventos") {
                    $tela .= "Eventos</br>";
                }elseif ($pagina == "homeFidelidade") {
                $tela .= "Fidelidade</br>";
                }elseif ($pagina == "homeTopo") {
                $tela .= "Topo</br>";
                }elseif ($pagina == "homeLogo") {
                $tela .= "Logo</br>";
                }else {
                    $tela .= ucfirst($pagina)."</br>";
                }
            }
            return $tela;
        }

        function __construct(){
        }
        function construct($ima_nome,$ima_foto,$ima_pagina){
            $this->ima_nome=$ima_nome;
            $this->ima_foto=$ima_foto;
            $this->ima_pagina=$ima_pagina;
        }
        function show(){
            echo "Código da imagem:".$this->ima_pk_id."<br>";
            echo "Nome:".$this->ima_nome."<br>";
            echo "Foto:".$this->ima_foto."<br>";
            echo "Página:".$this->ima_pagina."<br>";

        }
    }
?>
