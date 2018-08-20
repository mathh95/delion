<?php

/**
 * Created by PhpStorm.
 * User: Tadashi
 * Date: 26/06/14
 * Time: 09:36
 */
class BannerMapper
{
    static public function get_by_location($location)
    {

        if (Session::get('lang') == 'es') {
            $banner = 'banner_esp';
        }else if(Session::get('lang') == 'en'){
            $banner = 'banner_ing';
        }else{
            $banner = 'banner';
        }

        $sql = "SELECT      B.nome,
                            B.link,
                            ( SELECT  foto_gd
                              FROM    foto F
                              WHERE   B.cod_banner = F.codigo
                                      AND
                                      tabela = \"{$banner}\"
                              LIMIT   1) foto
                FROM        banner B
                WHERE       B.tipo = \"{$location}\"
                ORDER BY    cod_banner DESC
                LIMIT       6";

        return $sql;
    }
}