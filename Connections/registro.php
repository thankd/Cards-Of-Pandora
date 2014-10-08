<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cards Of Pandora Online</title>
<link href="../script/script.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	background-color: #333;
}
.login_style {
	color: #FFF;
}
.letras {
	font-size: 17px;
	text-align: center;
}
.recuperar {
	font-size: 15px;
	text-align: right;
}
#apDiv1 {
	position: absolute;
	width: 868px;
	height: 387px;
	z-index: 2;
	left: 107px;
	top: 174px;
}
#apDiv2 {
	position: absolute;
	width: 746px;
	height: 320px;
	z-index: 2;
	left: 83px;
	top: 40px;
	color: #000;
	font-weight: bold;
	text-align: center;
}
#apDiv3 {
	position: absolute;
	width: 282px;
	height: 36px;
	z-index: 2;
	left: 11px;
	top: 253px;
	color: #F00;
	font-weight: bold;
}
#apDiv4 {
	position: absolute;
	width: 189px;
	height: 205px;
	z-index: 2;
	left: 81px;
	top: 118px;
	color: #000;
	font-weight: bold;
	text-align: center;
}
#apDiv5 {
	position: absolute;
	width: 122px;
	height: 24px;
	z-index: 2;
	left: 673px;
	top: 251px;
}
#apDiv6 {	position: absolute;
	width: 323px;
	height: 320px;
	z-index: 2;
	left: 70px;
	top: 39px;
	color: #000;
	font-weight: bold;
}
#apDiv7 {	position: absolute;
	width: 399px;
	height: 331px;
	z-index: 2;
	left: 428px;
	top: 40px;
	color: #000;
	font-weight: bold;
}
#apDiv8 {	position: absolute;
	width: 104px;
	height: 110px;
	z-index: 2;
	left: 61px;
	top: 106px;
	color: #000;
	font-weight: bold;
}
#apDiv9 {	position: absolute;
	width: 323px;
	height: 320px;
	z-index: 2;
	left: 70px;
	top: 39px;
	color: #000;
	font-weight: bold;
}
#apDiv10 {	position: absolute;
	width: 323px;
	height: 320px;
	z-index: 2;
	left: 70px;
	top: 39px;
	color: #000;
	font-weight: bold;
}


#estiloC {
  border-color: #000;
  -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, .5);
  -moz-box-shadow: 0 0 5px rgba(0, 0, 0, .5);
  -o-box-shadow: 0 0 5px rgba(0, 0, 0, .5);
  -ms-box-shadow: 0 0 5px rgba(0, 0, 0, .5);
  box-shadow: 0 0 5px rgba(0, 0,0, .5);
}
#apDiv11 {	position: absolute;
	width: 746px;
	height: 320px;
	z-index: 2;
	left: 83px;
	top: 40px;
	color: #000;
	font-weight: bold;
	text-align: center;
}
</style>
<?php
// VARIAVEIS DE CONEXAO
$hostname_conecta = "mysql.hostinger.com.br";
$database_conecta = "u657919291_copo";
$username_conecta = "u657919291_root";
$password_conecta = "thales@123";
$erro             = "";

if (isset($_GET['error'])) {
	$erro = $_GET['error'];

	}

