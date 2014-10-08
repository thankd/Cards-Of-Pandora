<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cards Of Pandora Online</title>
<link href="../script/script.css" rel="stylesheet" type="text/css">
<link href="Script/css/confirmar.css" rel="stylesheet" type="text/css">
<?php
// VARIAVEIS DE CONEXAO
$hostname_conecta = "mysql.hostinger.com.br";
$database_conecta = "u657919291_copo";
$username_conecta = "u657919291_root";
$password_conecta = "thales@123";
$erro             = "";

// STRINGS DE CONEXAO
$conexao  = mysql_pconnect($hostname_conecta, $username_conecta, $password_conecta) or trigger_error(mysql_error(),E_USER_ERROR);
$database = mysql_select_db($database_conecta);

if($conexao){
	if($database){
		
		$validate = "true";
		$CodigoValidacao = $_GET['id'];
		$msg = "";
		
		$Verificacao = mysql_query("SELECT DISTINCT Validate FROM pessoa WHERE Codigo_Validate='$CodigoValidacao'");
		
		$resultado = mysql_fetch_row($Verificacao);
		
	

			if($resultado[0] == "true"){
				$msg =  "Essa conta já foi ativada! Obrigado!";
			
			} else {
				
				
		$Atualizar = mysql_query("UPDATE pessoa SET Validate='$validate' WHERE Codigo_Validate='$CodigoValidacao'");
		
		if($Atualizar){
			$msg = "Conta ativada com sucesso, você ganhou 8 cartas da sua tribo";
		}
		
	}
		
} else {
		   print "Não foi possível selecionar o Banco de Dados";
	
	}
} else {
           print "Erro ao conectar o MySQL";
	}

?>
</head>

<body>
<div class="" id="bg_inicial"><img src="../image/bg/label-3.png" width="1080" height="660" usemap="#campo_menu">

  <map name="campo_menu">
    <area shape="rect" coords="730,95,876,133" href="http://cardsofpandora.tk">
    <area shape="rect" coords="581,95,724,132" href="http://cardsofpandora.tk">
	</map>
  <div class="letras" id="EstiloCenter"> 
    <p><a> <?php echo $msg; ?> </a></p>
    <p>&nbsp;</p>
  </div>
    <div class="letras" id="Btn_Voltar">  </a>
      <form name="form1" method="post" action="http://cardsofpandora.tk">
        <input type="submit" name="confirmar" id="confirmar" value="Voltar" class="bradiusBTN" width="100" height="100">
      </form>
    </div>
</div>
</body>
</html>
