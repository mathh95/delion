<?php

/**
 * Created by PhpStorm.
 * User: Tadashi
 * Date: 05/06/14
 * Time: 09:29
 */
class Lang
{
    static $si;

    static public function _t_si($index, $lang = null)
    {

        if ($lang == null) {
            if (Session::get('lang')) {
                $lang = Session::get('lang');
            } else {
                $lang = 'pt-br';
            }
        }

        if (empty(self::$si)) {

            $c = include "lang/{$lang}/si.php";

            self::$si = $si;
        }

        if(isset(self::$si[$index])){
            return self::$si[$index];
        }else{
            return $index;
        }
    }

}