// STRINGS DE CONEXAO
$conexao  = mysql_pconnect($hostname_conecta, $username_conecta, $password_conecta) or trigger_error(mysql_error(),E_USER_ERROR);
$database = mysql_select_db($database_conecta);

	
if(isset($_POST['cad_users']) && $_POST['cad_users'] == 'cad'){
// VARIAVEIS DE FORMULARIO
// Insert para pessoa


$nome           = $_POST["nome"];
$pseudonimo     = $_POST["pseudonimo"];
$mail           = $_POST["email"];
$senha          = $_POST["senha"];
$rep_senha      = $_POST["repetirsenha"];
$URL_Img        = "ImageUsers/source.jpg";
$pais           = $_POST["pais"];
$validate       = "false";
$Nivel          = "Jogador";
$CodigoValidate = uniqid();
// Insert para Inventario
$regiao         = $_POST["RadioGroup"];
$qtd_cristais   = 0;
$qtd_pergaminho = 0;
$NAcesso        = 0;
$XP             = 0;
$Id_Nivel       = 1;





///////////////////////////////////////////////////////////////////////////////
if($conexao){
	if($database){
		
$usuario_cad = mysql_query("SELECT email FROM pessoa WHERE email = '$mail'")
              or die(mysql_error());
if(@mysql_num_rows($usuario_cad) >= '1'){
	$erro = "Email Já cadastrado";
}else{
	
	if($senha != $rep_senha){
		$erro = "As Senhas não são iguais!";
}else{

$cadastra_users = mysql_query("INSERT INTO pessoa(Nome, Pseudonimo, Email, Senha, URL_Img, Pais, Validate, Nivel, Codigo_Validate)
                    VALUES('$nome', '$pseudonimo', '$mail', md5('$senha'), '$URL_Img', '$pais', '$validate', '$Nivel', '$CodigoValidate')")
			 or die(mysql_error());

$ultimo_id = mysql_insert_id();

$Novo_Inventario = mysql_query("INSERT INTO inventario(Regiao, QtdCristais, QtdPergaminho, NAcesso, XP, IdNivel, IdPessoa)
                    VALUES('$regiao', '$qtd_cristais', '$qtd_pergaminho', '$NAcesso', '$XP', '$Id_Nivel', '$ultimo_id')")
			 or die(mysql_error());

$Id_Inventario = mysql_insert_id();

if($regiao == "agua"){
//////////////////////////////  ADD DE AGUA ////////////////////////
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 19, 17, 8, 7, 'true', '$Id_Inventario', 1)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 17, 22, 7, 8, 'true', '$Id_Inventario', 2)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 17, 16, 9, 9, 'true', '$Id_Inventario', 3)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 18, 15, 11, 8, 'true', '$Id_Inventario', 4)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 16, 15, 9, 10, 'true', '$Id_Inventario', 5)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 20, 19, 6, 8, 'true', '$Id_Inventario', 6)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 16, 19, 10, 7, 'true', '$Id_Inventario', 7)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 19, 22, 6, 10, 'true', '$Id_Inventario', 8)")
			 or die(mysql_error());		 
} else if($regiao == "fogo"){
//////////////////////////////  ADD DE FOGO ////////////////////////
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 17, 20, 8, 9, 'true', '$Id_Inventario', 9)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 17, 22, 7, 8, 'true', '$Id_Inventario', 10)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 19, 17, 11, 10, 'true', '$Id_Inventario', 11)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 22, 16, 8, 8, 'true', '$Id_Inventario', 12)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 17, 15, 8, 9, 'true', '$Id_Inventario', 13)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 20, 19, 6, 10, 'true', '$Id_Inventario', 14)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 17, 19, 9, 7, 'true', '$Id_Inventario', 15)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 20, 17, 10, 7, 'true', '$Id_Inventario', 16)")
			 or die(mysql_error());		 
} else if($regiao == "terra"){
//////////////////////////////  ADD DE TERRA ////////////////////////
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 18, 15, 10, 8, 'true', '$Id_Inventario', 17)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 19, 20, 7, 11, 'true', '$Id_Inventario', 18)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 17, 17, 9, 7, 'true', '$Id_Inventario', 19)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 22, 16, 9, 9, 'true', '$Id_Inventario', 20)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 18, 15, 11, 9, 'true', '$Id_Inventario', 21)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 20, 19, 6, 9, 'true', '$Id_Inventario', 22)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 17, 22, 9, 7, 'true', '$Id_Inventario', 23)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 20, 17, 10, 8, 'true', '$Id_Inventario', 24)")
			 or die(mysql_error());		
} else if($regiao == "ar"){
//////////////////////////////  ADD DE AR ////////////////////////
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 20, 20, 6, 6, 'true', '$Id_Inventario', 25)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 19, 19, 11, 7, 'true', '$Id_Inventario', 26)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 18, 17, 7, 9, 'true', '$Id_Inventario', 27)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 21, 16, 9, 9, 'true', '$Id_Inventario', 28)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 17, 15, 9, 11, 'true', '$Id_Inventario', 29)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 21, 19, 10, 6, 'true', '$Id_Inventario', 30)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 18, 20, 7, 9, 'true', '$Id_Inventario', 31)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 17, 18, 8, 10, 'true', '$Id_Inventario', 32)")
			 or die(mysql_error());		 
} else if($regiao == "espirito"){
//////////////////////////////  ADD DE ESPIRITO ////////////////////////
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 19, 18, 7, 8, 'true', '$Id_Inventario', 33)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 18, 17, 11, 7, 'true', '$Id_Inventario', 34)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 17, 18, 7, 9, 'true', '$Id_Inventario', 35)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 20, 16, 9, 10, 'true', '$Id_Inventario', 36)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 17, 16, 8, 11, 'true', '$Id_Inventario', 37)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 20, 19, 10, 6, 'true', '$Id_Inventario', 38)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 18, 20, 7, 9, 'true', '$Id_Inventario', 39)")
			 or die(mysql_error());		 
