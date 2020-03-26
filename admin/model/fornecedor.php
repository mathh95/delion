<?php
        /** 
         * Classe de definição do fornecedor
        */

            class fornecedor{

                private $for_pk_id;
                private $for_nome;
                private $for_cnpj;
                private $for_fone;
                private $for_qtd_dias_pgto;
                private $for_txt_endereco;
                private $for_end_ref;
                private $for_fk_tipo_fornecedor;

                function getPkId(){
                    return $this->for_pk_id;
                }

                function getNome(){
                    return $this->for_nome;
                }

                function getCnpj(){
                    return $this->for_cnpj;
                }

                function getFone(){
                    return $this->for_fone;
                }

                function getQtdDias(){
                    return $this->for_qtd_dias_pgto;
                }

                function getTxtEndereco(){
                    return $this->for_txt_endereco;
                }

                function getEndRef(){
                    return $this->for_end_ref;
                }

                function getPkTipoFornecedor(){
                    return $this->for_fk_tipo_fornecedor;
                }



                function setPkId($for_pk_id){
                    $this->for_pk_id=$for_pk_id;
                }

                function setNome($for_nome){
                    $this->for_nome=$for_nome;
                }

                function setCnpj($for_cnpj){
                    $this->for_cnpj=$for_cnpj;
                }

                function setFone($for_fone){
                    $this->for_fone=$for_fone;
                }

                function setQtdDias($for_qtd_dias_pgto){
                    $this->for_qtd_dias_pgto=$for_qtd_dias_pgto;
                }

                function setTxtEndereco($for_txt_endereco){
                    $this->for_txt_endereco=$for_txt_endereco;
                }

                function setEndRef($for_end_ref){
                    $this->for_end_ref=$for_end_ref;
                }

                function setPkTipoFornecedor($for_fk_tipo_fornecedor){
                    $this->for_fk_tipo_fornecedor=$for_fk_tipo_fornecedor;
                }


                function __construct(){ 
                    
                }

                function construct($for_nome, $for_cnpj, $for_fone, $for_qtd_dias_pgto, $for_txt_endereco, $for_end_ref, $for_fk_tipo_fornecedor){
                    $this->for_nome=$for_nome;
                    $this->for_cnpj=$for_cnpj;
                    $this->for_fone=$for_fone;
                    $this->for_qtd_dias_pgto=$for_qtd_dias_pgto;
                    $this->for_txt_endereco=$for_txt_endereco;
                    $this->for_end_ref=$for_end_ref;
                    $this->for_fk_tipo_fornecedor=$for_fk_tipo_fornecedor;
                }

                function show(){
                    echo "Código do Fornecedor: ".$this->for_pk_id."<br>";
                    echo "Nome: ".$this->for_nome."<br>";
                    echo "Cnpj: ".$this->for_cnpj."<br>";
                    echo "Telefone: ".$this->for_fone."<br>";
                    echo "Qtd dias Pgto: ".$this->for_qtd_dias_pgto."<br>";
                    echo "Endereço ".$this->for_txt_endereco."<br>";
                    echo "Referencia: ".$this->for_end_ref."<br>";
                    echo "Cod tipo fornecedor: ".$this->for_fk_tipo_fornecedor."<br>";
                }


            }

?>