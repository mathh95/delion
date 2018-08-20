<?php

/**
 * Created by PhpStorm.
 * User: Tadashi
 * Date: 25/09/2014
 * Time: 14:36
 */
class FaqMapper
{
    static public function get()
    {
        $sql = "SELECT  pergunta,
                        resposta
                FROM    faq";

        return $sql;
    }
}