$Carta1Add = mysql_query("INSERT INTO cartainventario(Nv_Burst,	Nv_Ataque, Nv_Defesa, Nv_Rage, Burst_Up, Rage_Up, Ataque_Up, Defesa_Up, Deck_Estado, IdInventario, IdCarta)
                    VALUES(1, 1, 1, 1, 17, 18, 9, 10, 'true', '$Id_Inventario', 40)")
			 or die(mysql_error());		
}

$respostaPessoa     = ("$cadastra_users");
$respostaInventario = ("$Novo_Inventario");

//http://www.housoft.org/contact/
//http://www.housoft.org/dicas/index.php/tag/servidor-smtp-gratis/
//http://rberaldo.com.br/enviando-e-mails-com-a-classe-phpmailer/

if($respostaPessoa){
	if($respostaInventario){

	require 'phpmailer/class.phpmailer.php';
 
$PHPMailer = new PHPMailer();
 
// define que será usado SMTP
$PHPMailer->IsSMTP();
 
// envia email HTML
$PHPMailer->isHTML( true );
 
// codificação UTF-8, a codificação mais usada recentemente
$PHPMailer->Charset = 'iso-8859-1';
 
// Configurações do SMTP
$PHPMailer->SMTPAuth = true;
$PHPMailer->Host = 'smtps.bol.com.br';
$PHPMailer->Port = '587';
$PHPMailer->Username = 'copo.contato@bol.com.br';
$PHPMailer->Password = 'thales12';
$PHPMailer->SMTPDebug = 1; 
 
// E-Mail do remetente (deve ser o mesmo de quem fez a autenticação
// nesse caso seu_login@gmail.com)
$PHPMailer->From = 'copo.contato@bol.com.br';
 
// Nome do rementente
$PHPMailer->FromName = 'Cards Of Pandora';
 
// assunto da mensagem
$PHPMailer->Subject = 'Confirmação de Conta - Beta 1.0';
 
// corpo da mensagem
$PHPMailer->Body = '<h2 color = "red"> Sejá Bem Vindo ao mundo de Cards Of Pandora Beta 1.0! </h2> <br> <img src="http://i.imgur.com/O3VVCLb.png" align="center"> <br> <h3> Vejo que você e novo por aqui na região '. $regiao.', aqui acabamos com os inimigos e sempre lutamos para vencer! Então Prepare-se!!! </h3> <br> <h3> Olá '. $nome .', obrigado por testar nosso jogo, para validar a sua conta, por favor clique no link a baixo:</h3> <br> <h4><a href="http://cardsofpandora.hol.es/pages/confirmar.php?id='.$CodigoValidate.'"> http://cardsofpandora.hol.es/pages/confirmar.php?id='.$CodigoValidate.' </a><h4> <br> <h4> Caso não funcione por favor copie e cole no seu navegador </h4>';
 
// corpo da mensagem em modo texto
//$PHPMailer->AltBody = 'Mensagem em texto';
 
// adiciona destinatário (pode ser chamado inúmeras vezes)
$PHPMailer->AddAddress( $mail );

// verifica se enviou corretamente
if ( $PHPMailer->Send() )
{
	echo "Enviado com sucesso";
//	header ("location: registro_confirmacao.php?regiao=".$regiao);
}
else
{
	echo 'Erro do PHPMailer: ' . $PHPMailer->ErrorInfo;
}
	
	}else{
	$erro = "Erro ao cadastrar usuário!";
}
}else{
	$erro = "Erro ao cadastrar usuário!";
}
}
}
//@header ("location:registro.php?error=$erro");

} else {
		   print "Não foi possível selecionar o Banco de Dados";
	
	}
} else {
           print "Erro ao conectar o MySQL";
	}
}
?>
</head>

