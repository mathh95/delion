<?php
  session_start(); // Inicia a sessão
  session_destroy(); // Destrói a sessão limpando todos os valores salvos
  header("Location: ../view/login.html"); exit; // Redireciona o visitante
?>