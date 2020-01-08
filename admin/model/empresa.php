<?php
/**
 *Classe de definição de empresa
 */
    class empresa {

        private $emp_pk_id;
        private $emp_nome;
        private $emp_descricao;
        private $emp_historia;
        private $emp_endereco;
        private $emp_bairro;
        private $emp_cidade;
        private $emp_estado;
        private $emp_cep;
        private $emp_fone;
        private $emp_whats;
        private $emp_email;
        private $emp_facebook;
        private $emp_instagram;
        private $emp_pinterest;
        private $emp_foto;
        private $emp_txt_dias_semana;
        private $emp_txt_horario_semana;
        private $emp_txt_dias_fim_semana;
        private $emp_txt_horario_fim_semana;
        private $emp_arr_dias_semana;
        private $emp_arr_horarios_inicio;
        private $emp_arr_horarios_final;
        private $emp_aberto;
        private $emp_entregando;
        private $emp_taxa_conversao_fidelidade;


        function getPkId(){
            return $this->emp_pk_id;
        }
        function getNome(){
            return $this->emp_nome;
        }
        function getDescricao(){
            return $this->emp_descricao;
        }
        function getHistoria(){
            return $this->emp_historia;
        }
        function getEndereco(){
            return $this->emp_endereco;
        }
        function getBairro(){
            return $this->emp_bairro;
        }
        function getCidade(){
            return $this->emp_cidade;
        }
        function getEstado(){
            return $this->emp_estado;
        }
        function getCep(){
            return $this->emp_cep;
        }
        function getFone(){
            return $this->emp_fone;
        }
        function getWhats(){
            return $this->emp_whats;
        }
        function getEmail(){
            return $this->emp_email;
        }
        function getFacebook(){
            $str = $this->emp_facebook;
            $str = str_replace("https://", "", $str);
            $str = str_replace("http://", "",$str);
            return $str;
        }
        function getInstagram(){
            $str = $this->emp_instagram;
            $str = str_replace("https://", "", $str);
            $str = str_replace("http://", "", $str);
            return $str;
        }
        function getPinterest(){
            $str = $this->emp_pinterest;
            $str = str_replace("https://", "", $str);
            $str = str_replace("http://", "", $str);
            return $str;
        }
        function getFotoAbsoluto(){
            return $this->emp_foto;
        }
        function getFoto(){
            $pos = strpos($this->emp_foto, "upload");
            return substr($this->emp_foto, $pos);
        }
        function getTxtDiasSemana(){
            return $this->emp_txt_dias_semana;
        }
        function getTxtHorarioSemana(){
            return $this->emp_txt_horario_semana;
        }
        function getTxtDiasFimSemana(){
            return $this->emp_txt_dias_fim_semana;
        }
        function getTxtHorarioFimSemana(){
            return $this->emp_txt_horario_fim_semana;
        }
        function getArrDiasSemana(){
            return $this->emp_arr_dias_semana;
        }
        function getArrHorariosInicio(){
            return $this->emp_arr_horarios_inicio;
        }
        function getArrHorariosFinal(){
            return $this->emp_arr_horarios_final;
        }
        function getAberto(){
            return $this->emp_aberto;
        }
        function getEntregando(){
            return $this->emp_entregando;
        }


        function setPkId($emp_pk_id){
            $this->emp_pk_id=$emp_pk_id;
        }
        function setNome($emp_nome){
            $this->emp_nome=$emp_nome;
        }
        function setDescricao($emp_descricao){
            $this->emp_descricao=$emp_descricao;
        }
        function setHistoria($emp_historia){
            $this->emp_historia=$emp_historia;
        }
        function setEndereco($emp_endereco){
            $this->emp_endereco=$emp_endereco;
        }
        function setBairro($emp_bairro){
            $this->emp_bairro=$emp_bairro;
        }
        function setCidade($emp_cidade){
            $this->emp_cidade=$emp_cidade;
        }
        function setEstado($emp_estado){
            $this->emp_estado=$emp_estado;
        }
        function setCep($emp_cep){
            $this->emp_cep=$emp_cep;
        }
        function setFone($emp_fone){
            $this->emp_fone=$emp_fone;
        }
        function setWhats($emp_whats){
            $this->emp_whats=$emp_whats;
        }
        function setEmail($emp_email){
            $this->emp_email=$emp_email;
        }
        function setFacebook($emp_facebook){
            $this->emp_facebook=$emp_facebook;
        }
        function setInstagram($emp_instagram){
            $this->emp_instagram=$emp_instagram;
        }
        function setPinterest($emp_pinterest){
            $this->emp_pinterest=$emp_pinterest;
        }
        function setFoto($emp_foto){
            $this->emp_foto=$emp_foto;
        }
        function setTxtDiasSemana($emp_txt_dias_semana){
            $this->emp_txt_dias_semana=$emp_txt_dias_semana;
        }
        function setTxtHorarioSemana($emp_txt_horario_semana){
            $this->emp_txt_horario_semana=$emp_txt_horario_semana;
        }
        function setTxtDiasFimSemana($emp_txt_dias_fim_semana){
            $this->emp_txt_dias_fim_semana=$emp_txt_dias_fim_semana;
        }
        function setTxtHorarioFimSemana($emp_txt_horario_fim_semana){
            $this->emp_txt_horario_fim_semana=$emp_txt_horario_fim_semana;
        }
        function setArrDiasSemana($emp_arr_dias_semana){
            $this->emp_arr_dias_semana=$emp_arr_dias_semana;
        }
        function setArrHorariosInicio($emp_arr_horarios_inicio){
            $this->emp_arr_horarios_inicio=$emp_arr_horarios_inicio;
        }
        function setArrHorariosFinal($emp_arr_horarios_final){
            $this->emp_arr_horarios_final=$emp_arr_horarios_final;
        }
        function setAberto($emp_aberto){
            $this->emp_aberto=$emp_aberto;
        }
        function setEntregando($emp_entregando){
            $this->emp_entregando=$emp_entregando;
        }
        function setTaxaConversaoFidelidade($emp_taxa_conversao_fidelidade){
            $this->emp_taxa_conversao_fidelidade=$emp_taxa_conversao_fidelidade;
        }

        function __construct(){
        }

        function construct($emp_nome, $emp_descricao, $emp_historia, $emp_endereco, $emp_bairro, $emp_cidade, $emp_estado, $emp_cep, $emp_fone ,$emp_whats ,$emp_email ,$emp_facebook ,$emp_instagram ,$emp_pinterest ,$emp_foto){
            $this->emp_nome=$emp_nome;
            $this->emp_descricao=$emp_descricao;
            $this->emp_historia=$emp_historia;
            $this->emp_endereco=$emp_endereco;
            $this->emp_bairro=$emp_bairro;
            $this->emp_cidade=$emp_cidade;
            $this->emp_estado=$emp_estado;
            $this->emp_cep=$emp_cep;
            $this->emp_fone=$emp_fone;
            $this->emp_whats=$emp_whats;
            $this->emp_email=$emp_email;
            $this->emp_facebook=$emp_facebook;
            $this->emp_instagram=$emp_instagram;
            $this->emp_pinterest=$emp_pinterest;
            $this->emp_foto=$emp_foto;
        }

        function constructFuncionamento($emp_dias_semana, $emp_horario_semana,  $emp_dias_fim_semana, $emp_horario_fim_semana, $emp_arr_dias_semana, $emp_arr_horarios_inicio, $emp_arr_horarios_final, $emp_aberto, $emp_entregando){
            $this->emp_dias_semana=$emp_dias_semana;
            $this->emp_horario_semana=$emp_horario_semana;
            $this->emp_dias_fim_semana=$emp_dias_fim_semana;
            $this->emp_horario_fim_semana=$emp_horario_fim_semana;
            $this->emp_arr_dias_semana=$emp_arr_dias_semana;
            $this->emp_arr_horarios_inicio=$emp_arr_horarios_inicio;
            $this->emp_arr_horarios_final=$emp_arr_horarios_final;
            $this->emp_aberto=$emp_aberto;
            $this->emp_entregando=$emp_entregando;
        }


        function show(){
            echo "Código do Empresa:".$this->emp_pk_id."<br>";
            echo "Nome:".$this->emp_nome."<br>";
            echo "Descrição:".$this->emp_descricao."<br>";
            echo "História:".$this->emp_historia."<br>";
            echo "Endereço:".$this->emp_endereco."<br>";
            echo "Bairro:".$this->emp_bairro."<br>";
            echo "Cidade:".$this->emp_cidade."<br>";
            echo "Estado:".$this->emp_estado."<br>";
            echo "Cep:".$this->emp_cep."<br>";
            echo "Fone:".$this->emp_fone."<br>";
            echo "Whats:".$this->emp_whats."<br>";
            echo "E-mail:".$this->emp_email."<br>";
            echo "Facebook:".$this->emp_facebook."<br>";
            echo "Instagram:".$this->emp_instagram."<br>";
            echo "Pinterest:".$this->emp_pinterest."<br>";
            echo "Foto:".$this->emp_foto."<br>";
        }
    }
?>