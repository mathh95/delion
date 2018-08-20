<?php

/**

 * Classe de identificação do Banco de Dados

 */

    class banco {

        private $host='localhost';

        private $dbname='delioncafe';

        private $user='root';

        private $password='';



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

     /*class banco {

        private $host='localhost';

        private $dbname='c39delioncafe';

        private $user='c39delioncafe';

        private $password='D3l1onC4f3!';



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

    }*/

?>

