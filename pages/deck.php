<?php require_once('../Connections/conexao.php'); 
?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "Jogador";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "erro.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
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

$colname_LogonNome = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_LogonNome = $_SESSION['MM_Username'];
}

$query_LogonNome = sprintf("SELECT Pseudonimo FROM pessoa WHERE Email = %s", GetSQLValueString($colname_LogonNome, "text"));
$LogonNome = mysql_query($query_LogonNome, $conexao) or die(mysql_error());
$row_LogonNome = mysql_fetch_assoc($LogonNome);
$totalRows_LogonNome = mysql_num_rows($LogonNome);

$colname_srId = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_srId = $_SESSION['MM_Username'];
}

$query_srId = sprintf("SELECT IdPessoa FROM pessoa WHERE Email = %s", GetSQLValueString($colname_srId, "text"));
$srId = mysql_query($query_srId, $conexao) or die(mysql_error());
$row_srId = mysql_fetch_assoc($srId);
$totalRows_srId = mysql_num_rows($srId);

// Variavel principal
$SecId = $row_srId['IdPessoa'];
///////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// Buscas do Usuario /////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

include 'WideImage/WideImage.php';

		
		$ImageUser = "";
		$ImageBusca = mysql_query("SELECT DISTINCT URL_Img FROM pessoa WHERE IdPessoa='$SecId'");
		$ImageUser = mysql_fetch_row($ImageBusca);
		
		$PseudonimoUser = "";
		$PseudonimoBusca = mysql_query("SELECT DISTINCT Pseudonimo FROM pessoa WHERE IdPessoa='$SecId'");
		$PseudonimoUser = mysql_fetch_row($PseudonimoBusca);
		
		$EmailUser = "";
		$EmailBusca = mysql_query("SELECT DISTINCT Email FROM pessoa WHERE IdPessoa='$SecId'");
		$EmailUser = mysql_fetch_row($EmailBusca);
		
		$NomeUser = "";
		$NomeBusca = mysql_query("SELECT DISTINCT Nome FROM pessoa WHERE IdPessoa='$SecId'");
		$NomeUser = mysql_fetch_row($NomeBusca);
		
		$Nivel = 0;
		$NivelBusca = mysql_query("SELECT DISTINCT Nivel FROM nivel A, inventario B WHERE B.IdPessoa='$SecId' and B.IdNivel = A.IdNivel");
		$Nivel = mysql_fetch_row($NivelBusca);
		
		$Qtd_Cristal = 0;
		$Qtd_CristalBusca = mysql_query("SELECT DISTINCT QtdCristais FROM inventario WHERE IdPessoa='$SecId'");
		$Qtd_Cristal = mysql_fetch_row($Qtd_CristalBusca);
		
		$Id_Inventario = 0;
		$Id_Inventario = mysql_query("SELECT DISTINCT IdInventario FROM inventario WHERE IdPessoa='$SecId'");
		$Id_Inventario = mysql_fetch_row($Id_Inventario);
		
		$Qtd_Pergaminho = 0;
		$Qtd_PergaminhoBusca = mysql_query("SELECT DISTINCT QtdPergaminho FROM inventario WHERE IdPessoa='$SecId'");
		$Qtd_Pergaminho = mysql_fetch_row($Qtd_PergaminhoBusca);

?>
<?php
// Conexão com o banco de dados


