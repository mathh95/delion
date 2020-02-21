<?php

//include_once ROOTPATH."/sistema/config.php";
//variáveis de CDN e diretórios
header("Content-type: text/html; charset=utf-8");
define('CSSBOOTSTRAP','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
define('CSSBOOTSTRAPIALOG','https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/css/bootstrap-dialog.min.css');
define('JSJQUERY','https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js');
define('JSBOOTSTRAPMIN','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
define('JSBOOTSTRAPDIALOG','https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/js/bootstrap-dialog.min.js');
define('JSALERT','../js/alert.js');
/*
 Função para gerar script JS para emitir mensagem de alerta.
 Exemplo de uso:
   alertJS("Olá mundo");
*/
function alertJS($msg) {
	
	$html = "<head>";
    $html = $html."<link rel='stylesheet' href='".CSSBOOTSTRAP."'>
        <link href='".CSSBOOTSTRAPIALOG."' rel='stylesheet' type='text/css' />
  ";
    $html = $html."
        <script src='".JSJQUERY."' type='text/javascript'></script>
        <script src='".JSBOOTSTRAPMIN."'></script>
        <script src='".JSBOOTSTRAPDIALOG."'></script>
        <script src='".JSALERT."'></script>
"; 
    $html = $html."</head>";
	$html = $html."<body>";
    $html = $html."<script >
			msgGenerico('Informação','".$msg."',0,function(){});
		</script>";
    $html = $html."</body>";

	echo utf8_decode(utf8_encode($html));
	
}

/*
 Função para gerar script JS para emitir mensagem de alerta e logo apos o usuario fechar a caixa de dialogo a pagina onde ele esta é fechado.
 ATENÇÃO: ESTA FUNÇÃO FUNCIONA SOMENTE COM ABAS QUE FORAM ABERTAS PELO PRÓPRIO JAVASCRIPT. "Scripts may close only the windows that were opened by it."
 Exemplo de uso:
   alertJSFecharPagina("Olá mundo");
*/
function alertJSFecharPagina($msg) {
	
	$html = "<head>";
    $html = $html."<link rel='stylesheet' href='".CSSBOOTSTRAP."'>
        <link href='".CSSBOOTSTRAPIALOG."' rel='stylesheet' type='text/css' />
  ";
    $html = $html."
        <script src='".JSJQUERY."' type='text/javascript'></script>
        <script src='".JSBOOTSTRAPMIN."'></script>
        <script src='".JSBOOTSTRAPDIALOG."'></script>
        <script src='".JSALERT."'></script>
"; 
    $html = $html."</head>";
	$html = $html."<body>";
    $html = $html."<script >
			msgGenerico('Informação','".$msg."',0,function(){ window.close();  });
		</script>";
    $html = $html."</body>";

	echo utf8_decode(utf8_encode($html));
	
}

/*
 Função para gerar script JS para emitir mensagem de alerta e,
 após o alerta, volta à página anterior.
 Parâmetros: 
            -Título da janela
            -Mensagem 
            -Tipo de mensagem:
                0-informação (azul: type-primary)
                1-sucesso (verde: type-success)
                2-erro (vermelho: type-danger). 
 Exemplo de uso:
   alertJSVoltarPagina("Olá mundo");
*/
function alertJSVoltarPagina($titulo,$msg,$tipo) {
	
	$html = "<head>";
    $html = $html."<link rel='stylesheet' href='".CSSBOOTSTRAP."'>
        <link href='".CSSBOOTSTRAPIALOG."' rel='stylesheet' type='text/css' />
  ";
    $html = $html."
        <script src='".JSJQUERY."' type='text/javascript'></script>
        <script src='".JSBOOTSTRAPMIN."'></script>
        <script src='".JSBOOTSTRAPDIALOG."'></script>
        <script src='".JSALERT."'></script>
"; 
    $html = $html."</head>";
	$html = $html."<body>";
    $html = $html."<script >
            msgVoltar('Informação','".$msg."',$tipo);
             </script>";
    $html = $html."</body>";
    
    echo utf8_decode(utf8_encode($html));
}

/*
 Função para gerar script JS para emitir mensagem de alerta e,
 após o alerta, ir para uma nova página
 Exemplo de uso:
   msgRedireciona("Olá mundo", "home.php");
*/
function msgRedireciona($titulo,$msg,$tipo,$pagina) {
	
	$html = "<head>";
    $html = $html."<link rel='stylesheet' href='".CSSBOOTSTRAP."'>
        <link href='".CSSBOOTSTRAPIALOG."' rel='stylesheet' type='text/css' />
  ";
    $html = $html."
        <script src='".JSJQUERY."' type='text/javascript'></script>
        <script src='".JSBOOTSTRAPMIN."'></script>
        <script src='".JSBOOTSTRAPDIALOG."'></script>
        <script src='".JSALERT."'></script>
"; 
    $html = $html."</head>";
	$html = $html."<body>";
    $html = $html."<script >
			msgRedireciona('".$titulo."','".$msg."',$tipo,'".$pagina."');
        ";
        $html = $html." setTimeout(function () {
            window.location.href = '".$pagina."';
         }, 700);
         </script>";
    $html = $html."</body>";

    echo utf8_decode(utf8_encode($html));
}
?>