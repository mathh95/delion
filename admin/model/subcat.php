<?php
    /**
     * 
     * Classe de definição da subcategoria
     * 
     */

    class subcat {

        private $sub_cat_pk_id;
        private $sub_cat_nome;
        private $sub_cat_icone;
        private $sub_cat_fk_cat;
        
        function getPkId(){
            return $this->sub_cat_pk_id;
        }

        function getNome(){
            return $this->sub_cat_nome;
        }

        function getIconeAbsoluto(){
            return $this->sub_cat_icone;
        }

        function getIcone(){
            $pos = strpos($this->sub_cat_icone, "upload");
            return substr($this->sub_cat_icone, $pos);
        }

        function getFkcategoria(){
            return $this->sub_cat_fk_cat;
        }

        function setPkId($sub_cat_pk_id){
            $this->sub_cat_pk_id=$sub_cat_pk_id;
        }

        function setNome($sub_cat_nome){
            $this->sub_cat_nome=$sub_cat_nome;
        }

        function setIcone($sub_cat_icone){
            $this->sub_cat_icone=$sub_cat_icone;
        }

        function setFkCategoria($sub_cat_fk_cat){
            $this->sub_cat_fk_cat=$sub_cat_fk_cat;
        }

        function __construct(){

        }

        function construct($sub_cat_nome, $sub_cat_icone, $sub_cat_fk_cat){
            $this->sub_cat_nome=$sub_cat_nome;
            $this->sub_cat_icone=$sub_cat_icone;
            $this->sub_cat_fk_cat=$sub_cat_fk_cat;
        }

        function show(){
            echo "Código da Subcategoria:".$this->sub_cat_pk_id."<br>";
            echo "Nome:".$this->sub_cat_nome."<br>";
            echo "Icone:".$this->sub_cat_icone."<br>";
            echo "Categoria Associada:".$this->sub_cat_fk_cat."<br>"; 
        }


    }

?>