// Se o usuário clicou no botão cadastrar efetua as ações
$validarCampo = isset($_POST['atualizar']) ? $_POST['atualizar'] : '';
if ($validarCampo) {
	
	// Recupera os dados dos campos
	$error=0;
	$foto = $_FILES["FotoURL"];
	
			// Insere os dados no banco
			
			if (!empty($foto["name"])) {
		
			// Largura máxima em pixels
			$largura = 1000;
			// Altura máxima em pixels
			$altura = 1000;
			// Tamanho máximo do arquivo em bytes
			$tamanho = 1000;
			
		 	// Verifica se o arquivo é uma imagem
    		if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $foto["type"])){
     	  		echo "Isso não é uma imagem.";
   	 		} else {
				
			// Selecionando nome da foto do usuário
			$sql = mysql_query("SELECT URL_Img FROM pessoa WHERE IdPessoa = '".$SecId."'");
			$usuario = mysql_fetch_row($sql); 
			// Removendo imagem da pasta
			unlink($usuario[0]);
		
			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

        	// Gera um nome único para a imagem
        	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

        	// Caminho de onde ficará a imagem
        	$caminho_imagem = "ImageUsers/" . $nome_imagem;

				// Faz o upload da imagem para seu respectivo caminho
				move_uploaded_file($foto["tmp_name"], $caminho_imagem);
				
				$image1 = WideImage::load("ImageUsers/" . $nome_imagem);
				$nova_img1 = $image1->resize(84, 104, 'fill');
				$nova_img1 ->saveToFile('ImageUsers/' . $nome_imagem, 90);
				
				$sql = mysql_query("UPDATE pessoa 
				SET URL_Img='$caminho_imagem' 
				WHERE IdPessoa='$SecId'");
				
				}

			}

			header("Location: alterar_imagem.php?sucess=1");

}
?>
<?php

// set your db encoding -- for ascent chars (if required)
						
$EstadoInventarioBusca = "";
$EstadoInventarioBusca = mysql_query("SELECT DISTINCT Deck_Estado FROM cartainventario WHERE IdInventario='$SecId'");
$EstadoInventario = mysql_fetch_row($EstadoInventarioBusca);
// http://www.phpgrid.org/docs/#getting-started

// subqueries are also supported now (v1.2)

// Conexão com o banco de dados

		$Qtd_Carta_Deck_Busca = mysql_query("SELECT COUNT(idcartainventario) FROM cartainventario WHERE Idinventario='$SecId' AND deck_estado = 'true'");
		$Qtd_Carta_Deck = mysql_fetch_row($Qtd_Carta_Deck_Busca);
		$qtd_final_qtd_deck = number_format($Qtd_Carta_Deck[0]);
		