<body>
<div class="login_style" id="bg_inicial"><img src="../image/bg/label-3.png" width="1080" height="660" usemap="#campo_menu">

	<map name="campo_menu">
    <area shape="rect" coords="730,95,876,133" href="historia.php">
    <area shape="rect" coords="581,95,724,132" href="../index.php">
	</map>
  <div class="letras" id="apDiv1">
    <div class="letras" id="apDiv2">
      <div class="letras" id="apDiv3">
        <p align="center"><?php echo $erro;?></p>
      </div>
      <p>&nbsp;</p>
      <form name="form1" method="post" id="" >
        <table width="290" align="left">
          <tr>
            <td width="133">País</td>
            <td width="145"><label for="pais"></label>
              <select name="pais" id="estiloC" class="txt bradius" required>
                <option value="Brasil">Brasil</option>
                <option value="USA">Estados Unidos</option>
            </select></td>
          </tr>
          <tr>
            <td height="28">Nome Real</td>
            <td><label for="nome"></label>
            <input name="nome" type="text" id="estiloC" size="21" class="txt bradius" required></td>
          </tr>
          <tr>
            <td height="28">Pseudônimo</td>
            <td><label for="pseudonimo"></label>
            <input name="pseudonimo" type="text" id="estiloC" size="21" class="txt bradius" required></td>
          </tr>
          <tr>
            <td height="29">E-Mail</td>
            <td><label for="email"></label>
            <input name="email" type="email" id="estiloC" size="21" class="txt bradius" required></td>
          </tr>
          <tr>
            <td height="32">Senha</td>
            <td><label for="senha"></label>
            <input name="senha" type="password" id="estiloC" size="21" class="txt bradius" required></td>
          </tr>
          <tr>
            <td>Repetir Senha</td>
            <td><label for="repetirsenha"></label>
            <input name="repetirsenha" type="password" id="estiloC" size="21" class="txt bradius" required></td>
          </tr>
        </table>
        <p>Escolha a sua Região</p>
        <table width="200" align="center">
          <tr>
            <td height="139"><img src="../image/elements/agua.png" alt="" width="70" height="100">
            <input name="RadioGroup" type="radio" id="RadioGroup_5" value="agua" required></td>
            <td><img title = "A tribo do fogo tem as criaturas com mais força bruta, mais elas não possuem muita defesa, a tribo do fogo e marcada por entrigas e brigas" src="../image/elements/fogo.png" alt="" width="70" height="100">
            <input type="radio" name="RadioGroup" value="fogo" id="RadioGroup_6" required></td>
            <td><img src="../image/elements/ar.png" alt="" width="70" height="100">
            <input type="radio" name="RadioGroup" value="ar" id="RadioGroup_7" required></td>
            <td><img src="../image/elements/terra.png" alt="" width="70" height="100">
            <input type="radio" name="RadioGroup" value="terra" id="RadioGroup_8" required></td>
            <td><img src="../image/elements/espirito.png" alt="" width="70" height="100">
            <input type="radio" name="RadioGroup" value="espirito" id="RadioGroup_9" required></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <input type="hidden" name="cad_users" value="cad" />
            <td>&nbsp;</td>
          </tr>
        </table>
        <p>
          <input type="reset" name="redefinir" id="redefinir" value="Redefinir" class="bradiusBTN">
          <input type="submit" name="confirmar2" id="confirmar2" value="Confirmar" class="bradiusBTN">
        </p>
      </form>
      <p>&nbsp;</p>
    </div>
  </div>
</div>
</body>
</html>
