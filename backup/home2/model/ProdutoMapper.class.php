<?php

/**
 * Created by PhpStorm.
 * User: Tadashi
 * Date: 24/09/14
 * Time: 09:32
 */
class ProdutoMapper
{
    static public function get_images($cod_produto)
    {
        $sql = "SELECT    foto_pq,
                          foto_md,
                          foto_gd
                FROM      foto
                WHERE     codigo = {$cod_produto}
                          AND
                          tabela = 'produto'
                ORDER By  cod_foto";

        return $sql;
    }

    static public function get($cod_produto = null)
    {
        $sql = self::get_bind();

        if($cod_produto){
            $sql .= "WHERE      cod_produto = {$cod_produto}
                                ";
        }else{
            $sql.=" ORDER BY    cod_produto DESC";
        }

        return $sql;
    }

    static public function get_by_search($busca)
    {
        $sql = self::get_bind();

        $sql .= "WHERE      (
                                P.nome LIKE \"%{$busca}%\"
                                
                            ) and flag_ativo = 1
                            
                 ORDER BY   cod_produto DESC";

        return $sql;
    }

    static public function get_by_marca($cod_marca)
    {
        $sql = self::get_bind();

        $sql .= "WHERE      cod_marca = {$cod_marca} and flag_ativo = 1
                            
                 ORDER BY   cod_produto DESC";

        return $sql;
    }

    static public function get_destaque()
    {
        $sql = self::get_bind();

        $sql .= "WHERE      flag_destaque = 1 and flag_ativo = 1
                            
                 ORDER BY RAND() 
				 
				 limit 3
				 ";

        return $sql;
    }

    

    static public function get_by_categoria($cod_categoria)
    {
        $sql = self::get_bind();

        $sql .= "WHERE      cod_categoria = {$cod_categoria} and flag_ativo = 1
                            
                 ORDER BY   cod_produto DESC";

        return $sql;
    }

    static public function get_bind()
    {

        if (Session::get('lang') == 'es') {
            $nome = 'nome_esp';
            $descricao_resu = 'descricao_resumida_esp';
            $descricao = 'descricao_esp';
        } else if (Session::get('lang') == 'en') {
            $nome = 'nome_ing';
            $descricao_resu = 'descricao_resumida_ing';
            $descricao = 'descricao_ing';
        } else {
            $nome = 'nome';
            $descricao_resu = 'descricao_resumida';
            $descricao = 'descricao';
        }

        $sql = "SELECT  P.*, P.cod_produto,
                        P.{$nome} nome,
                        P.{$descricao} descricao,
                        P.{$descricao_resu} descricao_resumida,
                        P.valor,
                        P.flag_mostrar_preco,
                        P.slug,
                        ( SELECT    foto_gd
                          FROM      foto F
                          WHERE     F.codigo = P.cod_produto
                                    AND
                                    tabela = 'produto'
                          ORDER BY  cod_foto DESC
                          LIMIT     1) foto
                FROM    produto P ";

        return $sql;
    }
}
