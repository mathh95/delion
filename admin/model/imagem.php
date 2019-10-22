<?php
/**
 *Classe de definição de imagem
 */
    class imagem {

        private $cod_imagem;
        private $nome;
        private $foto;
        private $pagina;


        function getCod_imagem(){
            return $this->cod_imagem;
        }
        function getNome(){
            return $this->nome;
        }
        function getFotoAbsoluto(){
            return $this->foto;
        }
        function getFoto(){
            $pos = strpos($this->foto, "upload");
            return substr($this->foto, $pos);
        }
        function getPagina(){
            return $this->pagina;
        }

        function setCod_imagem($cod_imagem){
            $this->cod_imagem=$cod_imagem;
        }
        function setNome($nome){
            $this->nome=$nome;
        }
        function setFoto($foto){
            $this->foto=$foto;
        }
        function setPagina($pagina){
            $this->pagina=$pagina;
        }
        function getDsPagina(){
            $paginas=json_decode($this->pagina);
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
        function construct($nome,$foto,$pagina){
            $this->nome=$nome;
            $this->foto=$foto;
            $this->pagina=$pagina;
        }
        function show(){
            echo "Código da imagem:".$this->cod_imagem."<br>";
            echo "Nome:".$this->nome."<br>";
            echo "Foto:".$this->foto."<br>";
            echo "Página:".$this->pagina."<br>";

        }
    }
?>
