<?php
/**
 *Classe de definição de banner
 */
    class banner {

        private $cod_banner;
        private $nome;
        private $link;
        // private $legenda;
        private $flag_tamanho;
        private $foto;
        private $pagina;


        function getCod_banner(){
            return $this->cod_banner;
        }
        function getNome(){
            return $this->nome;
        }
        function getLink(){
            return $this->link;
        }
        /*function getLegenda(){
            return $this->legenda;
        }*/
        function getFlag_tamanho(){
            return $this->flag_tamanho;
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

        function setCod_banner($cod_banner){
            $this->cod_banner=$cod_banner;
        }
        function setNome($nome){
            $this->nome=$nome;
        }
        function setLink($link){
            $this->link=$link;
        }
        /*function setLegenda($legenda){
            $this->legenda=$legenda;
        }*/
        function setFlag_tamanho($flag_tamanho){
            $this->flag_tamanho=$flag_tamanho;
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
        function construct($nome,$link/*,$legenda*/,$flag_tamanho,$foto,$pagina){
            $this->nome=$nome;
            $this->link=$link;
            // $this->legenda=$legenda;
            $this->flag_tamanho=$flag_tamanho;
            $this->foto=$foto;
            $this->pagina=$pagina;
        }
        function show(){
            echo "Código do banner:".$this->cod_banner."<br>";
            echo "Nome:".$this->nome."<br>";
            echo "Link:".$this->link."<br>";
            // echo "Legenda:".$this->legenda."<br>";
            echo "Flag tamanho:".$this->flag_tamanho."<br>";
            echo "Foto:".$this->foto."<br>";
            echo "Página:".$this->pagina."<br>";

        }
    }
?>
