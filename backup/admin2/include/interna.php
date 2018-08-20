<?

include("../biblioteca/online.php");

?>
<title><? echo $nome_empresa?></title>
<link href="../css/fontes.css" rel="stylesheet" type="text/css">
<script src="../scripts/all.js"></script>
<style type="text/css">
body {
	behavior: url(../css/csshover.htc);
}

table.realce tr:hover {
	background: #FFFAB4;
}
</style>
<body background="../img/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr> 
    <td height="28" background="../img/cantobg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="18"><img src="../img/canto1.jpg" width="10" height="28"></td>
          <td width="150" class="titulo"><strong></strong></td>
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
                  <td width="10" class="texto">&nbsp;</td>
                </tr>
              </table>
            </div></td>
          <td width="10"> <div align="right"><img src="../img/canto2.jpg" width="30" height="28"></div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="68"> <? include("topo.php"); ?> </td>
  </tr>
  <tr> 
    <td valign="top">
    
    <center><b> <? echo $_GET["menssagem"]?> </b></center>
    
    </td>
  </tr>
  <tr> 
    <td height="1"> <? include("rodape.php"); ?> </td>
  </tr>
</table>
