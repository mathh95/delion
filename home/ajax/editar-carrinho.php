<?php

session_start();


var_dump($_GET['obs_editado']);
var_dump($_GET['obs_id']);

var_dump(!empty($_GET['obs_editado']));
var_dump(isset($_GET['obs_editado']));
var_dump(isset($_GET['obs_id']));
// var_dump(!empty($_GET['obs_id']));
if(isset($_GET['obs_editado']) && !empty($_GET['obs_editado']) 
    && isset($_GET['obs_id'])){

    $obs_id = $_GET['obs_id'];
    $obs_edit = $_GET['obs_editado'];

    $_SESSION['observacao'][$obs_id] = $obs_edit;
}




?>