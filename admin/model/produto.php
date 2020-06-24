<?php
/**
 *Classe de definição de cardapio
 */
    class produto {

        private $pro_pk_id;
        private $pro_nome;
        private $pro_preco;
        private $pro_desconto;
        private $pro_descricao;
        private $pro_foto;
        private $pro_flag_deletado;
        private $pro_flag_ativo;
        private $pro_flag_servindo;
        private $pro_prioridade;
        private $pro_delivery;
        private $pro_adicional;
        private $pro_arr_dias_semana;
        private $pro_posicao;
        private $pro_categoria;
        private $pro_pts_resgate_fidelidade;
        private $pro_fk_fidelidade;
        
        //dependentes
        private $pro_numero_turnos;
        private $pro_arr_horas_inicio;
        private $pro_arr_horas_final;


        function getPkId(){
            return $this->pro_pk_id;
        }
        function getNome(){
            return $this->pro_nome;
        }
        function getPreco(){
            return $this->pro_preco;
        }
        function getDesconto(){
            return $this->pro_desconto;
        }
        function getDescricao(){
            return $this->pro_descricao;
        }
        function getFotoAbsoluto(){
            return $this->pro_foto;
        }
        function getFoto(){
            $pos = strpos($this->pro_foto, "upload");
            return substr($this->pro_foto, $pos);
        }
        function getCategoria(){
            return $this->pro_categoria;
        }
        function getFlag_deletado(){
            return $this->pro_flag_deletado;
        }
        function getFlag_ativo(){
            return $this->pro_flag_ativo;
        }
        function getPrioridade(){
            return $this->pro_prioridade;
        }
        function getDelivery(){
            return $this->pro_delivery;
        }
        function getFlag_servindo(){
            return $this->pro_flag_servindo;
        }
        function getAdicional(){
            return $this->pro_adicional;
        }
        function getDias_semana(){
            return $this->pro_arr_dias_semana;
        }

        function getNumeroTurnos(){
            return $this->pro_numero_turnos;
        }

        function getProduto_horas_inicio(){
            return $this->pro_arr_horas_inicio;
        }

        function getProduto_horas_final(){
            return $this->pro_arr_horas_final;
        }

        function getPosicao(){
            return $this->pro_posicao;
        }


        function getPtsResgateFidelidade(){
            return $this->pro_pts_resgate_fidelidade;
        }

        function getFkFidelidade(){
            return $this->pro_fk_fidelidade;
        }


        

        function setPkId($pro_pk_id){
            $this->pro_pk_id=$pro_pk_id;
        }
        function setNome($pro_nome){
            $this->pro_nome=$pro_nome;
        }
        function setPreco($pro_preco){
            $this->pro_preco = $pro_preco;
        }
        function setDesconto($pro_desconto){
            $this->pro_desconto = $pro_desconto;
        }
        function setDescricao($pro_descricao){
            $this->pro_descricao=$pro_descricao;
        }
        function setFoto($pro_foto){
            $this->pro_foto=$pro_foto;
        }
        function setCategoria($pro_categoria){
            $this->pro_categoria=$pro_categoria;
        }
        function setFlag_deletado($pro_flag_deletado){
            $this->pro_flag_deletado=$pro_flag_deletado;
        }
        function setFlag_ativo($pro_flag_ativo){
            $this->pro_flag_ativo=$pro_flag_ativo;
        }
        function setPrioridade($pro_prioridade){
            $this->pro_prioridade=$pro_prioridade;
        }
        function setDelivery($pro_delivery){
            $this->pro_delivery=$pro_delivery;
        }
        function setFlag_servindo($pro_flag_servindo){
            $this->pro_flag_servindo=$pro_flag_servindo;
        }
        function setAdicional($pro_adicional){
            $this->pro_adicional=$pro_adicional;
        }

        function setDias_semana($pro_arr_dias_semana){
            $this->pro_arr_dias_semana=$pro_arr_dias_semana;
        }
        
        
        function setNumeroTurnos($pro_numero_turnos){
            $this->pro_numero_turnos=$pro_numero_turnos;
        }

        function setProduto_horas_inicio($pro_arr_horas_inicio){
            $this->pro_arr_horas_inicio=$pro_arr_horas_inicio;
        }
        
        function setProduto_horas_final($pro_arr_horas_final){
            $this->pro_arr_horas_final=$pro_arr_horas_final;
        }
        
        function setPosicao($pro_posicao){
            $this->pro_posicao=$pro_posicao;
        }

        function setPtsResgateFidelidade($pro_pts_resgate_fidelidade){
            $this->pro_pts_resgate_fidelidade=$pro_pts_resgate_fidelidade;
        }

        function setFkFidelidade($pro_fk_fidelidade){
            $this->pro_fk_fidelidade=$pro_fk_fidelidade;
        }


        function getDsAtivo(){
            $ativo = ($this->pro_flag_ativo == 1) ? "Ativo" : "Não ativo" ;
            return $ativo;
        }

        function getDsPrioridade(){
            $prioridade = ($this->pro_prioridade == 1)? "Prioritário" : "Não Prioritário";
            return $prioridade;
        }

        function getDsDelivery(){
            $delivery = ($this->pro_delivery == 1)? "Disponível" : "Não disponível";
            return $delivery;
        }

        function getDsPausado(){
            $flag_servindo = ($this->pro_flag_servindo == 1)? "Item em produção" : "Item pausado";
            return $flag_servindo;
        }

        function __construct(){
        }

        function construct($pro_nome, $pro_preco, $pro_desconto, $pro_descricao,$pro_foto, $pro_categoria, $pro_flag_ativo, $pro_flag_servindo,$pro_prioridade,$pro_delivery, $pro_adicional, $pro_arr_dias_semana, $pro_turno, $pro_arr_horas_inicio, $pro_arr_horas_final){
            $this->pro_nome=$pro_nome;
            $this->pro_preco=$pro_preco;
            $this->pro_desconto=$pro_desconto;
            $this->pro_descricao=$pro_descricao;
            $this->pro_foto=$pro_foto;
            $this->pro_categoria=$pro_categoria;
            $this->pro_flag_ativo=$pro_flag_ativo;
            $this->pro_flag_servindo=$pro_flag_servindo;
            $this->pro_prioridade=$pro_prioridade;
            $this->pro_delivery=$pro_delivery;
            $this->pro_adicional=$pro_adicional;
            $this->pro_arr_dias_semana=$pro_arr_dias_semana;
            
            $this->pro_turno=$pro_turno;
            $this->pro_arr_horas_inicio=$pro_arr_horas_inicio;
            $this->pro_arr_horas_final=$pro_arr_horas_final;
        }

        function constructFaixas($pro_nome, $pro_preco, $pro_desconto, $pro_descricao,$pro_foto, $pro_categoria, $pro_flag_deletado, $pro_flag_ativo, $pro_flag_servindo, $pro_prioridade, $pro_delivery, $pro_adicional, $pro_arr_dias_semana, $faho_numero_turnos=0, $faho_arr_horas_inicio=array(), $faho_arr_horas_final=array()){
            $this->pro_nome=$pro_nome;
            $this->pro_preco=$pro_preco;
            $this->pro_desconto=$pro_desconto;
            $this->pro_descricao=$pro_descricao;
            $this->pro_foto=$pro_foto;
            $this->pro_categoria=$pro_categoria;
            $this->pro_flag_deletado=$pro_flag_deletado;
            $this->pro_flag_ativo=$pro_flag_ativo;
            $this->pro_flag_servindo=$pro_flag_servindo;
            $this->pro_prioridade=$pro_prioridade;
            $this->pro_delivery=$pro_delivery;
            $this->pro_adicional=$pro_adicional;
            $this->pro_arr_dias_semana=$pro_arr_dias_semana;

            $this->pro_numero_turnos = $faho_numero_turnos;
            $this->pro_arr_horas_inicio = $faho_arr_horas_inicio;
            $this->pro_arr_horas_final = $faho_arr_horas_final;
        }


        function show(){
            echo "Código do cardapio:".$this->pro_pk_id."<br>";
            echo "Nome:".$this->pro_nome."<br>";
            echo "Preco: ".$this->pro_preco."<br>";
            echo "Descricao:".$this->pro_descricao."<br>";
            echo "Foto:".$this->pro_foto."<br>";
            echo "Categoria:".$this->pro_categoria."<br>";
            echo "Ativo:".$this->pro_flag_ativo."<br>";
            echo "Dias da semana: ".$this->pro_arr_dias_semana."<br>";
            echo "Turnos da semana: ".$this->pro_turno."<br>";
            echo "Hora de Inicio do Turno: ".$this->pro_arr_horas_inicio."<br>";
            echo "Hora de Fim do Turno: ".$this->pro_arr_horas_final."<br>";

        }
    }
?>