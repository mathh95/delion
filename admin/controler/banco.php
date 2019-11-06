<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 

/**

 * Classe de identificação do Banco de Dados

 */

    class banco {

        private $host = DB_HOST;

        private $dbname = DB_NAME;

        private $user = DB_USER;

        private $password = DB_PASS;

        function getHost(){

            return $this->host;

        }

        function getDBname(){

            return $this->dbname;

        }

        function getUser(){

            return $this->user;

        }

        function getPassword(){

            return $this->password;

        }

        function __construct(){ }

    }

?>

