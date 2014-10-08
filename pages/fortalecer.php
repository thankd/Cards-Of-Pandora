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

// include and create object
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
			if($Qtd < 8){
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

function Selecionar_Carta_Fortalecer($id){
	echo "<div id='Carta_Area' class='Carta_Area'> <img src='img/ddl_cartas/$Lista_Nomes[$id].png'> </div>";
	print_r ($Lista_Nomes);
}

$modify = "";
if (isset($_GET['modify'])) {
				$modify = $_GET['modify'];
		}
$erroT = "";
if (isset($_GET['erro'])) {
				$erroT = $_GET['erro'];
		}	

$id_modify = $_GET['id'];
$sessao_cartas = $_GET['sessao'];



$Lista_Ids = array();
$resultado = mysql_query("SELECT distinct idcartainventario FROM cartainventario WHERE idinventario = '$SecId'  ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Ids[] = $linha['idcartainventario'];
//-------------------------------------------------------------------------------------------------------
$Lista_Nomes = array();
$resultado = mysql_query("SELECT a.nome FROM carta a, cartainventario b WHERE b.idinventario = '$SecId' and b.idcarta = a.idcarta ORDER BY idcartainventario ASC" ); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Nomes[] = $linha['nome'];
//-------------------------------------------------------------------------------------------------------
$Lista_Burst_Up = array();
$resultado = mysql_query("SELECT Burst_up FROM cartainventario WHERE idinventario = '$SecId' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Burst_Up[] = $linha['Burst_up'];
//------------------------------------------------------------------------------------------------------
$Lista_Rage_Up = array();
$resultado = mysql_query("SELECT Rage_up FROM cartainventario WHERE idinventario = '$SecId' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Rage_Up[] = $linha['Rage_up'];
//-------------------------------------------------------------------------------------------------------	
$Lista_Ataque_Up = array();
$resultado = mysql_query("SELECT Ataque_up FROM cartainventario WHERE idinventario = '$SecId' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Ataque_Up[] = $linha['Ataque_up'];
//-------------------------------------------------------------------------------------------------------	
$Lista_Defesa_Up = array();
$resultado = mysql_query("SELECT Defesa_up FROM cartainventario WHERE idinventario = '$SecId' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Defesa_Up[] = $linha['Defesa_up'];
//-------------------------------------------------------------------------------------------------------	
$Lista_Nv_Burst = array();
$resultado = mysql_query("SELECT Nv_Burst FROM cartainventario WHERE idinventario = '$SecId' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Nv_Burst[] = $linha['Nv_Burst'];
//-------------------------------------------------------------------------------------------------------	
$Lista_Nv_Rage = array();
$resultado = mysql_query("SELECT Nv_Rage FROM cartainventario WHERE idinventario = '$SecId' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Nv_Rage[] = $linha['Nv_Rage'];
//-------------------------------------------------------------------------------------------------------	
$Lista_Nv_Ataque = array();
$resultado = mysql_query("SELECT Nv_Ataque FROM cartainventario WHERE idinventario = '$SecId' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Nv_Ataque[] = $linha['Nv_Ataque'];
//-------------------------------------------------------------------------------------------------------	
$Lista_Nv_Defesa = array();
$resultado = mysql_query("SELECT Nv_Defesa FROM cartainventario WHERE idinventario = '$SecId' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Nv_Defesa[] = $linha['Nv_Defesa'];
//-------------------------------------------------------------------------------------------------------	
$Lista_Deck_Estado = array();																			
$resultado = mysql_query("SELECT Deck_Estado FROM cartainventario WHERE idinventario = '$SecId' ORDER BY idcartainventario ASC"); 		
while ($linha = mysql_fetch_array($resultado))															
    $Lista_Deck_Estado[] = $linha['Deck_Estado'];														
//-------------------------------------------------------------------------------------------------------
$Lista_Região = array();
$resultado = mysql_query("SELECT a.Descricao FROM cartatipo a, cartainventario b, carta c WHERE b.idinventario = '$SecId' AND b.idcarta = c.idcarta AND c.idtipocarta = a.idtipocarta ORDER BY idcartainventario ASC"); 
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

$sem_grana = "";

if(isset($_POST['cad_users']) && $_POST['cad_users'] == 'cad'){
	
	$id_vetor_carta     = $_GET['id'];
	$id_carta_atualizar = $Lista_Ids[$id_vetor_carta];
	$att                = $_POST["fortalecer_op"];	
	$Precos  = array(1 => 5, 2 => 5, 3 =>15, 4=>15, 5=>30, 6=>50);
	$Att_add = array(1 => 2, 2 => 2, 3 =>3, 4=>3, 5=>4, 6=>5);
	
	
	if($att == "burst"){
		$burst_att = $Lista_Burst_Up[$id_vetor_carta];
		$nv_burst_att = $Lista_Nv_Burst[$id_vetor_carta];
		
		$new_burst_up = $burst_att + $Att_add[$nv_burst_att];
		$new_burst = $nv_burst_att + 1;
		
		$c_sucesso = rand(1,100);
		$_sucesso = false;
		$_pago = false;
		
		$total_pergaminhos = $Qtd_Pergaminho[0];
		$preco_discontado = $total_pergaminhos - $Precos[$nv_burst_att];
		
		if($preco_discontado >= 0){
			$_pago = true;	
			$sql = mysql_query("UPDATE inventario 
				SET qtdpergaminho='$preco_discontado' 
				WHERE IdInventario='$SecId'");	
		} else {
			$sem_grana = "Você não possui pergaminhos suficiente!";
		}
		
		if($nv_burst_att == 1){if($c_sucesso <= 70){$_sucesso = true;}}
		if($nv_burst_att == 2){if($c_sucesso <= 50){$_sucesso = true;}}
		if($nv_burst_att == 3){if($c_sucesso <= 30){$_sucesso = true;}}
		if($nv_burst_att == 4){if($c_sucesso <= 30){$_sucesso = true;}}
		if($nv_burst_att == 5){if($c_sucesso <= 20){$_sucesso = true;}}
		if($nv_burst_att == 6){if($c_sucesso <= 10){$_sucesso = true;}}
		
		if($_pago){
		if($_sucesso){
		$sql = mysql_query("UPDATE cartainventario 
							SET nv_burst='$new_burst', burst_up='$new_burst_up' 
							WHERE idcartainventario = '$id_carta_atualizar'");
		 header('Location: tentando_fortalecer.php?try=sucesso&id='.$id_modify.'&sessao='.$sessao_cartas.'&att=burst&pp='.$new_burst);   
		} else {
		 header('Location: tentando_fortalecer.php?try=falha&id='.$id_modify.'&sessao='.$sessao_cartas.'&att=burst&pp='.$new_burst);   
		}
		}
		
	} else
	if($att == "rage"){
		$rage_att = $Lista_Rage_Up[$id_vetor_carta];
		$nv_rage_att = $Lista_Nv_Rage[$id_vetor_carta];
		
		$new_rage_up = $rage_att + $Att_add[$nv_rage_att];
		$new_rage = $nv_rage_att + 1;
		
		$c_sucesso = rand(1,100);
		$_sucesso = false;
		$_pago = false;
		
		$total_pergaminhos = $Qtd_Pergaminho[0];
		$preco_discontado = $total_pergaminhos - $Precos[$nv_rage_att];
		
		if($preco_discontado >= 0){
			$_pago = true;	
			$sql = mysql_query("UPDATE inventario 
				SET qtdpergaminho='$preco_discontado' 
				WHERE IdInventario='$SecId'");	
		} else {
				$sem_grana = "Você não possui pergaminhos suficiente!";
		}
		
		if($nv_rage_att == 1){if($c_sucesso <= 70){$_sucesso = true;}}
		if($nv_rage_att == 2){if($c_sucesso <= 50){$_sucesso = true;}}
		if($nv_rage_att == 3){if($c_sucesso <= 30){$_sucesso = true;}}
		if($nv_rage_att == 4){if($c_sucesso <= 30){$_sucesso = true;}}
		if($nv_rage_att == 5){if($c_sucesso <= 20){$_sucesso = true;}}
		if($nv_rage_att == 6){if($c_sucesso <= 10){$_sucesso = true;}}
		
		if($_pago){
		if($_sucesso){
		$sql = mysql_query("UPDATE cartainventario 
							SET nv_rage='$new_rage', rage_up='$new_rage_up' 
							WHERE idcartainventario = '$id_carta_atualizar'");
		 header('Location: tentando_fortalecer.php?try=sucesso&id='.$id_modify.'&sessao='.$sessao_cartas.'&att=rage&pp='.$new_rage);   
		} else {
		 header('Location: tentando_fortalecer.php?try=falha&id='.$id_modify.'&sessao='.$sessao_cartas.'&att=rage&pp='.$new_rage); 
		}
		}
		
	} else
	if($att == "ataque"){
		$ataque_att = $Lista_Ataque_Up[$id_vetor_carta];
		$nv_ataque_att = $Lista_Nv_Ataque[$id_vetor_carta];
		
		$new_ataque_up = $ataque_att + $Att_add[$nv_ataque_att];
		$new_ataque = $nv_ataque_att + 1;
		
		$c_sucesso = rand(1,100);
		$_sucesso = false;
		$_pago = false;
		
		$total_pergaminhos = $Qtd_Pergaminho[0];
		$preco_discontado = $total_pergaminhos - $Precos[$nv_ataque_att];
		
		if($preco_discontado >= 0){
			$_pago = true;	
			$sql = mysql_query("UPDATE inventario 
				SET qtdpergaminho='$preco_discontado' 
				WHERE IdInventario='$SecId'");	
		} else {
			$sem_grana = "Você não possui pergaminhos suficiente!";
		}
		
		if($nv_ataque_att == 1){if($c_sucesso <= 70){$_sucesso = true;}}
		if($nv_ataque_att == 2){if($c_sucesso <= 50){$_sucesso = true;}}
		if($nv_ataque_att == 3){if($c_sucesso <= 30){$_sucesso = true;}}
		if($nv_ataque_att == 4){if($c_sucesso <= 30){$_sucesso = true;}}
		if($nv_ataque_att == 5){if($c_sucesso <= 20){$_sucesso = true;}}
		if($nv_ataque_att == 6){if($c_sucesso <= 10){$_sucesso = true;}}
		
		if($_pago){
		if($_sucesso){
		$sql = mysql_query("UPDATE cartainventario 
							SET nv_ataque='$new_ataque', ataque_up='$new_ataque_up' 
							WHERE idcartainventario = '$id_carta_atualizar'");
		 header('Location: tentando_fortalecer.php?try=sucesso&id='.$id_modify.'&sessao='.$sessao_cartas.'&att=ataque&pp='.$new_ataque);   
		} else {
		 header('Location: tentando_fortalecer.php?try=falha&id='.$id_modify.'&sessao='.$sessao_cartas.'&att=ataque&pp='.$new_ataque);   
		}
		}
		
	} else
	if($att == "defesa"){
		$defesa_att = $Lista_Defesa_Up[$id_vetor_carta];
		$nv_defesa_att = $Lista_Nv_Defesa[$id_vetor_carta];
		
		$new_defesa_up = $defesa_att + $Att_add[$nv_defesa_att];
		$new_defesa = $nv_defesa_att + 1;
		
		$c_sucesso = rand(1,100);
		$_sucesso = false;
		$_pago = false;
		
		$total_pergaminhos = $Qtd_Pergaminho[0];
		$preco_discontado = $total_pergaminhos - $Precos[$nv_defesa_att];
		
		if($preco_discontado >= 0){
			$_pago = true;	
			$sql = mysql_query("UPDATE inventario 
				SET qtdpergaminho='$preco_discontado' 
				WHERE IdInventario='$SecId'");	
		} else {
		$sem_grana = "Você não possui pergaminhos suficiente!";
		}
		
		if($nv_defesa_att == 1){if($c_sucesso <= 70){$_sucesso = true;}}
		if($nv_defesa_att == 2){if($c_sucesso <= 50){$_sucesso = true;}}
		if($nv_defesa_att == 3){if($c_sucesso <= 30){$_sucesso = true;}}
		if($nv_defesa_att == 4){if($c_sucesso <= 30){$_sucesso = true;}}
		if($nv_defesa_att == 5){if($c_sucesso <= 20){$_sucesso = true;}}
		if($nv_defesa_att == 6){if($c_sucesso <= 10){$_sucesso = true;}}
		
		if($_pago){
		if($_sucesso){
		$sql = mysql_query("UPDATE cartainventario 
							SET nv_defesa='$new_defesa', defesa_up='$new_defesa_up' 
							WHERE idcartainventario = '$id_carta_atualizar'");
		 header('Location: tentando_fortalecer.php?try=sucesso&id='.$id_modify.'&sessao='.$sessao_cartas.'&att=defesa&pp='.$new_defesa);   
		} else {
		 header('Location: tentando_fortalecer.php?try=falha&id='.$id_modify.'&sessao='.$sessao_cartas.'&att=defesa&pp='.$new_defesa);   
		}
		}
		
	
		
		
		
	}
	
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
			header("Location: fortalecer.php");
}		

?>
<!doctype html>
<html>
<head>


<meta charset="utf-8">
<title>Cards Of Pandora Online</title>
<link href="../script/script.css" rel="stylesheet" type="text/css">
<link href="Script/css/fortalecer.css" rel="stylesheet" type="text/css">
<!-- Cor do plano de fundo -->
<style type="text/css"> body { background-color: #FFF;  } </style>

<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
</head>

<body>

<script type="text/javascript">

function ocultar(erro){
			x = document.getElementById(erro);
			x.style.display = "none";
}
			
function exibir(erro){
			x = document.getElementById(erro);
			x.style.display = "block";
}

function Verificar_Nv_Atual(n){
if(n=="Burst"){
var mensagem = "<?php echo $Lista_Nv_Burst[$id_modify]; ?>";
} else if(n=="Rage") {
var mensagem = "<?php echo $Lista_Nv_Rage[$id_modify]; ?>";	
} else if(n=="Ataque") {
var mensagem = "<?php echo $Lista_Nv_Ataque[$id_modify]; ?>";
} else if(n=="Defesa") {
var mensagem = "<?php echo $Lista_Nv_Defesa[$id_modify]; ?>";
}
var obj = document.getElementById("container_fortalecer");
var obj2 = document.getElementById("container_chances");
var obj3 = document.getElementById("container_valor");

var plus = "";
var chances = "";
var valor = "";

	if(mensagem == "1"){
	plus = "2";
	chances = "70%";
	valor = "5";	
	}
	if(mensagem == "2"){
	plus = "3";
	chances = "50%";
	valor = "5";
	}
	if(mensagem == "3"){
	plus = "4";
	chances = "30%";
	valor = "15";
	}
	if(mensagem == "4"){
	plus = "5";
	chances = "30%";
	valor = "15";
	}
	if(mensagem == "5"){
	plus = "6";
	chances = "20%";
	valor = "30";
	}
	if(mensagem == "6"){
	plus = "7";
	chances = "10%";
	valor = "50";
	}
	

obj.innerHTML = "+" + mensagem + " Fortalecer Para " + "+" + plus;
obj2.innerHTML = "Chances de Sucesso: " + chances;
obj3.innerHTML = "Preço: " + valor + " Pergaminhos";





}
</script>



<div id="apDiv11">
<p id="container_fortalecer"></p>
<p id="container_chances"></p>
<p id="container_valor"><p>
</div>


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
      
      <div  onMouseOver="exibir('apImg')" onMouseOut="ocultar('apImg')"  class="login_color" id="Img_User">
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
     <h1 id="titulo_">Fortalecer Carta</h1>
    <div id="apDiv12">
    

 <?php 
 
 if($id_modify!=""){
	 $url_img = str_replace(" ","_",$Lista_Nomes[$id_modify]);
	 $url_img = strtolower($url_img);
	 if($Lista_Nomes[$id_modify] == "Fate - E"){
		 $url_img = "fate-e";
	 } else
	 if($Lista_Nomes[$id_modify] == "Fate - K"){
		 $url_img = "fate-k";
	 }
	echo "<div id='Carta_Area'> <img src='img/ddl_cartas/$url_img.png'></div> 
	<div id='apDiva15'>
	<div id='apDiva12' class='Att'> $Lista_Defesa_Up[$id_modify] </div>
    <div id='apDiva14' class='Att'> $Lista_Burst_Up[$id_modify] </div>
	<div id='apDiva13' class='Att'> $Lista_Ataque_Up[$id_modify]</div>
    <div id='apDiva11' class='Att'> $Lista_Rage_Up[$id_modify] </div>
	<div id='apDiva_defesa' class='Att'> +$Lista_Nv_Defesa[$id_modify] </div>
    <div id='apDiva_burst' class='Att'> +$Lista_Nv_Burst[$id_modify] </div>
	<div id='apDiva_ataque' class='Att'> +$Lista_Nv_Ataque[$id_modify]</div>
    <div id='apDiva_rage' class='Att'> +$Lista_Nv_Rage[$id_modify] </div>
    </div>";
}
	
echo "<table border='0' class='Tabela_DinamicaTOP'>
<tr>
<td><?php echo . $i . ?></td>
<td width='115px' align='center'>Nome</td>
<td width='57px' align='center'>Burst</td>
<td width='57px' align='center'>Rage</td>
<td width='57px' align='center'>Ataque</td>
<td width='57px' align='center'>Defesa</td>
<td >  </a></td>
</tr>
</table>
";	

	
	
$qtd_total = count($Lista_Ids);
$qtd_paginas = 0;
$qtd_total_de_cartas = count($Lista_Ids);

while($qtd_total > 0){	
	if($qtd_total > 10){
		$qtd_total = $qtd_total - 10;
		$qtd_paginas++;
	} else {
		$qtd_total = $qtd_total - $qtd_total;
		$qtd_paginas++;	
	}
}


if($sessao_cartas == 1){
	$i = 0;
	$fim = 9;
} else if($sessao_cartas == 2){
	$i = 10;
	$fim = 19;
}else if($sessao_cartas == 3){
	$i = 20;
	$fim = 29;
}else if($sessao_cartas == 4){
	$i = 30;
	$fim = 39;
}else if($sessao_cartas == 5){
	$i = 40;
	$fim = 49;
} else {
$i=0;
$fim = 9;
}

while(($i <= $fim) && ($i < $qtd_total_de_cartas))
{
echo "<table border='0' class='Tabela_Dinamica' id=''>
<tr>
<td><?php echo . $i . ?></td>
<td width='30px' height='30px' align='left'>$Regiao_Img_Link[$i]</td>
<td width='85px'  align='left'>$Lista_Nomes[$i]</td>
<td width='32px' align='right'>$Lista_Burst_Up[$i]</td>
<td width='15px' align='left' class='Nivel_Up'>+$Lista_Nv_Burst[$i]</td>
<td width='32px' align='right'>$Lista_Rage_Up[$i]</td>
<td width='15px' align='left' class='Nivel_Up'>+$Lista_Nv_Rage[$i]</td>
<td width='32px' align='right'>$Lista_Ataque_Up[$i]</td>
<td width='15px' align='left' class='Nivel_Up'>+$Lista_Nv_Ataque[$i]</td>
<td width='32px' align='right'>$Lista_Defesa_Up[$i]</td>
<td width='28px' align='left' class='Nivel_Up'>+$Lista_Nv_Defesa[$i]</td>
<td class='Tabela_Dinamica_ohe' > <a href=?id=$i&sessao=$sessao_cartas> <img src='img/setas/btn_selecionar.png'> </a></td>
</tr>
</table>
";
$i++;
}


$x = "<script>document.write(mensagem)</script>";
echo $x;

	
	
?> 

</div>
        <div id="apDiv5">
          <div id="apDiv10">
         <?php if($id_modify!=''){ ?>
            <p>► O que deseja fortalecer?</p>
        <form name="form1" method="post" action="">
          <p>
            <input type="radio" name="fortalecer_op" id="fortalecer_op" value="burst" onClick="Verificar_Nv_Atual('Burst')" required >
            <label for="fortalecer_op">Burst</label> 
            <input type="radio" name="fortalecer_op" id="fortalecer_op" value="ataque" onClick="Verificar_Nv_Atual('Ataque')"required >
            Ataque
          </p>
          <p>
            <input type="radio" name="fortalecer_op" id="fortalecer_op" value="rage" onClick="Verificar_Nv_Atual('Rage')" required>
            <label for="fortalecer_op3">Rage</label>
            <input type="radio" name="fortalecer_op" id="fortalecer_op" value="defesa" onClick="Verificar_Nv_Atual('Defesa')" required>
            <label for="fortalecer_op4">Defesa</label>
            <input type="hidden" name="cad_users" value="cad" />
          </p>  <br /> <br />  <br /> <br /> <br /> <br />
          <input class="bradiusBTN" type="submit" value="Fortalecer!" style="margin-left:40px;width:100px;">
        </form>
         <?php }?>
    </div>
    </div>
        <div id="Paginas">&lt;
        <?php 
		for($r = 1; $r <= $qtd_paginas; $r++){
			echo("<a href='fortalecer.php?sessao=$r'> $r </a>");
		}
        ?> &gt;</div>
        <div id="Fortalecer"><a  href="fortalecer.php"><img src="../image/fortalecer_btn.png" width="144" height="96"
       onMouseOut="this.src='../image/fortalecer_btn.png';"  
       onMouseOver="this.src='../image/fortalecer_btn_hover.png';"
       
       ></a></div>
    </div>
    <div id="apDiv13"><?php echo $sem_grana; ?></div>
        
        	<!-- FIM -->
            
            <!-- RODAPE -->
            
    <div class="logon_logo" id="LastDiv">
    		<p>© 2013 Cards Of Pandora  		</p>
    </div>
        
        	<!-- FIM RODAPE -->
            
    <div id="conector">
    
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
</div>
<div id="apDiv16">Nenhuma carta foi selecionada</div>
<div id="apDiv15">N° da página: <?php if($sessao_cartas == "") echo "1"; else echo $sessao_cartas; ?></div>
<div id="apDiv14">Aqui é possível fortalecer suas cartas, cada tentativa à uma certa chance de sucesso, caso você consiga, os pontos da sua carta subiram!</div>
</div>
</body>
</html>
<?php
mysql_free_result($LogonNome);

mysql_free_result($srId);
?>