function Colocar_Tirar_Deck($Estado, $id_carta_inventario, $Qtd){
	
		// Ativar
		if($Estado == 'false') {
			if($Qtd < 2){
			$sql = mysql_query("UPDATE cartainventario 
				SET Deck_Estado='true' 
				WHERE Idcartainventario='$id_carta_inventario'");
			}
			else {
				header("Location:inventario.php?erro=true");
				 }
		}
		
		// Desativar
		if($Estado == 'true'){
			$sql = mysql_query("UPDATE cartainventario 
				SET Deck_Estado='false' 
				WHERE Idcartainventario='$id_carta_inventario'");
				header("Location:inventario.php");
		}
}


$modify = "";
$erroT = "";
$id_modify = "";

if (isset($_GET['modify'])) {
				$modify = $_GET['modify'];
		}
$erroT = "";
if (isset($_GET['erro'])) {
				$erroT = $_GET['erro'];
		}	
		
$id_modify = "";
if (isset($_GET['id'])) {
				$id_modify = $_GET['id'];
		}	

if($id_modify!="")
Colocar_Tirar_Deck($modify, $id_modify, $qtd_final_qtd_deck);


	
$Lista_Ids = array();
$resultado = mysql_query("SELECT distinct idcartainventario FROM cartainventario WHERE idinventario = '$SecId' AND Deck_Estado = 'true'  ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Ids[] = $linha['idcartainventario'];
//-------------------------------------------------------------------------------------------------------
$Lista_Nomes = array();
$resultado = mysql_query("SELECT a.nome FROM carta a, cartainventario b WHERE b.idinventario = '$SecId' and b.idcarta = a.idcarta and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Nomes[] = $linha['nome'];
//-------------------------------------------------------------------------------------------------------
$Lista_Burst_Up = array();
$resultado = mysql_query("SELECT Burst_up FROM cartainventario WHERE idinventario = '$SecId'  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Burst_Up[] = $linha['Burst_up'];
//------------------------------------------------------------------------------------------------------
$Lista_Rage_Up = array();
$resultado = mysql_query("SELECT Rage_up FROM cartainventario WHERE idinventario = '$SecId'  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Rage_Up[] = $linha['Rage_up'];
//-------------------------------------------------------------------------------------------------------	
$Lista_Ataque_Up = array();
$resultado = mysql_query("SELECT Ataque_up FROM cartainventario WHERE idinventario = '$SecId'  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Ataque_Up[] = $linha['Ataque_up'];
//-------------------------------------------------------------------------------------------------------	
$Lista_Defesa_Up = array();
$resultado = mysql_query("SELECT Defesa_up FROM cartainventario WHERE idinventario = '$SecId'  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Defesa_Up[] = $linha['Defesa_up'];
//-------------------------------------------------------------------------------------------------------	
$Lista_Nv_Burst = array();
$resultado = mysql_query("SELECT Nv_Burst FROM cartainventario WHERE idinventario = '$SecId'  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Nv_Burst[] = $linha['Nv_Burst'];
	
$Lista_Nv_Burst_Show_att = array();
for($i = 0; $i < count($Lista_Nv_Burst); $i++){
	$Lista_Nv_Burst_Show_att[$i] = "+$Lista_Nv_Burst[$i]";	
}
$Lista_Nv_Burst_Show = array();
for($i = 0; $i < count($Lista_Nv_Burst); $i++){
	$Lista_Nv_Burst_Show[$i] = "Burst";	
}

//-------------------------------------------------------------------------------------------------------	
$Lista_Nv_Rage = array();
$resultado = mysql_query("SELECT Nv_Rage FROM cartainventario WHERE idinventario = '$SecId'  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Nv_Rage[] = $linha['Nv_Rage'];
	
$Lista_Nv_Rage_Show_att = array();
for($i = 0; $i < count($Lista_Nv_Rage); $i++){
	$Lista_Nv_Rage_Show_att[$i] = "+$Lista_Nv_Rage[$i]";	
}
$Lista_Nv_Rage_Show = array();
for($i = 0; $i < count($Lista_Nv_Rage); $i++){
	$Lista_Nv_Rage_Show[$i] = "Rage";	
}
//-------------------------------------------------------------------------------------------------------	
$Lista_Nv_Ataque = array();
$resultado = mysql_query("SELECT Nv_Ataque FROM cartainventario WHERE idinventario = '$SecId'  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Nv_Ataque[] = $linha['Nv_Ataque'];
	
	
$Lista_Nv_Ataque_Show_att = array();
for($i = 0; $i < count($Lista_Nv_Ataque); $i++){
	$Lista_Nv_Ataque_Show_att[$i] = "+$Lista_Nv_Ataque[$i]";	
}
$Lista_Nv_Ataque_Show = array();
for($i = 0; $i < count($Lista_Nv_Ataque); $i++){
	$Lista_Nv_Ataque_Show[$i] = "Ataque";	
}
//-------------------------------------------------------------------------------------------------------	
$Lista_Nv_Defesa = array();
$resultado = mysql_query("SELECT Nv_Defesa FROM cartainventario WHERE idinventario = '$SecId'  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Nv_Defesa[] = $linha['Nv_Defesa'];
	
$Lista_Nv_Defesa_Show_att = array();
for($i = 0; $i < count($Lista_Nv_Defesa); $i++){
	$Lista_Nv_Defesa_Show_att[$i] = "+$Lista_Nv_Defesa[$i]";	
}
$Lista_Nv_Defesa_Show = array();
for($i = 0; $i < count($Lista_Nv_Defesa); $i++){
	$Lista_Nv_Defesa_Show[$i] = "Defesa";
}
//-------------------------------------------------------------------------------------------------------	
$Lista_Deck_Estado = array();																			
$resultado = mysql_query("SELECT Deck_Estado FROM cartainventario WHERE idinventario = '$SecId'  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 		
while ($linha = mysql_fetch_array($resultado))															
    $Lista_Deck_Estado[] = $linha['Deck_Estado'];														
//-------------------------------------------------------------------------------------------------------
$Lista_Região = array();
$resultado = mysql_query("SELECT a.Descricao FROM cartatipo a, cartainventario b, carta c WHERE b.idinventario = '$SecId' AND b.idcarta = c.idcarta AND c.idtipocarta = a.idtipocarta  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Região[] = $linha['Descricao'];
	
//-------------------------------------------------------------------------------------------------------


$Regiao_Img_Link = array();
$i=0;
while($i < count($Lista_Ids))
{
if($Lista_Região[$i] == 'agua'){
	$Regiao_Img_Link[$i] = '<img width="30px" height="30px" src="img/icones/agua.png" alt="Água">';
}  else 

if($Lista_Região[$i] == 'fogo'){
	$Regiao_Img_Link[$i] = '<img width="30px" height="30px" src="img/icones/fogo.png" alt="Água">';
}  else 

if($Lista_Região[$i] == 'terra'){
	$Regiao_Img_Link[$i] = '<img width="30px" height="30px" src="img/icones/terra.png" alt="Água">';
}  else 

if($Lista_Região[$i] == 'ar'){
	$Regiao_Img_Link[$i] = '<img width="30px" height="30px" src="img/icones/ar.png" alt="Água">';
}  else 

if($Lista_Região[$i] == 'espirito'){
	$Regiao_Img_Link[$i] = '<img width="30px" height="30px" src="img/icones/espirito.png" alt="Água">';
}
$i++;
}

//-------------------------------------------------------------------------------------------------------


$Estado_Atual_Button = array();
$i=0;
while($i < count($Lista_Ids))
{
if($Lista_Deck_Estado[$i] == 'false'){
	$Estado_Atual_Button[$i] = '<img src="img/setas/btn_usar1.png">';
} else {
	$Estado_Atual_Button[$i] = '<img src="img/setas/btn_retirar1.png">';
}
$i++;
}

$tam = sizeof($Lista_Nomes);

$table_cartas = "";

$table_cartas = "<table border='0' class='Tabela_Dinamica'> 
<tr>";

$Images_Cartas = array();

for($i = 0; $i < $tam; $i++){
	 $url_img = str_replace(" ","_",$Lista_Nomes[$i]);
	 $url_img = strtolower($url_img);
	 if($Lista_Nomes[$i] == "Fate - E"){
		 $url_img = "fate-e";
	 } else
	 if($Lista_Nomes[$i] == "Fate - K"){
		 $url_img = "fate-k";
	 }
	 
	 
if($i == 3) {
$table_cartas = " $table_cartas  <td> <img src='img/ddl_cartas/$url_img.png'></td> </tr> <tr width='50px' height='50px'> </tr> <tr> "; 
}else{
$table_cartas =  " $table_cartas  <td> <img src='img/ddl_cartas/$url_img.png'></td>"; 
}
}
$table_cartas = " $table_cartas   </tr></table>";


//------------------------------------------------------------------------------------------------------
if(isset($_POST['cad_img']) && $_POST['cad_img'] == 'img'){
	
	// Recupera os dados dos campos
	$error=0;
	$foto = $_FILES["FotoURL"];
	
			// Insere os dados no banco
			
			if (!empty($foto["name"])) {
		
			// Largura máxima em pixels
			$largura = 1000;
			// Altura máxima em pixels
			$altura = 1000;
			// Tamanho máximo do arquivo em bytes
			$tamanho = 2000;
			
		 	// Verifica se o arquivo é uma imagem
    		if(!eregi("^image\/(pjpeg|jpeg|jpg)$", $foto["type"])){
     	  	} else {
				
			// Selecionando nome da foto do usuário
			$sql = mysql_query("SELECT URL_Img FROM pessoa WHERE IdPessoa = '".$SecId."'");
			$usuario = mysql_fetch_row($sql); 
			// Removendo imagem da pasta
			if($usuario[0] != "ImageUsers/source.jpg"){
			unlink($usuario[0]);
			}
			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

        	// Gera um nome único para a imagem
        	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

        	// Caminho de onde ficará a imagem
        	$caminho_imagem = "ImageUsers/" . $nome_imagem;

				// Faz o upload da imagem para seu respectivo caminho
				move_uploaded_file($foto["tmp_name"], $caminho_imagem);
				
				$image1 = WideImage::load("ImageUsers/" . $nome_imagem);
				$nova_img1 = $image1->resize(84, 104, 'fill');
				$nova_img1 ->saveToFile('ImageUsers/' . $nome_imagem, 90);
				
				$sql = mysql_query("UPDATE pessoa 
				SET URL_Img='$caminho_imagem' 
				WHERE IdPessoa='$SecId'");
				
				}

			}
			header("Location: deck.php");
}

?>
<!doctype html>
<html>
<head>

<meta charset="utf-8">
<title>Cards Of Pandora Online</title>
<link href="../script/script.css" rel="stylesheet" type="text/css">

<!-- Cor do plano de fundo -->
<style type="text/css"> body { background-color: #FFF;  } </style>

<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
<link href="Script/css/deck.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function ocultar(erro){
			x = document.getElementById(erro);
			x.style.display = "none";
}
			
function exibir(erro){
			x = document.getElementById(erro);
			x.style.display = "block";
}
</script>
</head>

<body>

<div id="c">

<div class="login_style" id="bg_logon"> 

  
  <div class="logon_logo" id="logon_logo">
  
  <img src="img/logo_finale.png" />
  
  <div id="btn_inicio"><a href="logon.php"><img src="img/btn_inicio.png" width="190" height="41"
  onMouseOut="this.src='img/btn_inicio.png';"  
  onMouseOver="this.src='img/btn_inicio_hover.png';"
  ></a> </div>
  <div id="btn_cartas"><a href="inventario.php"><img src="img/btn_cartas.png" width="190" height="41"
  onMouseOut="this.src='img/btn_cartas.png';"  
  onMouseOver="this.src='img/btn_cartas_hover.png';"
  ></a> </div>
  <div id="btn_mercado"><a href="mercado.php"><img src="img/btn_mercado.png" width="190" height="41"
  onMouseOut="this.src='img/btn_mercado.png';"  
  onMouseOver="this.src='img/btn_mercado_hover.png';"
  ></a> </div>
  <div id="btn_suporte"><a href="suporte.php"><img src="img/btn_suporte.png" width="190" height="41"
  onMouseOut="this.src='img/btn_suporte.png';"  
  onMouseOver="this.src='img/btn_suporte_hover.png';"
  ></a> </div>
    
  
   
  </div>
  
  <div class="logon_logo" id="Layer1"><img src="../image/layer1.png" width="764" height="32"> </div>
  <div class="logon_logo" id="Layer2"><img src="../image/layer2.png" width="764" height="682"></div>
  <div class="logon_logo" id="Duvida_Button"><a href="sobre.php"><img title="Sobre" src="../image/ajuda.png" width="50" height="50" onMouseOut="this.src='../image/ajuda.png';" onMouseOver="this.src='../image/ajuda-hover.png';"></a></div>
  
            
            
            <!--  DADOS DO USUARIO  -->
            
  <div class="login_color" id="usuario_model">

  	<div class="login_color" id="area_usuario">

    </div>
      
    <div class="login_color" id="area_perfil"><a href="ranking.php"><img title="Ranking" src="../image/perfil_button.png" width="71" height="47"
    
    onMouseOut="this.src='../image/perfil_button.png';"  
    onMouseOver="this.src='../image/perfil_button-hover.png';"></a>

   	</div>
      
    <div class="login_color" id="area_usuario"><a href="deck.php"><img title="Deck" src="../image/cartas_button.png" width="71" height="47"
    
    onMouseOut="this.src='../image/cartas_button.png';"  
    onMouseOver="this.src='../image/cartas_button-hover.png';"></a>

    </div>
      
      <div onMouseOver="exibir('apImg')" onMouseOut="ocultar('apImg')" class="login_color" id="Img_User">
		<?php
		echo "<img src='".$ImageUser[0]."' />";
		?>
   	  </div>
      
      <div class="login_color" id="area_usuario_down"><img src="../image/UserAreaDown.png" width="188" height="85">

        	<div class="login_color" id="UserCristais">
            	<a><b><?php echo $Qtd_Cristal[0]; ?></b></a>
            </div>
            
            <div class="login_color" id="UserPergaminhos">
            	<a><b><?php echo $Qtd_Pergaminho[0]; ?></b></a>
            </div>
	
    </div>
      
    <div class="login_color" id="UserName"><a><?php echo $row_LogonNome['Pseudonimo']; ?></a></div>
      <div class="login_color" id="UserNivel"><a><b><?php echo $Nivel[0]; ?></b></a></div>
      
    <div class="login_color" id="ConfigButton"><a href="conta.php"><img title="Configurações da conta" src="../image/config_button.png" width="82" height="41"
    	onMouseOut="this.src='../image/config_button.png';"  
      onMouseOver="this.src='../image/config_button-hover3.png';"></a>

    </div>
      
      <div class="login_color" id="ExitButton"><a href="<?php echo $logoutAction ?>"><img title="Sair" src="../image/exit_button.png" width="82" height="41"
      onMouseOut="this.src='../image/exit_button.png';"  
      onMouseOver="this.src='../image/exit_button-hover3.png';"></a>

   	  </div>
      
      <div class="login_color" id="GameButton"><a href="logonapplication.php"><img title="Jogar Agora!" src="../image/game_button.png" width="136" height="56"
      onMouseOut="this.src='../image/game_button.png';"  
      onMouseOver="this.src='../image/game_button-hover.png';"
      ></a></div>
      
      
  <img src="../image/UserArea.png">    </div>
			
            
            <!--   FIM DOS DADOS DO USUARIO -->
            
  			<!-- DIV DE DADOS DA TELA -->
        
    <div class="login_color" id="bg_central2">
        
      <div id="apDiv5">

      
<?php 

echo $table_cartas;

?>

	<div id="apDiv27">
    <div id="apDiv7" style="color:black">
        <a class="att_nv_name"><?php echo $Lista_Nv_Burst_Show[0] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Burst_Show_att[0] ?></a> <br/>
        <a class="att_nv_name"><?php echo $Lista_Nv_Rage_Show[0] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Rage_Show_att[0] ?></a>
      </div>
    <div id="apDiv25" style="color:black">
		        <a class="att_nv_name"><?php echo $Lista_Nv_Ataque_Show[0] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Ataque_Show_att[0] ?></a><br/>
        <a class="att_nv_name"><?php echo $Lista_Nv_Defesa_Show[0] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Defesa_Show_att[0] ?></a>
    </div>
    </div>
    
  
 	<div id="apDiv28">
    <div id="apDiv7" style="color:black">
        <a class="att_nv_name"><?php echo $Lista_Nv_Burst_Show[1] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Burst_Show_att[1] ?></a> <br/>
                <a class="att_nv_name"><?php echo $Lista_Nv_Rage_Show[1] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Rage_Show_att[1] ?></a>
      </div>
    <div id="apDiv25" style="color:black">
		        <a class="att_nv_name"><?php echo $Lista_Nv_Ataque_Show[1] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Ataque_Show_att[1] ?></a><br/>
        <a class="att_nv_name"><?php echo $Lista_Nv_Defesa_Show[1] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Defesa_Show_att[1] ?></a>
    </div>
    </div>
    
  
  	<div id="apDiv29">
    <div id="apDiv7" style="color:black">
        <a class="att_nv_name"><?php echo $Lista_Nv_Burst_Show[2] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Burst_Show_att[2] ?></a> <br/>
                <a class="att_nv_name"><?php echo $Lista_Nv_Rage_Show[2] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Rage_Show_att[2] ?></a>
      </div>
    <div id="apDiv25" style="color:black">
		        <a class="att_nv_name"><?php echo $Lista_Nv_Ataque_Show[2] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Ataque_Show_att[2] ?></a><br/>
        <a class="att_nv_name"><?php echo $Lista_Nv_Defesa_Show[2] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Defesa_Show_att[2] ?></a>
    </div>
    </div>
    
  
  	<div id="apDiv30">
    <div id="apDiv7" style="color:black">
        <a class="att_nv_name"><?php echo $Lista_Nv_Burst_Show[3] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Burst_Show_att[3] ?></a> <br/>
                <a class="att_nv_name"><?php echo $Lista_Nv_Rage_Show[3] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Rage_Show_att[3] ?></a>
      </div>
    <div id="apDiv25" style="color:black">
		        <a class="att_nv_name"><?php echo $Lista_Nv_Ataque_Show[3] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Ataque_Show_att[3] ?></a><br/>
        <a class="att_nv_name"><?php echo $Lista_Nv_Defesa_Show[3] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Defesa_Show_att[3] ?></a>
    </div>
    </div>
   	<div id="apDiv32">
    <div id="apDiv7" style="color:black">
        <a class="att_nv_name"><?php echo $Lista_Nv_Burst_Show[4] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Burst_Show_att[4] ?></a> <br/>
                <a class="att_nv_name"><?php echo $Lista_Nv_Rage_Show[4] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Rage_Show_att[4] ?></a>
      </div>
    <div id="apDiv25" style="color:black">
		        <a class="att_nv_name"><?php echo $Lista_Nv_Ataque_Show[4] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Ataque_Show_att[4] ?></a><br/>
        <a class="att_nv_name"><?php echo $Lista_Nv_Defesa_Show[4] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Defesa_Show_att[4] ?></a>
    </div>
    </div>
    
  
   	<div id="apDiv33">
    <div id="apDiv7" style="color:black">
        <a class="att_nv_name"><?php echo $Lista_Nv_Burst_Show[5] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Burst_Show_att[5] ?></a> <br/>
                <a class="att_nv_name"><?php echo $Lista_Nv_Rage_Show[5] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Rage_Show_att[5] ?></a>
      </div>
    <div id="apDiv25" style="color:black">
		        <a class="att_nv_name"><?php echo $Lista_Nv_Ataque_Show[5] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Ataque_Show_att[5] ?></a><br/>
        <a class="att_nv_name"><?php echo $Lista_Nv_Defesa_Show[5] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Defesa_Show_att[5] ?></a>
    </div>
    </div>
    
  
    	<div id="apDiv34">
    <div id="apDiv7" style="color:black">
        <a class="att_nv_name"><?php echo $Lista_Nv_Burst_Show[6] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Burst_Show_att[6] ?></a> <br/>
                <a class="att_nv_name"><?php echo $Lista_Nv_Rage_Show[6] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Rage_Show_att[6] ?></a>
      </div>
    <div id="apDiv25" style="color:black">
		        <a class="att_nv_name"><?php echo $Lista_Nv_Ataque_Show[6] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Ataque_Show_att[6] ?></a><br/>
        <a class="att_nv_name"><?php echo $Lista_Nv_Defesa_Show[6] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Defesa_Show_att[6] ?></a>
    </div>
    </div>
    
  
    	<div id="apDiv35">
    <div id="apDiv7" style="color:black">
        <a class="att_nv_name"><?php echo $Lista_Nv_Burst_Show[7] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Burst_Show_att[7] ?></a> <br/>
                <a class="att_nv_name"><?php echo $Lista_Nv_Rage_Show[7] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Rage_Show_att[7] ?></a>
      </div>
    <div id="apDiv25" style="color:black">
		        <a class="att_nv_name"><?php echo $Lista_Nv_Ataque_Show[7] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Ataque_Show_att[7] ?></a><br/>
        <a class="att_nv_name"><?php echo $Lista_Nv_Defesa_Show[7] ?></a> <a class="att_nv"><?php echo $Lista_Nv_Defesa_Show_att[7] ?></a>
    </div>
    </div>
    
  
    
  
    
    
    
    
    
    </div>
    <div id="apDiv15">
	<div id="apDiv12" class="Att"><?php echo $Lista_Ataque_Up[0] ?></div>
    <div id="apDiv14" class="Att"><?php echo $Lista_Burst_Up[0] ?></div>
	<div id="apDiv13" class="Att"><?php echo $Lista_Defesa_Up[0] ?></div>
    <div id="apDiv11" class="Att"><?php echo $Lista_Rage_Up[0] ?></div>
    </div>
    <div id="apDiv16">
	<div id="apDiv12" class="Att"><?php echo $Lista_Ataque_Up[1] ?></div>
    <div id="apDiv14" class="Att"><?php echo $Lista_Burst_Up[1] ?></div>
	<div id="apDiv13" class="Att"><?php echo $Lista_Defesa_Up[1] ?></div>
    <div id="apDiv11" class="Att"><?php echo $Lista_Rage_Up[1] ?></div>
    </div>
    <div id="apDiv17">
	<div id="apDiv12" class="Att"><?php echo $Lista_Ataque_Up[2] ?></div>
    <div id="apDiv14" class="Att"><?php echo $Lista_Burst_Up[2] ?></div>
	<div id="apDiv13" class="Att"><?php echo $Lista_Defesa_Up[2] ?></div>
    <div id="apDiv11" class="Att"><?php echo $Lista_Rage_Up[2] ?></div>
    </div>
    <div id="apDiv18">
	<div id="apDiv12" class="Att"><?php echo $Lista_Ataque_Up[3] ?></div>
    <div id="apDiv14" class="Att"><?php echo $Lista_Burst_Up[3] ?></div>
	<div id="apDiv13" class="Att"><?php echo $Lista_Defesa_Up[3] ?></div>
    <div id="apDiv11" class="Att"><?php echo $Lista_Rage_Up[3] ?></div>
    </div>
    <div id="apDiv20">
	<div id="apDiv12" class="Att"><?php echo $Lista_Ataque_Up[4] ?></div>
    <div id="apDiv14" class="Att"><?php echo $Lista_Burst_Up[4] ?></div>
	<div id="apDiv13" class="Att"><?php echo $Lista_Defesa_Up[4] ?></div>
    <div id="apDiv11" class="Att"><?php echo $Lista_Rage_Up[4] ?></div>
    </div>
    <div id="apDiv21">
	<div id="apDiv12" class="Att"><?php echo $Lista_Ataque_Up[5] ?></div>
    <div id="apDiv14" class="Att"><?php echo $Lista_Burst_Up[5] ?></div>
	<div id="apDiv13" class="Att"><?php echo $Lista_Defesa_Up[5] ?></div>
    <div id="apDiv11" class="Att"><?php echo $Lista_Rage_Up[5] ?></div>
    </div>
    <div id="apDiv22">
	<div id="apDiv12" class="Att"><?php echo $Lista_Ataque_Up[6] ?></div>
    <div id="apDiv14" class="Att"><?php echo $Lista_Burst_Up[6] ?></div>
	<div id="apDiv13" class="Att"><?php echo $Lista_Defesa_Up[6] ?></div>
    <div id="apDiv11" class="Att"><?php echo $Lista_Rage_Up[6] ?></div>
    </div>
    <div id="apDiv23">
	<div id="apDiv12" class="Att"><?php echo $Lista_Ataque_Up[7] ?></div>
    <div id="apDiv14" class="Att"><?php echo $Lista_Burst_Up[7] ?></div>
	<div id="apDiv13" class="Att"><?php echo $Lista_Defesa_Up[7] ?></div>
    <div id="apDiv11" class="Att"><?php echo $Lista_Rage_Up[7] ?></div>
    </div>
    
    <div id="apDiv">
      <h1 id="titulo_">Deck</h1></div>

    <!-- display grid here -->

  </div>

        
  </div>
<div id="apDiv37"></div>
        
        	<!-- FIM -->
            
            <!-- RODAPE -->
            
  <div class="logon_logo" id="LastDiv">
    		<p>© 2013 Cards Of Pandora  		</p>
        </div>
        
        	<!-- FIM RODAPE -->
            
    <div id="conector2">
    
    	<img src="img/conector.png" />
    
    </div>
      <div id="apImgURL">
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
  <a id="btn_close" onClick="ocultar('apImgURL')"> X </a>
  <br />
            <label for="FotoURL" > Imagem (jpg): </label><br />
            <input type="hidden" name="cad_img" value="img" />
            <input value="Selecionar Foto" type="file" name="FotoURL" id="FotoURL" required> 
  			<input type="submit" class="bradiusBTN" value="Atualizar">
  		  </form>
</div>
<div onMouseMove="exibir('apImg')" onMouseOut="ocultar('apImg')" onClick="exibir('apImgURL')" id="apImg">Alterar</div>
<div id="Fortalecer"><a  href="fortalecer.php"><img src="../image/fortalecer_btn.png" width="144" height="96"
       onMouseOut="this.src='../image/fortalecer_btn.png';"  
       onMouseOver="this.src='../image/fortalecer_btn_hover.png';"
       
       ></a></div>
</div>
</div>
</body>
</html>
<?php
mysql_free_result($LogonNome);

mysql_free_result($srId);
?>
