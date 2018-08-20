<?php

/**
 * User: Thiago Tadashi
 * Date: 04/02/14
 * Project: sistema_banco
 * File: Session.class.php
 */
class Session
{
    static public function star_session()
    {
        session_name('sousallantas');
        session_start();
    }

    static public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    static public function get($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return false;
        }
    }

    static public function finish_session()
    {
        $_SESSION = array();
        session_destroy();
    }
}