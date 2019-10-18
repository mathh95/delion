<?php
    session_start();

    /**
     * Página responsável por alterar a forma de pagamento 
     */

    $obs = $_POST['obs'];

    $_SESSION['observacao'] = $obs;


?>