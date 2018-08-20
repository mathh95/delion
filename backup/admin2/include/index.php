<?

$caminho_root = ROOTPATH . "/admin/";
  
//Incluem as variaveis de conex�o
include($caminho_root. "config.inc.php");

//Prepara a sess�o a ser feita
session_start();

if (isset($_SESSION['logado'])) {

	if ($_SESSION['logado']){
	
		if ($pagina) {
						
			
			header("Location: $_SERVER[HTTP_HOST]$pagina");
		
		} else {
		
			header("Location: interna.php");
			
		}
	
	}
}

?>

<title><? echo $nome_empresa?></title>
<link href="../css/fontes.css" rel="stylesheet" type="text/css">
<script> 
function submitForm(){

if (window.event)
     key = window.event.keyCode;
else if (e)
     key = e.which;
else
     return true;

if (key==13)
	document.forms[0].submit();
	
}
</script>
<body background="../img/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><img src="../img/spacer.gif" width="5" height="55"></td>
  </tr>
  <tr>
    <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr> 
          <td height="28" background="../img/cantobg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="18"><img src="../img/canto1.jpg" width="10" height="28"></td>
                <td width="350" class="titulo"><strong>WEBADMIN KIONUX V.3.0 .::. Gerenciador de Conte&uacute;dos</strong></td>
                <td class="texto"> <div align="right"> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td height="1" colspan="3"><img src="../img/spacer.gif" width="5" height="5"></td>
                      </tr>
                      <tr> 
                        <td class="texto"> <div align="right"> 
                            <script language="JavaScript" src="../scripts/date2.js"></script>
                          </div></td>
                        <td width="20" class="texto"> <div align="center"><img src="../img/relogio.gif" width="10" height="10"></div></td>

                      </tr>
                    </table>
                  </div></td>
                <td width="2"> 
                  <div align="right"><img src="../img/canto3.jpg" width="17" height="28"></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="68">
            <? include("topo2.php"); ?>
          </td>
        </tr>
        <tr> 
          <td height="11"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="1" height="11"><img src="../img/sombra1.jpg" width="10" height="11"></td>
                <td height="11" background="../img/sombra2.jpg"><img src="../img/sombra2.jpg" width="3" height="11"></td>
                <td width="1" height="11"> <div align="right"><img src="../img/sombra3.jpg" width="8" height="11"></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="1" background="../img/bg1.jpg"><img src="../img/bg1.jpg" width="10" height="11"></td>
                <td valign="top">
				<div align="center"><span class="texto"><font color="#CC0000"> 
				<? 
				 if (count($_GET) > 0) {
					 if ($_GET['msg'] == 1)
					 {
						echo "<img src=\"/img/layout/err.gif\" width=\"15\" height=\"12\" align=\"absmiddle\"> Login Inv�lido";
					 }
					 if ($_GET['msg'] == 2)
					 {
						echo "<img src=\"/img/layout/err.gif\" width=\"15\" height=\"12\" align=\"absmiddle\"> Senha incorreta.<br>Tente novamente. ";
					 }
					 if ($_GET['msg'] == 3)
					 {
						echo "<img src=\"/img/layout/err.gif\" width=\"15\" height=\"12\" align=\"absmiddle\"> Sua sess�o expirou, isso acontece quando o usu�rio fica inativo por 1 hora.";
					 }
					 if ($_GET['msg'] == 4)
					 {
						echo "Logout efetuado com sucesso!";
					 }
				 }
			  ?> 
				</font></span></div>
				<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td height="1"><img src="../img/spacer.gif" width="5" height="20"></td>
                    </tr>
                    <tr> 
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="1"><img src="../img/login1.jpg" width="35" height="27"></td>
                            <td background="../img/loginbg.jpg" class="titulo"><strong>LOGIN</strong></td>
                            <td width="1"><img src="../img/login2.jpg" width="8" height="27"></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td bgcolor="#F5F5F5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="20">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td><table width="90%" border="0" align="center" cellpadding="3" cellspacing="0">
                                <form name="form_usuario" action="efetua_login.php" method="post">
                                  <tr> 
                                    <td width="100" class="titulo2"> <div align="right">LOGIN:</div></td>
                                    <td><input name="login" type="text" class="form" id="login" onKeyPress="submitForm(event);" value="<? if (isset($_GET['login']) > 0) { echo  $_GET['login'];} ?>" size="20" maxlength="20"></td>
                                  </tr>
                                  <tr> 
                                    <td width="100" class="titulo2"> <div align="right">SENHA:</div></td>
                                    <td><input name="senha" type="password" class="form" id="senha" onKeyPress="submitForm(event);" size="20" maxlength="20"></td>
                                  </tr>
                                  <tr> 
                                    <input type="hidden" name="pagina" value="<? if (isset($_GET['pagina']) > 0) { echo str_replace("-","&", $_GET['pagina']);} ?>">
                                    <td width="100" class="titulo2"> <div align="right"></div></td>
                                    <td> <input name="Submit" type="submit" class="botao" value="LOGIN"></td>
                                  </tr>
                                </form>
                              </table></td>
                          </tr>
                          <tr> 
                            <td height="20"> <div align="center"><font color="#FF0000"></font></div></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td height="1"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="1" height="1"><img src="../img/login4.jpg" width="8" height="6"></td>
                            <td height="1" bgcolor="#F5F5F5"><img src="../img/spacer.gif" width="5" height="5"></td>
                            <td width="1" height="1"><img src="../img/login3.jpg" width="8" height="6"></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  <br>
                  <br>
                </td>
                <td width="1" background="../img/bg2.jpg"><img src="../img/bg2.jpg" width="8" height="11"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="1">
            <? include("rodape.php"); ?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
