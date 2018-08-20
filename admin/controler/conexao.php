<?php
    include_once "banco.php";

    function conecta(){
        $bd= new banco();
        try {
            $pdo = new PDO( 'mysql:host=' .$bd->getHost(). ';dbname=' .$bd->getDBname(). ';port=' ."3306". ';charset=utf8', $bd->getUser(), $bd->getPassword(), [ 
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false ]);
            set_time_limit(0);
            return $pdo;
        }catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function desconectar($pdo) {
      	$pdo=null;
    }

    function executaDDL($sql){
        try {
            $stmt = $pdo->query($sql);
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            print "Error!: " . $pdo->errorInfo() . "<br/>";
            die();
        }
    }
    function executaDQL($sql,$pdo){
        try {
            $stmt = $pdo->query($sql);
            return $stmt;
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            print "Error!: " . $pdo->errorInfo() . "<br/>";
            die();
        }
    }

    function sqlVerificarInjection($valor) {
      	return addslashes(htmlspecialchars($valor));
    }
?>