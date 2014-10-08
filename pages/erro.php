<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cards Of Pandora Online</title>
<link href="../script/script.css" rel="stylesheet" type="text/css">
<link href="Script/css/erro.css" rel="stylesheet" type="text/css">
<?php 


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
		
		$Verificacao = mysql_query("SELECT DISTINCT Validate FROM pessoa WHERE Email='thalesprisonbreak@gmail.com'");
		
		$resultado = mysql_fetch_row($Verificacao);
		
		if($resultado[0] == "false"){
			
		// Conta Ainda precisa ser ativada
		
			
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
<div class="login_style" id="bg_inicial"><img src="../image/bg/label-4.png" width="1080" height="660" usemap="#campo_menu">

	<map name="campo_menu">
    <area shape="rect" coords="881,95,1027,133" href="registro.php">
        <area shape="rect" coords="730,95,876,133" href="historia.php">
    <area shape="rect" coords="581,95,724,132" href="../index.php">
	</map>
</div>
</body>
</html>
