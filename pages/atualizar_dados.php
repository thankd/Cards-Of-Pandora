<?php require_once('../Connections/conexao.php'); ?>
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
mysql_select_db($database_conexao, $conexao);
$query_LogonNome = sprintf("SELECT Pseudonimo FROM pessoa WHERE Email = %s", GetSQLValueString($colname_LogonNome, "text"));
$LogonNome = mysql_query($query_LogonNome, $conexao) or die(mysql_error());
$row_LogonNome = mysql_fetch_assoc($LogonNome);
$totalRows_LogonNome = mysql_num_rows($LogonNome);

$colname_srId = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_srId = $_SESSION['MM_Username'];
}
mysql_select_db($database_conexao, $conexao);
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
		
		$Qtd_Pergaminho = 0;
		$Qtd_PergaminhoBusca = mysql_query("SELECT DISTINCT QtdPergaminho FROM inventario WHERE IdPessoa='$SecId'");
		$Qtd_Pergaminho = mysql_fetch_row($Qtd_PergaminhoBusca);
		
?>
<?php
// Conexão com o banco de dados

// Se o usuário clicou no botão cadastrar efetua as ações
$retorno = "";
		
		$r = "";
		if (isset($_GET['r'])) {
        $r = $_GET['r'];
		}
		
		if($r == "send"){
			$retorno = "Dados atualizados";
		} if($r == "not") {
			$retorno = "Use uma imagem .jpg";	
		}

if(isset($_POST['cad_dados']) && $_POST['cad_dados'] == 'dados'){
	
	// Recupera os dados dos campos
	$error=0;
	$ren = "";
	$nome = $_POST['nome'];
	$pseudonimo = $_POST['pseudonimo'];
	$email = $_POST['email'];
	$foto = $_FILES["FotoURL"];
	
			// Insere os dados no banco
			$sql = mysql_query("UPDATE pessoa 
			SET Nome='$nome', Pseudonimo='$pseudonimo', Email='$email' 
			WHERE IdPessoa='$SecId'");
					$ren = "send";
			if (!empty($foto["name"])) {
		
			// Largura máxima em pixels
			$largura = 1000;
			// Altura máxima em pixels
			$altura = 1000;
			// Tamanho máximo do arquivo em bytes
			$tamanho = 2000;
			
		 	// Verifica se o arquivo é uma imagem
    		if(!eregi("^image\/(pjpeg|jpeg|jpg)$", $foto["type"])){
     	  		$ren = "not";
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
	
			header("Location: atualizar_dados.php?r=$ren");

}

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
			header("Location: atualizar_dados.php");
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
<link href="Script/css/atu_dados.css" rel="stylesheet" type="text/css">
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
        
    <div class="login_color" id="bg_central">
        <div id="apDiv6"><?php echo $retorno; ?></div>
        <p>&nbsp;</p>
  		  <form class="atualizar" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="atualizar"> 			
          <fieldset>
          <legend> Atualizar Dados </legend>
          <br><label style="font: italic small-caps bold 17px 'Verdana', sans-serif;"  for="nome"> Nome: </label>
          	  <input name="nome" type="text" id="estiloC" size="21"  maxlength="15" class="txt bradius" value="<?php print $NomeUser[0]; ?>" required> <br>
          	  <label style="font: italic small-caps bold 17px 'Verdana', sans-serif;" for="pseudonimo"> Pseudonimo: </label>
          	  <input name="pseudonimo" type="text" id="estiloC" size="21" maxlength="10" class="txt bradius" value="<?php print $PseudonimoUser[0]; ?>" required> <br>
          	  <label style="font: italic small-caps bold 17px 'Verdana', sans-serif;" for="email"> E-Mail: </label>
          	  <input name="email" type="email" id="estiloC" size="21" maxlength="50" class="txt bradius" value="<?php print $EmailUser[0]; ?>" required>   <br>
          	 <label style="font: italic small-caps bold 17px 'Verdana', sans-serif;" for="FotoURL" id="newss"> Foto (.jpg): </label>
          	  <input value="Selecionar Foto" type="file" name="FotoURL" id="FotoURL" > <br>
   	         <input type="hidden" name="cad_dados" value="dados" />
            <input name="Redefinir" type="reset" class="bradiusBTN" id="Redefinir" value="Redefinir">
   	        <input type="submit" name="atualizar" value="Atualizar" class="bradiusBTN">
  		  </fieldset>
  		  </form>
        
        
               </div>
        
        	<!-- FIM -->
            
            <!-- RODAPE -->
            
    <div class="logon_logo" id="LastDiv">
    		<p>© 2013 Cards Of Pandora  		</p>
        </div>
        
        	<!-- FIM RODAPE -->
            
    <div id="conector">
    
    	<img src="img/conector.png" />
    
    </div>
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
</body>
</html>
<?php
mysql_free_result($LogonNome);

mysql_free_result($srId);
?>
