<?php

// ini_set("allow_url_include", true);
// include_once $_SERVER['DOCUMENT_ROOT']."/config.php";    
// include_once MODELPATH."/cardapio.php";

// class controlCarrinho{

//     private $pdo;

//     function __construct($pdo){

//         $this->pdo=$pdo;

//     }

//     public function index(){

//         if(isset($_SESSION['carrinho'])){
//             $itens = $_SESSION['carrinho'];
//         }
//         if(count($itens)){

//              $sql = "SELECT * FROM cardapio WHERE cod_cardapio IN (".implode(',', $itens).")";
//              $sql = $this->db->query($sql);
 
//              if($sql->rowCount() > 0){
//                  $produtos = $sql->fecthAll();
//              }
//              //return $produtos;
//         }else{
//             header("Location: ".HOMEPATH);
//         }

       
//     }


//     public function adicionarCarrinho($id = ""){
//         if(!empty($id)){
//             if(!isset($_SESSION['carrinho'])){
//                 $_SESSION['carrinho'] = array();
//             }

//             $_SESSION['carrinho'][] = $id;
//         }
//     }


// }


?>