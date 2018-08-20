<?php



/**

 * Created by PhpStorm.

 * User: Tadashi

 * Date: 13/10/2014

 * Time: 15:28

 */

class CategoriaMapper

{

    static public function get($cod_categoria = null)

    {

        if ($cod_categoria) {

            $sql = "SELECT  C.cod_categoria,

                            nome,

                            slug, 
							
							F.foto_gd as logo,
							
							FB.foto_gd as foto_categoria

                    FROM    categoria C
							left join foto F on (F.tabela = 'categoria_icone' and F.codigo = C.cod_categoria )
							left join foto FB on (FB.tabela = 'categoria_banner' and FB.codigo = C.cod_categoria )

                    WHERE   C.cod_categoria = {$cod_categoria}
					
					order by C.nome
					";

        } else {

            $sql = "SELECT  C.cod_categoria,

                            nome,

                            slug, 
							
							F.foto_gd as logo,
							
							FB.foto_gd as foto_categoria

                    FROM    categoria C
							left join foto F on (F.tabela = 'categoria_icone' and F.codigo = C.cod_categoria )
							left join foto FB on (FB.tabela = 'categoria_banner' and FB.codigo = C.cod_categoria )
							
					order by C.nome		
					";

        }



        return $sql;

    }



    static public function get_subcategorias($cod_categoria)

    {

        $sql = "SELECT  cod_sub_categoria,

                        nome,

                        slug

                FROM    sub_categoria

                WHERE   cod_categoria = {$cod_categoria}";



        return $sql;

    }

}