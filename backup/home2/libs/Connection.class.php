<?php

/**
 * Date: 30/04/13
 * Time: 14:26
 */
class Connection
{
    public function __construct()
    {
    }

    static public function get()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_BASE;

        return new PDO($dsn, DB_USER, DB_PASSWORD, array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
    }

}