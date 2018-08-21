<?php
session_start();
$_SESSION['quantidadeCarrinho'] = 0;

header("Location: /home");

?>