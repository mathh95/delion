<?php
/**
 *Classe de definição de cardapio
 */
    class cardapio {

        private $cod_cardapio;
        private $nome;
        private $preco;
        private $descricao;
        private $foto;
        private $categoria;
        private $flag_ativo;
        private $prioridade;
        private $delivery;


        function getCod_cardapio(){
            return $this->cod_cardapio;
        }
        function getNome(){
            return $this->nome;
        }
        function getPreco(){
            return $this->preco;
        }
        function getDescricao(){
            return $this->descricao;
        }
        function getFotoAbsoluto(){
            return $this->foto;
        }
        function getFoto(){
            $pos = strpos($this->foto, "upload");
            return substr($this->foto, $pos);
        }
        function getCategoria(){
            return $this->categoria;
        }
        function getFlag_ativo(){
            return $this->flag_ativo;
        }
        function getPrioridade(){
            return $this->prioridade;
        }
        function getDelivery(){
            return $this->delivery;
        }

        function setCod_cardapio($cod_cardapio){
            $this->cod_cardapio=$cod_cardapio;
        }
        function setNome($nome){
            $this->nome=$nome;
        }
        function setPreco($preco){
            $this->preco = $preco;
        }
        function setDescricao($descricao){
            $this->descricao=$descricao;
        }
        function setFoto($foto){
            $this->foto=$foto;
        }
        function setCategoria($categoria){
            $this->categoria=$categoria;
        }
        function setFlag_ativo($flag_ativo){
            $this->flag_ativo=$flag_ativo;
        }
        function setPrioridade($prioridade){
            $this->prioridade=$prioridade;
        }
        function setDelivery($delivery){
            $this->delivery=$delivery;
        }

        function getDsAtivo(){
            $ativo = ($this->flag_ativo == 1) ? "Ativo" : "Não ativo" ;
            return $ativo;
        }

        function getDsPrioridade(){
            $prioridade = ($this->prioridade == 1)? "Prioritário" : "Não Prioritário";
            return $prioridade;
        }

        function getDsDelivery(){
            $delivery = ($this->delivery == 1)? "Disponível" : "Não disponível";
            return $delivery;
        }
        function __construct(){
        }
        function construct($nome,$preco,$descricao,$foto,$categoria,$flag_ativo,$prioridade,$delivery){
            $this->nome=$nome;
            $this->preco = $preco;
            $this->descricao=$descricao;
            $this->foto=$foto;
            $this->categoria=$categoria;
            $this->flag_ativo=$flag_ativo;
            $this->prioridade=$prioridade;
            $this->delivery=$delivery;
        }
        function show(){
            echo "Código do cardapio:".$this->cod_cardapio."<br>";
            echo "Nome:".$this->nome."<br>";
            echo "Preco: ".$this->preco."<br>";
            echo "Descricao:".$this->descricao."<br>";
            echo "Foto:".$this->foto."<br>";
            echo "Categoria:".$this->categoria."<br>";
            echo "Ativo:".$this->flag_ativo."<br>";

        }
    }
?>