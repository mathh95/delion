<?php
    session_start();

    /**
     * Página responsável por alterar a forma de pagamento 
     */

    $pag = $_POST['pag'];

    $_SESSION['formaPagamento'] = $pag;


?>