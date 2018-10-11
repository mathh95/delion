<?php

    class itemAdicional{

        private $cod_item_adicional;

        private $cod_item_combo;

        private $cod_adicional;

        function getCod_item_adicional(){
            return $this->cod_item_adicional;
        }

        function getCod_item_combo(){
            return $this->cod_item_combo;
        }

        function getCod_adicional(){
            return $this->cod_adicional;
        }

        function setCod_item_adicional($cod_item_adicional){
            $this->cod_item_adicional = $cod_item_adicional;
        }

        function setCod_item_combo($cod_item_combo){
            $this->cod_item_combo = $cod_item_combo;
        }

        function setCod_adicional($cod_adicional){
            $this->cod_adicional = $cod_adicional;
        }

        function __construct(){}

        function construc($cod_item_combo, $cod_adicional){
            $this->cod_item_combo = $cod_item_combo;
            $this->cod_adicional = $cod_adicional;
        }
    }

?>