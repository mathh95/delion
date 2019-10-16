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
        private $flag_servindo;
        private $prioridade;
        private $delivery;
        private $adicional;
        private $dias_semana;
        private $cardapio_turno;
        private $cardapio_horas_inicio;
        private $cardapio_horas_final;
        private $posicao;


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
        function getFlag_servindo(){
            return $this->flag_servindo;
        }
        function getAdicional(){
            return $this->adicional;
        }
        function getDias_semana(){
            return $this->dias_semana;
        }
        function getCardapio_turno(){
            return $this->cardapio_turno;
        }

        function getCardapio_horas_inicio(){
            return $this->cardapio_horas_inicio;
        }

        function getCardapio_horas_final(){
            return $this->cardapio_horas_final;
        }

        function getPosicao(){
            return $this->posicao;
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
        function setFlag_servindo($flag_servindo){
            $this->flag_servindo=$flag_servindo;
        }
        function setAdicional($adicional){
            $this->adicional=$adicional;
        }

        function setDias_semana($dias_semana){
            $this->dias_semana=$dias_semana;
        }
        
        function setCardapio_turno($cardapio_turno){
            $this->cardapio_turno=$cardapio_turno;
        }
        
        function setCardapio_horas_inicio($cardapio_horas_inicio){
            $this->cardapio_horas_inicio=$cardapio_horas_inicio;
        }
        
        function setCardapio_horas_final($cardapio_horas_final){
            $this->cardapio_horas_final=$cardapio_horas_final;
        }
        
        function setPosicao($posicao){
            $this->posicao=$posicao;
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

        function getDsPausado(){
            $flag_servindo = ($this->flag_servindo == 1)? "Item em produção" : "Item pausado";
            return $flag_servindo;
        }

        function __construct(){
        }
        function construct($nome,$preco,$desconto,$descricao,$foto,$categoria,$flag_ativo,$flag_servindo,$prioridade,$delivery, $adicional, $dias_semana, $cardapio_turno, $cardapio_horas_inicio, $cardapio_horas_final){
            $this->nome=$nome;
            $this->preco = $preco;
            $this->desconto = $desconto;
            $this->descricao=$descricao;
            $this->foto=$foto;
            $this->categoria=$categoria;
            $this->flag_ativo=$flag_ativo;
            $this->flag_servindo=$flag_servindo;
            $this->prioridade=$prioridade;
            $this->delivery=$delivery;
            $this->adicional=$adicional;
            $this->dias_semana=$dias_semana;
            $this->cardapio_turno=$cardapio_turno;
            $this->cardapio_horas_inicio=$cardapio_horas_inicio;
            $this->cardapio_horas_final=$cardapio_horas_final;
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
            echo "Turnos da semana: ".$this->cardapio_turno."<br>";
            echo "Hora de Inicio do Turno: ".$this->cardapio_horas_inicio."<br>";
            echo "Hora de Fim do Turno: ".$this->cardapio_horas_final."<br>";

        }
    }
?>