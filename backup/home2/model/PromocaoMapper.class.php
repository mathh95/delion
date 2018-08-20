<?php

/**
 * Created by PhpStorm.
 * User: Tadashi
 * Date: 24/09/14
 * Time: 09:32
 */
class PromocaoMapper
{

    static public function get($cod_promocao = null)
    {
        $sql = self::get_bind();

        if($cod_promocao){
            $sql .= "WHERE      cod_promocao = {$cod_promocao}
                                ";
        }else{
            $sql.=" ORDER BY    cod_promocao DESC";
        }
		
		//echo $sql;

        return $sql;
    }

   

    static public function get_bind()
    {

        

        $sql = "SELECT  P.cod_promocao,
                        P.nome,
                        P.descricao,
                        ( SELECT    foto_gd
                          FROM      foto F
                          WHERE     F.codigo = P.cod_promocao
                                    AND
                                    tabela = 'promocao'
                          ORDER BY  cod_foto DESC
                          LIMIT     1) foto
                FROM    promocao P ";

        return $sql;
    }
}