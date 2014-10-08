<?php require_once('Connections/conexao.php'); ?>
<?php

$Lista_Nomes = array();
$resultado = mysql_query("SELECT a.nome FROM carta a"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Nomes[] = $linha['nome'];
$Array_Nomes = implode("|", $Lista_Nomes);

$Lista_Burst = array();
$resultado = mysql_query("SELECT a.burst FROM carta a"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Burst[] = $linha['burst'];
$Array_Burst = implode("|", $Lista_Burst);

$Lista_Rage = array();
$resultado = mysql_query("SELECT a.rage FROM carta a"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Rage[] = $linha['rage'];
$Array_Rage = implode("|", $Lista_Rage);

$Lista_Araque = array();
$resultado = mysql_query("SELECT a.ataque FROM carta a"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Araque[] = $linha['ataque'];
$Array_Ataque = implode("|", $Lista_Araque);

$Lista_Defesa = array();
$resultado = mysql_query("SELECT a.defesa FROM carta a"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Defesa[] = $linha['defesa'];
$Array_Defesa = implode("|", $Lista_Defesa);

$Lista_Regiao = array();
$resultado = mysql_query("SELECT b.descricao FROM carta a, cartatipo b WHERE a.idtipocarta = b.idtipocarta"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Regiao[] = $linha['descricao'];
$Array_Regiao = implode("|", $Lista_Regiao);

$Lista_Nome_Rank = array();
		$resultado = mysql_query("SELECT u.Pseudonimo FROM ( SELECT Pseudonimo FROM pessoa ORDER BY elo desc LIMIT 15) u, (SELECT @rownum:=0) r"); 
		while ($linha = mysql_fetch_array($resultado))
   		$Lista_Nome_Rank[] = $linha['Pseudonimo'];
		
		$Lista_Elo_Rank = array();
		$resultado = mysql_query("SELECT u.elo FROM ( SELECT elo FROM pessoa ORDER BY elo desc LIMIT 15) u, (SELECT @rownum:=0) r"); 
		while ($linha = mysql_fetch_array($resultado))
   		$Lista_Elo_Rank[] = $linha['elo'];
?>
<?php
$msg_erro = "";
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['login'])) {
  $loginUsername=$_POST['login'];
  
////////////////////////////////////////////////////////////////////////////////////////////////
$erro             = "";

// STRINGS DE CONEXAO

$na = "sim";

		
		$Verificacao     = mysql_query("SELECT DISTINCT Validate FROM pessoa WHERE Email='$loginUsername'");
		
		
		$resultado = mysql_fetch_row($Verificacao);
		
		if($resultado[0] == "false"){
			
		// Conta Ainda precisa ser ativada
		$na = "nao";
			
		}
		
	
//////////////////////////////////////////////////////////////////////////////////////////
	if($na == "sim"){
  $password=md5($_POST['senha']);
  $MM_fldUserAuthorization = "Nivel";
  $MM_redirectLoginSuccess = "pages/logon.php";
  $MM_redirectLoginFailed = "pages/erro.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conexao, $conexao);
  	
  $LoginRS__query=sprintf("SELECT Email, Senha, Nivel FROM pessoa WHERE Email=%s AND Senha=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conexao) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'Nivel');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    $msg_erro = "Login ou Senha Incorretos";
  } 
}  else { $msg_erro = "Conta não ativada, Envie o email de confirmação <a style='color:red; text-decoration:none;' href='pages/email_send.php'>aqui<a>"; }
  
  
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cards Of Pandora Online</title>
<link href="script/script.css" rel="stylesheet" type="text/css">
<style type="text/css">
#div_error{
	position: absolute;
	width: 533px;
	height: 47px;
	z-index: 1;
	left: 599px;
	top: 258px;
	line-height: 30%;
	font-size: 17px;
	font-weight: bold;
	color: red;
}
body {
	background-color: #333;
}
.login_style {
	color: #FFF;
}
.letras {
	font-size: 17px;
	text-align: left;
		font: italic small-caps bold 18px
 	"Verdana", sans-serif;
}
.recuperar {
	font-size: 15px;
	text-align: right;
}
#apDiv1 {
	position: absolute;
	width: 514px;
	height: 383px;
	z-index: 2;
	left: 57px;
	top: 192px;
}
#apDiv3 {
	position: absolute;
	width: 135px;
	height: 163px;
	z-index: 5;
	left: 750px;
	top: 333px;
}
#apDiv4 {
	position: absolute;
	width: 406px;
	height: 270px;
	z-index: 2;
	left: 608px;
	top: 288px;
	background-color: black;
	border-radius: 8px;
	text-align: center;
	color: white;
	font: italic small-caps bold 20px
 	"Verdana", sans-serif;
	padding-top: 10px;
}
#apDiv5 {
	position: absolute;
	width: 26px;
	height: 22px;
	z-index: 10;
	left: 810px;
	top: 368px;
}
#apDiv6 {
	position: absolute;
	width: 26px;
	height: 22px;
	z-index: 10;
	left: 862px;
	top: 436px;
}
#apDiv7 {
	position: absolute;
	width: 26px;
	height: 22px;
	z-index: 6;
	left: 758px;
	top: 435px;
}
#apDiv8 {
	position: absolute;
	width: 26px;
	height: 22px;
	z-index: 7;
	left: 811px;
	top: 505px;
}
#apDiv14 {
	padding-top: 5px;
	position: absolute;
	width: 69px;
	height: 52px;
	z-index: 3;
	left: 958px;
	top: 36px;
	cursor: pointer;
	background-color: #cccccc;
	border-radius: 8px;
}
#apDiv14:hover {
	padding-top: 5px;
	position: absolute;
	width: 69px;
	height: 52px;
	z-index: 3;
	left: 958px;
	top: 36px;
	cursor: pointer;
	border: thin solid black;
	background-color: #cccccc;
	border-top-right-radius: 8px;
	border-top-left-radius: 8px;
}
#apDiv15 {
	position: absolute;
	width: 284px;
	height: 480px;
	z-index: 22;
	left: 734px;
	top: 90px;
	cursor: pointer;
	background-color: #cccccc;
	border-radius: 8px;
	padding-top: 40px;
	padding-left: 10px;
	color: black;
	font: italic small-caps bold 	14px
 	"Verdana", sans-serif;
	display: none;
}
#apDiv16 {
	position: absolute;
	width: 111px;
	height: 45px;
	z-index: 23;
	left: 97px;
	top: 6px;
	color: black;
	font: italic small-caps bold 	21px
 	"Verdana", sans-serif;
}
#apDiv9 {
	position: absolute;
	width: 36px;
	height: 30px;
	z-index: 8;
	left: 703px;
	top: 409px;
}
#apDiv10 {
	position: absolute;
	width: 36px;
	height: 30px;
	z-index: 9;
	left: 905px;
	top: 409px;
}
#points {
color: white;
font: italic small-caps bold 14px
 	"Verdana", sans-serif;	
}
#btn {
 cursor:pointer;	
}
#apDiv11 {
	position: absolute;
	width: 142px;
	height: 203px;
	z-index: 3;
	left: 749px;
	top: 332px;
	background-color: white;
	border-radius: 10px;
}
#apDiv12 {
	position: absolute;
	width: 100px;
	height: 27px;
	z-index: 11;
	left: 905px;
	top: 466px;
	color: white;
	font: italic small-caps bold 18px
 	"Verdana", sans-serif;
}
#apDiv13 {
	position: absolute;
	width: 102px;
	height: 28px;
	z-index: 12;
	left: 905px;
	top: 488px;
	color: white;
	font: italic small-caps bold 18px
 	"Verdana", sans-serif;
}
</style>
<script type="text/javascript">

