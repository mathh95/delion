<?php
/**
 *Classe de definição de empresa
 */
    class empresa {

        private $cod_empresa;
        private $nome;
        private $descricao;
        private $historia;
        private $endereco;
        private $bairro;
        private $cidade;
        private $estado;
        private $cep;
        private $fone;
        private $whats;
        private $email;
        private $facebook;
        private $instagram;
        private $pinterest;
        private $foto;
        private $dias_semana;
        private $horario_semana;
        private $dias_fim_semana;
        private $horario_fim_semana;


        function getCod_empresa(){
            return $this->cod_empresa;
        }
        function getNome(){
            return $this->nome;
        }
        function getDescricao(){
            return $this->descricao;
        }
        function getHistoria(){
            return $this->historia;
        }
        function getEndereco(){
            return $this->endereco;
        }
        function getBairro(){
            return $this->bairro;
        }
        function getCidade(){
            return $this->cidade;
        }
        function getEstado(){
            return $this->estado;
        }
        function getCep(){
            return $this->cep;
        }
        function getFone(){
            return $this->fone;
        }
        function getWhats(){
            return $this->whats;
        }
        function getEmail(){
            return $this->email;
        }
        function getFacebook(){
            $str = $this->facebook;
            $str = str_replace("https://", "", $str);
            $str = str_replace("http://", "",$str);
            return $str;
        }
        function getInstagram(){
            $str = $this->instagram;
            $str = str_replace("https://", "", $str);
            $str = str_replace("http://", "", $str);
            return $str;
        }
        function getPinterest(){
            $str = $this->pinterest;
            $str = str_replace("https://", "", $str);
            $str = str_replace("http://", "", $str);
            return $str;
        }
        function getFotoAbsoluto(){
            return $this->foto;
        }
        function getFoto(){
            $pos = strpos($this->foto, "upload");
            return substr($this->foto, $pos);
        }
        function getDiasSemana(){
            return $this->dias_semana;
        }
        function getHorarioSemana(){
            return $this->horario_semana;
        }
        function getDiasFimSemana(){
            return $this->dias_fim_semana;
        }
        function getHorarioFimSemana(){
            return $this->horario_fim_semana;
        }



        function setCod_empresa($cod_empresa){
            $this->cod_empresa=$cod_empresa;
        }
        function setNome($nome){
            $this->nome=$nome;
        }
        function setDescricao($descricao){
            $this->descricao=$descricao;
        }
        function setHistoria($historia){
            $this->historia=$historia;
        }
        function setEndereco($endereco){
            $this->endereco=$endereco;
        }
        function setBairro($bairro){
            $this->bairro=$bairro;
        }
        function setCidade($cidade){
            $this->cidade=$cidade;
        }
        function setEstado($estado){
            $this->estado=$estado;
        }
        function setCep($cep){
            $this->cep=$cep;
        }
        function setFone($fone){
            $this->fone=$fone;
        }
        function setWhats($whats){
            $this->whats=$whats;
        }
        function setEmail($email){
            $this->email=$email;
        }
        function setFacebook($facebook){
            $this->facebook=$facebook;
        }
        function setInstagram($instagram){
            $this->instagram=$instagram;
        }
        function setPinterest($pinterest){
            $this->pinterest=$pinterest;
        }
        function setFoto($foto){
            $this->foto=$foto;
        }
        function setDiasSemana($dias_semana){
            $this->dias_semana=$dias_semana;
        }
        function setHorarioSemana($horario_semana){
            $this->horario_semana=$horario_semana;
        }
        function setDiasFimSemana($dias_fim_semana){
            $this->dias_fim_semana=$dias_fim_semana;
        }
        function setHorarioFimSemana($horario_fim_semana){
            $this->horario_fim_semana=$horario_fim_semana;
        }

        function __construct(){
        }

        function construct($nome,$descricao,$historia,$endereco,$bairro,$cidade,$estado,$cep,$fone,$whats,$email,$facebook,$instagram,$pinterest,$foto, $dias_semana, $horario_semana,  $dias_fim_semana, $horario_fim_semana){
            $this->nome=$nome;
            $this->descricao=$descricao;
            $this->historia=$historia;
            $this->endereco=$endereco;
            $this->bairro=$bairro;
            $this->cidade=$cidade;
            $this->estado=$estado;
            $this->cep=$cep;
            $this->fone=$fone;
            $this->whats=$whats;
            $this->email=$email;
            $this->facebook=$facebook;
            $this->instagram=$instagram;
            $this->pinterest=$pinterest;
            $this->foto=$foto;
            $this->dias_semana=$dias_semana;
            $this->horario_semana=$horario_semana;
            $this->dias_fim_semana=$dias_fim_semana;
            $this->horario_fim_semana=$horario_fim_semana;
        }
        function show(){
            echo "Código do Empresa:".$this->cod_empresa."<br>";
            echo "Nome:".$this->nome."<br>";
            echo "Descrição:".$this->descricao."<br>";
            echo "História:".$this->historia."<br>";
            echo "Endereço:".$this->endereco."<br>";
            echo "Bairro:".$this->bairro."<br>";
            echo "Cidade:".$this->cidade."<br>";
            echo "Estado:".$this->estado."<br>";
            echo "Cep:".$this->cep."<br>";
            echo "Fone:".$this->fone."<br>";
            echo "Whats:".$this->whats."<br>";
            echo "E-mail:".$this->email."<br>";
            echo "Facebook:".$this->facebook."<br>";
            echo "Instagram:".$this->instagram."<br>";
            echo "Pinterest:".$this->pinterest."<br>";
            echo "Foto:".$this->foto."<br>";
        }
    }
?>