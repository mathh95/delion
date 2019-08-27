<?php
/**
 *Classe de definição de cardapio
 */
    class cardapio {

        private $cod_cardapio;
        private $nome;
        private $preco;
        private $desconto;
        private $descricao;
        private $foto;
        private $categoria;
        private $flag_ativo;
        private $prioridade;
        private $delivery;
        private $adicional;
        private $dias_semana;
        private $turnos_semana;


        function getCod_cardapio(){
            return $this->cod_cardapio;
        }
        function getNome(){
            return $this->nome;
        }
        function getPreco(){
            return $this->preco;
        }
        function getDesconto(){
            return $this->desconto;
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
        function getAdicional(){
            return $this->adicional;
        }
        function getDias_semana(){
            return $this->dias_semana;
        }
        function getTurnos_semana(){
            return $this->turnos_semana;
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
        function setDesconto($desconto){
            $this->desconto = $desconto;
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
        function setAdicional($adicional){
            $this->adicional=$adicional;
        }

        function setDias_semana($dias_semana){
            $this->dias_semana=$dias_semana;
        }

        function setTurnos_semana($turnos_semana){
            $this->turnos_semana=$turnos_semana;
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
        function construct($nome,$preco,$desconto,$descricao,$foto,$categoria,$flag_ativo,$prioridade,$delivery, $adicional, $dias_semana, $turnos_semana){
            $this->nome=$nome;
            $this->preco = $preco;
            $this->desconto = $desconto;
            $this->descricao=$descricao;
            $this->foto=$foto;
            $this->categoria=$categoria;
            $this->flag_ativo=$flag_ativo;
            $this->prioridade=$prioridade;
            $this->delivery=$delivery;
            $this->adicional=$adicional;
            $this->dias_semana=$dias_semana;
            $this->turnos_semana=$turnos_semana;
        }
        function show(){
            echo "Código do cardapio:".$this->cod_cardapio."<br>";
            echo "Nome:".$this->nome."<br>";
            echo "Preco: ".$this->preco."<br>";
            echo "Descricao:".$this->descricao."<br>";
            echo "Foto:".$this->foto."<br>";
            echo "Categoria:".$this->categoria."<br>";
            echo "Ativo:".$this->flag_ativo."<br>";
            echo "Dias da semana: ".$this->dias_semana."<br>";
            echo "Turnos da semana: ".$this->turnos_semana."<br>";

        }
    }
?>