var indice = 1;

string_nomes = "<?php echo $Array_Nomes; ?>";
array_nomes = string_nomes.split("|");

string_burst = "<?php echo $Array_Burst; ?>";
array_burst = string_burst.split("|");

string_rage = "<?php echo $Array_Rage; ?>";
array_rage = string_rage.split("|");

string_ataque = "<?php echo $Array_Ataque; ?>";
array_ataque = string_ataque.split("|");

string_defesa = "<?php echo $Array_Defesa; ?>";
array_defesa = string_defesa.split("|");

string_regiao = "<?php echo $Array_Regiao; ?>";
array_regiao = string_regiao.split("|");

function aumentar_indice(){
	if(indice <= 39){
	indice++
	} else {
	 indice = 0;	
	}
	alter(indice);
}

function ocultar(erro){
			x = document.getElementById(erro);
			x.style.display = "none";
}
			
function exibir(erro){
			x = document.getElementById(erro);
			x.style.display = "block";
}

function diminuir_indice(){
	if(indice >= 1){
		indice--;	
	} else {
		indice = 39;	
	}
	alter(indice);	
}

function alter(i){
	
	var url_img;
	
	 var url_img = array_nomes[i].toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(array_nomes[i].toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(array_nomes[i].toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }	
	
	var obj = document.getElementById("apDiv3");
	obj.innerHTML = "<img src='pages/img/ddl_cartas/"+url_img+".png' />";
	
	var obj2 = document.getElementById("apDiv5");
	obj2.innerHTML = "<a id='points'>"+ array_burst[i] + "</a>";
	
	var obj3 = document.getElementById("apDiv8");
	obj3.innerHTML = "<a id='points'>"+ array_rage[i] + "</a>";
	
	var obj4 = document.getElementById("apDiv7");
	obj4.innerHTML = "<a id='points'>"+ array_ataque[i] + "</a>";
	
	var obj5 = document.getElementById("apDiv6");
	obj5.innerHTML = "<a id='points'>"+ array_defesa[i] + "</a>";
	
	var obj6 = document.getElementById("apDiv13");
	if(array_regiao[i] == "agua")
	obj6.innerHTML = "água";
	else if(array_regiao[i] == "espirito")
	obj6.innerHTML = "espírito";
	else 
	obj6.innerHTML = array_regiao[i];	
	
}


</script>
</head>

<body onLoad="alter('0')">
<div class="login_style" id="bg_inicial">
<img src="image/bg/label-1.png" width="1080" height="660" usemap="#campo_menu">
<div id="apDiv15">
<div id="apDiv16">Ranking</div>

 <?php 
 $i = 0;
echo "<table border='0' class='Tabela_DinamicaTOP'>
<tr>
<td><?php echo . $i . ?></td>
<td width='60px' align='left'>Posição</td>
<td width='150px' align='left'>Nome</td>
<td width='60px' align='left'>Elo</td>
</tr>
</table>
";	
while($i < count($Lista_Nome_Rank))
{
if($i == 0)
echo "<table border='0' class='Tabela_Dinamica'>
<tr>
<td><?php echo . $i . ?></td>
<td width='60px' align='center'><img src='/pages/img/1_lugar.png' width='20px' height='30px'></td>
<td width='145px' align='left'>$Lista_Nome_Rank[$i]</td>
<td width='60px' align='left'>$Lista_Elo_Rank[$i]</td>
</td>
</tr>
</table>
"; 
else if($i == 1)
echo "<table border='0' class='Tabela_Dinamica'>
<tr>
<td><?php echo . $i . ?></td>
<td width='60px' align='center'><img src='/pages/img/2_lugar.png' width='20px' height='30px'></td>
<td width='145px' align='left'>$Lista_Nome_Rank[$i]</td>
<td width='60px' align='left'>$Lista_Elo_Rank[$i]</td>
</td>
</tr>
</table>
"; 
else if($i == 2)
echo "<table border='0' class='Tabela_Dinamica'>
<tr>
<td><?php echo . $i . ?></td>
<td width='60px' align='center'><img src='/pages/img/3_lugar.png' width='20px' height='30px'></td>
<td width='145px' align='left'>$Lista_Nome_Rank[$i]</td>
<td width='60px' align='left'>$Lista_Elo_Rank[$i]</td>
</td>
</tr>
</table>
"; 
else {
$in = $i + 1;
echo "<table border='0' class='Tabela_Dinamica'>
<tr>
<td><?php echo . $i . ?></td>
<td width='60px' align='center'>$in °</td>
<td width='145px' align='left'>$Lista_Nome_Rank[$i]</td>
<td width='60px' align='left'>$Lista_Elo_Rank[$i]</td>
</td>
</tr>
</table>
"; 
}
$i++;
}
?>

</div>


<div id="apDiv14" ><img src="image/perfil_button.png" width="71" height="47"
onMouseOut="this.src='image/perfil_button.png'; ocultar('apDiv15');"  
onMouseOver="this.src='image/perfil_button-hover.png'; exibir('apDiv15');" /></div>


	<map name="campo_menu">
    <area shape="rect" coords="881,95,1027,133" href="pages/registro.php">
    <area shape="rect" coords="730,95,876,133" href="pages/historia.php">
	</map>
  <div id="apDiv1">
  
  <iframe title="YouTube video player" width="514" height="380" src="//www.youtube.com/embed/1QJhhTyNkNI" frameborder="0" allowfullscreen>	  </iframe>
  </div>
  <div class="login_style" id="div_error"> <a> <?php echo $msg_erro; ?></a> </div>
    <div class="login_style" id="login_style">
    <span class="letras"><strong>Já é cadastrado?</strong>
    </span>
    <form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
      <p class="letras"><strong>E-mail</strong>
        <input name="login" type="text" id="login" size="8" class="bradiusLogin">
        <strong>Senha</strong>
        <input name="senha" type="password" id="senha" size="8" class="bradiusLogin">
      <input class="bradiusBTN2" name="entrar" type="submit" id="entrar" value="entrar">
      </p>
      
    </form>
  </div>
<div id="apDiv12">Região:</div>
<div id="apDiv11"></div>
<div id="apDiv10" onClick="aumentar_indice()"><img id="btn" src="btn_right.png"></div>
<div id="apDiv9" onClick="diminuir_indice()"><img id="btn" src="btn_left.png"></div>
<div id="apDiv8"></div>
<div id="apDiv7"></div>
<div id="apDiv6"></div>
<div id="apDiv4">Cartas Disponíveis</div>
<div id="apDiv3"></div>
<div id="apDiv5"></div>
<div id="apDiv13"></div>
</div>
</body>
</html>