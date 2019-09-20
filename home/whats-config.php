<?php
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");

    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");

    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");

    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");



    $local =  ($iphone || $android || $palmpre || $ipod || $berry == true) ? 'https://api.whatsapp.com/send?phone=55'.$empresa->getWhats().'' : 'https://web.whatsapp.com/send?phone=55'.$empresa->getWhats().'';
?>