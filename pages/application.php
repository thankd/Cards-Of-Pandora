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

$erro             = "";
		
		$ImageUser = "";
		$ImageBusca = mysql_query("SELECT DISTINCT URL_Img FROM pessoa WHERE IdPessoa='$SecId'");
		$ImageUser = mysql_fetch_row($ImageBusca);
		
		$Nivel = 0;
		$NivelBusca = mysql_query("SELECT DISTINCT Nivel FROM nivel A, inventario B WHERE B.IdPessoa='$SecId' and B.IdNivel = A.IdNivel");
		$Nivel = mysql_fetch_row($NivelBusca);
		
		$Qtd_Cristal = 0;
		$Qtd_CristalBusca = mysql_query("SELECT DISTINCT QtdCristais FROM inventario WHERE IdPessoa='$SecId'");
		$Qtd_Cristal = mysql_fetch_row($Qtd_CristalBusca);
		
		$Qtd_Pergaminho = 0;
		$Qtd_PergaminhoBusca = mysql_query("SELECT DISTINCT QtdPergaminho FROM inventario WHERE IdPessoa='$SecId'");
		$Qtd_Pergaminho = mysql_fetch_row($Qtd_PergaminhoBusca);
		
		$Qtd_Xp = 0;
		$Qtd_XpBusca = mysql_query("SELECT DISTINCT xp FROM inventario WHERE IdPessoa='$SecId'");
		$Qtd_Xp = mysql_fetch_row($Qtd_XpBusca);
		
		$Qtd_Elo = 0;
		$Qtd_EloBusca = mysql_query("SELECT Elo FROM pessoa WHERE IdPessoa='$SecId'");
		$Qtd_Elo = mysql_fetch_row($Qtd_EloBusca);

		
		$Qtd_next_nivel = 0;
		$Qtd_next_nivelBusca = mysql_query("SELECT DISTINCT idnivel FROM inventario WHERE IdPessoa='$SecId'");
		$Qtd_next_nivel = mysql_fetch_row($Qtd_next_nivelBusca);
		$next_nivel = $Qtd_next_nivel[0];
		
		$Qtd_IdNivel = 0;
		$Qtd_IdNivelBusca = mysql_query("SELECT DISTINCT xp FROM nivel WHERE IdNivel='$next_nivel'");
		$Qtd_IdNivel = mysql_fetch_row($Qtd_IdNivelBusca);
		
		$xp_need = $Qtd_IdNivel[0];
		
		$Qtd_NAcesso = 0;
		$Qtd_NAcessoBusca = mysql_query("SELECT DISTINCT NAcesso FROM inventario WHERE IdPessoa='$SecId'");
		$Qtd_NAcesso = mysql_fetch_row($Qtd_NAcessoBusca);
		
		$lg    = "";
		if (isset($_GET['lg'])) {
				$lg = $_GET['lg'];
		}
		
$Lista_Nomes = array();
$resultado = mysql_query("SELECT a.nome FROM carta a, cartainventario b WHERE b.idinventario = '$SecId' and b.idcarta = a.idcarta and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Nomes[] = $linha['nome'];
$Array_Nomes = implode("|", $Lista_Nomes);
//-------------------------------------------------------------------------------------------------------
$Lista_Burst_Up = array();
$resultado = mysql_query("SELECT Burst_up FROM cartainventario WHERE idinventario = '$SecId'  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Burst_Up[] = $linha['Burst_up'];
$Array_Burst = implode("|", $Lista_Burst_Up);
//------------------------------------------------------------------------------------------------------
$Lista_Rage_Up = array();
$resultado = mysql_query("SELECT Rage_up FROM cartainventario WHERE idinventario = '$SecId'  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Rage_Up[] = $linha['Rage_up'];
$Array_Rage = implode("|", $Lista_Rage_Up);
//-------------------------------------------------------------------------------------------------------	
$Lista_Ataque_Up = array();
$resultado = mysql_query("SELECT Ataque_up FROM cartainventario WHERE idinventario = '$SecId'  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Ataque_Up[] = $linha['Ataque_up'];
$Array_Ataque = implode("|", $Lista_Ataque_Up);
//-------------------------------------------------------------------------------------------------------	
$Lista_Defesa_Up = array();
$resultado = mysql_query("SELECT Defesa_up FROM cartainventario WHERE idinventario = '$SecId'  and deck_estado = 'true' ORDER BY idcartainventario ASC"); 
while ($linha = mysql_fetch_array($resultado))
    $Lista_Defesa_Up[] = $linha['Defesa_up'];
$Array_Defesa = implode("|", $Lista_Defesa_Up);
//-------------------------------------------------------------------------------------------------------	


$relog    = "";
$cristais = "";
$xp       = "";
$sf       = "";
$Elo      = "";
$NA_Atual = "";

if (isset($_GET['relog'])) {
        $relog = $_GET['relog'];
    	}
if (isset($_GET['cristais'])) {
        $cristais = $_GET['cristais'];
    	}
if (isset($_GET['xp'])) {
        $xp = $_GET['xp'];
    	}
if (isset($_GET['sf'])) {
        $sf = $_GET['sf'];
    	}
if (isset($_GET['elo'])) {
        $Elo = $_GET['elo'];
    	}
if (isset($_GET['NAtual'])) {
        $NA_Atual = $_GET['NAtual'];
    	}
		
$cristais_totais = $Qtd_Cristal[0];
$xp_totais = $Qtd_Xp[0];
$Elo_antigo = $Qtd_Elo[0];
$new_Elo = $Elo_antigo;
$s = $new_Elo;

$cristais = $cristais;
$xp = $xp;
$new_Elo = $s + $Elo;

$cristais_totais = $cristais_totais + $cristais;
$xp_totais       = $xp_totais + $xp;
$proximo_NAcesso = $Qtd_NAcesso[0] + 1;

if($relog == "validate"){

	$sql = mysql_query("UPDATE inventario 
				SET qtdcristais='$cristais_totais' 
				WHERE idinventario='$SecId'");	
				
	$sql = mysql_query("UPDATE pessoa 
				SET Elo='$new_Elo' 
				WHERE idpessoa='$SecId'");
			
	if($xp_totais >= $xp_need){
	
	$xp_totais = $xp_totais - $xp_need;
	$proximo_nivel = $next_nivel + 1;
	
	$sql = mysql_query("UPDATE inventario 
				SET xp='$xp_totais' 
				WHERE idinventario='$SecId'");		
	
	$sql = mysql_query("UPDATE inventario 
				SET idnivel='$proximo_nivel' 
				WHERE idinventario='$SecId'");
	} else {
		$sql = mysql_query("UPDATE inventario 
				SET xp='$xp_totais' 
				WHERE idinventario='$SecId'");	
	}
	
	if($NA_Atual == $Qtd_NAcesso[0]){
	if($sf=="vitoria"){
	if($proximo_NAcesso <= 16){	
	$sql = mysql_query("UPDATE inventario 
				SET NAcesso='$proximo_NAcesso' 
				WHERE idinventario='$SecId'");
	}
	}
	}
	
	$Nivel = 0;
	$NivelBusca = mysql_query("SELECT DISTINCT Nivel FROM Nivel A, Inventario B WHERE B.IdPessoa='$SecId' and B.IdNivel = A.IdNivel");
	$Nivel = mysql_fetch_row($NivelBusca);
	
	$Qtd_next_nivel = 0;
	$Qtd_next_nivelBusca = mysql_query("SELECT DISTINCT idnivel FROM Inventario WHERE IdPessoa='$SecId'");
	$Qtd_next_nivel = mysql_fetch_row($Qtd_next_nivelBusca);
	$next_nivel = $Qtd_next_nivel[0];
		
	$Qtd_IdNivel = 0;
	$Qtd_IdNivelBusca = mysql_query("SELECT DISTINCT xp FROM nivel WHERE IdNivel='$next_nivel'");
	$Qtd_IdNivel = mysql_fetch_row($Qtd_IdNivelBusca);
		
	$xp_need = $Qtd_IdNivel[0];

}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cards Of Pandora Online</title>
<script src="Script/MenuScript.js"></script>
<script src="Script/MouseEvents.js"></script>
<script src="Script/Animations.js"></script>
<script src="Script/MenuCodes.js"></script>
<script src="Script/EngineCode.js"></script>
<script src="Script/Cache.js"></script>
<script type="text/javascript">
		
			//////////////// Variaveis ///////////////////
			var canvas = document.getElementById('Menu');
			var bg_fundo = null;
			var estado = true;
			var cartas_oponente = new Array();
			var cartas_usuario = new Array();
				var cartas_renderizar = new Array();
				var local_tabuleiro = new Array();
				var estado_carta = new Array();
				var rand_oponente = new Array();
				var rand_usuario  = new Array();
				var dialogos = new Array();
				var funcao_jogador_local = new Array();
				var card_status = new Array();
				var lacaios_jogador = 0;
				var lacaios_oponente = 0;
				var evento_mouse = "";
				var evento_mouse_clique = "";
			var indice = 1;
			var bkIndice = 1;
			var indiceMenu1 = true;
			var indiceMenu2 = true;
			var IndMenu = 0; // Indice de qual Menu esta, Elite ou Novato
			var IOponente = 1; // Indice em qual oponente esta de 1 a 8
			var IOponenteE = 1;
			var MenuEscolha = 1;
			var escolha_ativa = true;
			var selecao = 'pedra';
			var selecao_escolha = 'primeiro'
			var regiao = "";
			var top_lane = 5;
			var mid_lane = 0;
			var bot_lane = 1;
			var funcao_jogador_rend = "";
			var funcao_oponente_rend = "";
			var novato1 = true;
			var novato2 = true;
			var novato3 = true;
			var novato4 = true;
			var novato5 = true;
			var novato6 = true;
			var novato7 = true;
			var novato8 = true;
			var elite1 = true;
			var elite2 = true;
			var elite3 = true;
			var elite4 = true;
			var elite5 = true;
			var elite6 = true;
			var elite7 = true;
			var elite8 = true;
			var xp_ganho;
			var cristais_ganho;
			var indice_carta = 1;
			var evento_mouse_posicao_jogar = "";
			var pick_atual = 0;
			var qtd_cartas_disponiveis = 0;
			var btn_combater = false;
			var cartas = new Array();
			var round = 1;
			var renderizar_cartas = true;
			var fim_de_jogo = false;
			var carta1 = 0;
			var vez_de_jogar = "jogador";
			var finish_round = -1;
			var y = 1;
			var round_turn = true;
			var ativar_inicio_jogo = true;
			var pick_or_no = 1;
			var voltar = false;
			var pick = 6; 
			var colocar_carta_ativar = true;
			var qtd_cartas_deck = 5;
			var qtd_cartas_renderizar = 1;
			var qtd_cartas_jogadas = 0;
			var str_pontos_jogador = "";
			var str_pontos_oponente = "";
			var d_random = 0;
			var funcao_jogador = "";
			var voltar1 = false;
			var voltar2 = false;
			var intervalo_menu;
			var animacao_menu;			
			var tela_negra = false;	
			var click_enter_now = true;
			var relog = "<?php echo $relog; ?>";
			var oponente_desbloq = false;
			var resultado_final_do_jogo = "";
			var elo_totais = 0;
			var xp_1_verage = 0;
			var xp_2_verage = 0;
			var cristais_1_verage = 0;
			var cristais_2_verage = 0;
			var elo_1_verage = 0;
			var elo_2_verage = 0;
			var NA_Atual = 0;
			
		var som_menu2 = 0;
		var som_menu3 = 0;
		var som_menu4 = 0;
		var som_menu5 = 0;
		var som_carta = 0;
		var som_posicao = 0;
		var som_tutorial = 0;
		var btn_combate_som = 0;
		
		var som_ativo = false;
		 
		var tutorial_i = 1;
		var tutorial_next = true;
		var evento_mouse_tutorial = "";
		var evento_mouse_salas_online = "";
		
		var soundEfx; // Sound Efx
		soundEfx = document.getElementById("soundEfx");
		
		var soundEfx2; // Sound Efx
		soundEfx2 = document.getElementById("soundEfx2");
		
		var soundEfx3; // Sound Efx
		soundEfx3 = document.getElementById("soundEfx3");
		
			
			
			function generate_decks(){
					var myArray = ['0','1','2','3','4','5','6', '7'];
					rand_oponente = shuffle(myArray);
					rand_usuario = shuffle(myArray);
				}
				
			
			generate_decks();
			
			function shuffle(o){ //v1.0
    		for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    		return o;
			};
			
			function carta(nome, burst, rage, ataque, defesa){
				this.nome   = nome;	
				this.burst  = burst;	
				this.rage   = rage;	
				this.ataque = ataque;	
				this.defesa = defesa;	
			}
var jogador_name = "<?php echo $row_LogonNome['Pseudonimo']; ?>";
var oponente_name = "";
var NAcesso = "<?php echo $Qtd_NAcesso[0]; ?>"
var h, array_nomes, string_nomes;
string_nomes = "<?php echo $Array_Nomes; ?>";
array_nomes = string_nomes.split("|");
var h, array_burst, string_burst;
string_burst = "<?php echo $Array_Burst; ?>";
array_burst = string_burst.split("|");
var h, array_rage, string_rage;
string_rage = "<?php echo $Array_Rage; ?>";
array_rage = string_rage.split("|");
var h, array_ataque, string_ataque;
string_ataque = "<?php echo $Array_Ataque; ?>";
array_ataque = string_ataque.split("|");
var h, array_defesa, string_defesa;
string_defesa = "<?php echo $Array_Defesa; ?>";
array_defesa = string_defesa.split("|");
			
		
			for(qtdC = 0; qtdC <= 7; qtdC++){
				var Carta = new carta();
				Carta.nome   = array_nomes[qtdC];
				Carta.burst  = array_burst[qtdC];
				Carta.rage   = array_rage[qtdC];
				Carta.ataque = array_ataque[qtdC];
				Carta.defesa = array_defesa[qtdC];
				cartas[qtdC] = Carta;
			}

		function deck_oponente(oponente_id, regi){
			var add_average = 0;var add_average_max = 0;if(oponente_id > 8){add_average++;add_average_max += 2;}if(oponente_id > 12){add_average++;add_average_max += 2;}if(oponente_id > 14){add_average++;add_average_max += 2;}
			
			if(regi=="fogo"){var Carta = new carta();Carta.nome="born_dragon";Carta.burst=17;Carta.rage=20;Carta.ataque=8;Carta.defesa=9;var Carta1 = new carta();Carta1.nome="cheliax";Carta1.burst=17;Carta1.rage=22;Carta1.ataque=7;Carta1.defesa=8;var Carta2 = new carta();Carta2.nome="xiao_wu";Carta2.burst=19;Carta2.rage=17;Carta2.ataque=11;Carta2.defesa=10;var Carta3 = new carta();Carta3.nome="mei_darkness";Carta3.burst=22;Carta3.rage=16;Carta3.ataque=8;Carta3.defesa=8;var Carta4 = new carta();Carta4.nome="minoking";Carta4.burst=17;Carta4.rage=15;Carta4.ataque=8;Carta4.defesa=9;var Carta5 = new carta();Carta5.nome="phoenix";Carta5.burst=20;Carta5.rage=19;Carta5.ataque=6;Carta5.defesa=10;var Carta6 = new carta();Carta6.nome="qinni";Carta6.burst=17;Carta6.rage=19;Carta6.ataque=9;Carta6.defesa=7;var Carta7 = new carta();Carta7.nome="sayuri";Carta7.burst=20;Carta7.rage=17;Carta7.ataque=10;Carta7.defesa=7;}if(regi=="agua"){var Carta = new carta();Carta.nome="jin-soo";Carta.burst=19;Carta.rage=17;Carta.ataque=8;Carta.defesa=7;var Carta1 = new carta();Carta1.nome="karin";Carta1.burst=17;Carta1.rage=22;Carta1.ataque=7;Carta1.defesa=8;var Carta2 = new carta();Carta2.nome="mistorn";Carta2.burst=17;Carta2.rage=16;Carta2.ataque=9;Carta2.defesa=9;var Carta3 = new carta();Carta3.nome="raindorn";Carta3.burst=18;Carta3.rage=15;Carta3.ataque=11;Carta3.defesa=8;var Carta4 = new carta();Carta4.nome="snowdorn";Carta4.burst=16;Carta4.rage=15;Carta4.ataque=9;Carta4.defesa=10;var Carta5 = new carta();Carta5.nome="pathfinder";Carta5.burst=20;Carta5.rage=19;Carta5.ataque=6;Carta5.defesa=8;var Carta6 = new carta();Carta6.nome="sun-ha";Carta6.burst=16;Carta6.rage=19;Carta6.ataque=10;Carta6.defesa=7;var Carta7 = new carta();Carta7.nome="tsubasa";Carta7.burst=19;Carta7.rage=22;Carta7.ataque=6;Carta7.defesa=10;}if(regi=="ar"){var Carta = new carta();Carta.nome="argorn";Carta.burst=20;Carta.rage=20;Carta.ataque=6;Carta.defesa=6;var Carta1 = new carta();Carta1.nome="flygorn";Carta1.burst=19;Carta1.rage=19;Carta1.ataque=7;Carta1.defesa=11;var Carta2 = new carta();Carta2.nome="kujdorn";Carta2.burst=18;Carta2.rage=17;Carta2.ataque=9;Carta2.defesa=7;var Carta3 = new carta();Carta3.nome="ghol";Carta3.burst=21;Carta3.rage=16;Carta3.ataque=9;Carta3.defesa=9;var Carta4 = new carta();Carta4.nome="gryph";Carta4.burst=17;Carta4.rage=15;Carta4.ataque=11;Carta4.defesa=9;var Carta5 = new carta();Carta5.nome="kruiser";Carta5.burst=21;Carta5.rage=19;Carta5.ataque=6;Carta5.defesa=10;var Carta6 = new carta();Carta6.nome="minerva";Carta6.burst=18;Carta6.rage=20;Carta6.ataque=9;Carta6.defesa=7;var Carta7 = new carta();Carta7.nome="nemeia";Carta7.burst=17;Carta7.rage=18;Carta7.ataque=10;Carta7.defesa=8;}if(regi=="terra"){var Carta = new carta();Carta.nome="dark_naga";Carta.burst=18;Carta.rage=15;Carta.ataque=10;Carta.defesa=8;var Carta1 = new carta();Carta1.nome="hikari";Carta1.burst=19;Carta1.rage=20;Carta1.ataque=7;Carta1.defesa=11;var Carta2 = new carta();Carta2.nome="magasashi";Carta2.burst=17;Carta2.rage=17;Carta2.ataque=9;Carta2.defesa=7;var Carta3 = new carta();Carta3.nome="quimera";Carta3.burst=22;Carta3.rage=16;Carta3.ataque=9;Carta3.defesa=9;var Carta4 = new carta();Carta4.nome="shou";Carta4.burst=18;Carta4.rage=15;Carta4.ataque=11;Carta4.defesa=9;var Carta5 = new carta();Carta5.nome="yamato";Carta5.burst=20;Carta5.rage=19;Carta5.ataque=6;Carta5.defesa=10;var Carta6 = new carta();Carta6.nome="centaure";Carta6.burst=17;Carta6.rage=22;Carta6.ataque=9;Carta6.defesa=7;var Carta7 = new carta();Carta7.nome="cyclops";Carta7.burst=20;Carta7.rage=17;Carta7.ataque=10;Carta7.defesa=8;}if(regi=="espirito"){var Carta = new carta();Carta.nome="fate-e";Carta.burst=19;Carta.rage=18;Carta.ataque=8;Carta.defesa=7;var Carta1 = new carta();Carta1.nome="fate-k";Carta1.burst=18;Carta1.rage=17;Carta1.ataque=7;Carta1.defesa=11;var Carta2 = new carta();Carta2.nome="magile";Carta2.burst=17;Carta2.rage=18;Carta2.ataque=9;Carta2.defesa=7;var Carta3 = new carta();Carta3.nome="miku";Carta3.burst=20;Carta3.rage=16;Carta3.ataque=10;Carta3.defesa=9;var Carta4 = new carta();Carta4.nome="shoju";Carta4.burst=17;Carta4.rage=16;Carta4.ataque=11;Carta4.defesa=8;var Carta5 = new carta();Carta5.nome="showa";Carta5.burst=20;Carta5.rage=19;Carta5.ataque=6;Carta5.defesa=10;var Carta6 = new carta();Carta6.nome="soknight";Carta6.burst=18;Carta6.rage=20;Carta6.ataque=9;Carta6.defesa=7;var Carta7 = new carta();Carta7.nome="chimera";Carta7.burst=17;Carta7.rage=18;Carta7.ataque=10;Carta7.defesa=9;}
cartas_oponente[0] = Carta;cartas_oponente[1] = Carta1;cartas_oponente[2] = Carta2;cartas_oponente[3] = Carta3;cartas_oponente[4] = Carta4;cartas_oponente[5] = Carta5;cartas_oponente[6] = Carta6;cartas_oponente[7] = Carta7;
			for(i = 0; i <= 7; i++){
				cartas_oponente[i].burst  += add_average_max;
				cartas_oponente[i].rage   += add_average_max;
				cartas_oponente[i].ataque += add_average;
				cartas_oponente[i].defesa += add_average;
			}
		}
		
		cartas_usuario[0] = cartas[rand_usuario[0]];
		cartas_usuario[1] = cartas[rand_usuario[1]];
		cartas_usuario[2] = cartas[rand_usuario[2]];
		cartas_usuario[3] = cartas[rand_usuario[3]];
		cartas_usuario[4] = cartas[rand_usuario[4]];
		cartas_usuario[5] = cartas[rand_usuario[5]];
		cartas_usuario[6] = cartas[rand_usuario[5]];
		
		
		dialogos[0] = "Esta Preparado para perder  |Fracote?|";
		dialogos[1] = "Haha eu nunca vou perder    |para alguem como você!|";
		dialogos[2] = "Minhas cartas são incriveis |você nunca vai conseguir     |vence-las :)";
		dialogos[3] = "Vou acabar com você         |VA-GA-RO-SA-MEN-TE!          |";
		dialogos[4] = "Que partida chata! você não |tem cartas melhores?|";
		dialogos[5] = "Que tediosa essa partida    |não sei por que eu quis jogar|com você";
		dialogos[6] = "Esperava jogadas melhores de|você, mas só tem isso?       |";
		dialogos[7] = "Suas jogadas são pateticas! ||";
		dialogos[8] = "Você é muito fraco! por que |não sai daqui e vai chorar pra| mamãe "+jogador_name+"?";
		dialogos[9] = "É bom esse duelo valer a pena|por que não quero perder tempo| com você, fracote!";
		dialogos[10] = "Hmmmm, Ótima jogada!||";
		dialogos[11] = "Hmmmm, Já saquei qual é a sua||";
		dialogos[12] = "Que jogada fraquinha, eim?||";
		
		card_status[0] = true;
		card_status[1] = true;
		card_status[2] = true;
		card_status[3] = true;
		card_status[4] = true;
		card_status[5] = true;
		
		
		function init(){
				// desenhar round
				window.setTimeout(function(){ drawImageSeq();round_animation(); }, 10);
				
				window.setTimeout(function() {
				if(vez_de_jogar == "jogador"){
					if(funcao_jogador == "defender")
					evento_mouse_clique = "Clicar_Carta";
					finish_round++;
				} else
				if(vez_de_jogar == "oponente"){
					finish_round++;
				}
					if(((y==6)&&(finish_round == 2))||(y>6)||((y>=6)&&(finish_round >= 2))){
						fim_do_jogo();
					} else if(finish_round == 2){
					finish_round = 0;
					y++;
					round_turn = true;
					if(vez_de_jogar=="jogador") {
					drawImageSeq();
					if(vez_de_jogar == "oponente"){ window.setTimeout(Dialogo_Jogador(true,false,false), 10); }
					if(funcao_jogador == "defender")
					evento_mouse_clique = "Clicar_Carta";
					} 
					else if(vez_de_jogar=="oponente"){ 
					oponente(); 
					}
					} else {
					if(vez_de_jogar=="jogador") {
					drawImageSeq();
					if(vez_de_jogar == "oponente"){ window.setTimeout(Dialogo_Jogador(true,false,false), 10); }
					evento_mouse = "Clicar_Carta"; 	
					} 
					else 
					if(vez_de_jogar=="oponente"){
						  oponente();	
						 } 
					}
			}, 1);
		}
		
		function jogador(){
				if(funcao_jogador == "defender")
					evento_mouse_clique = "Clicar_Carta";
		}
		
		function oponente(){
			vez_de_jogar = "jogador";
			animation_oponente();
			renderizar_cartas = false;
			colocar_carta_ativar = false;
			
			
			window.setTimeout(function() {
				carta1 += 1;
				
				var l = false;
				var n_diferenca;
				while(l == false){
					local_carta = ran(1,12);
					n_diferenca = 0;
					if(local_tabuleiro.length > 0){
					for(j = 0; j < local_tabuleiro.length; j++){
						if(local_carta != local_tabuleiro[j]){
							n_diferenca++;
						}
					}
					
					if(n_diferenca == qtd_cartas_renderizar){
						l = true;
					}
					} else {
					 l = true;	
					}
				}
			cartas_renderizar[qtd_cartas_renderizar] = cartas_oponente[carta1];
			local_tabuleiro[qtd_cartas_renderizar] = local_carta;
			estado_carta[qtd_cartas_renderizar] = funcao_oponente_rend;
			lacaios_oponente++;
			mudar_estado(qtd_cartas_renderizar, funcao_oponente_rend);
			
			qtd_cartas_renderizar++;
			
			window.setTimeout(init(),500);
				}, 7000);		
		}
		
		function renderizar_tabuleiro(){
				var string_estados = "";
				for(p = 1; p < cartas_renderizar.length; p++){
					
				desenhar_carta_position(cartas_renderizar[p], local_tabuleiro[p], estado_carta[p]);
				
					
				}
				
			}

		function drawImageSeq(){
			// DESENHA O FUNDO DA TELA
			window.setTimeout(function() {
			window.setTimeout(bg_fundo = CriarImagem('img/back_ground_game.jpg', Fundo), 1);
			}, 1);
			// DESENHA A PONTUAÇÃO
			window.setTimeout(desenhar_pontuacao(), 1);
			// DESENHA OS ICONES DE PONTUAÇÃO
			window.setTimeout(des_icon_posicao(funcao_jogador), 10);
			// DESENHA O DECK
			if(qtd_cartas_jogadas < 6){
			window.setTimeout(function() {
			window.setTimeout(Desenhar_carta_deck(), 1);
			}, 1);
			}
			// DESENHA O TABULEIRO
			if(qtd_cartas_renderizar > 1){
				renderizar_tabuleiro();
			}
		}
		
		function Desenhar_carta_deck(){
			Deck_Source(card_status[5], card_status[4], card_status[3], card_status[2], card_status[1], card_status[0]);
			evento_mouse = "Selecionar_Carta";
		}
		
		function GameLoop() {
				if(estado){
					Game(indice);
					estado = false;
				}
			}
		
		function Game(ink) {
				if(ink == 1){
					SplashTry1();
				}
				if(ink == 2){
					tutorial_partes(tutorial_i);
					evento_mouse_tutorial = "tutorial";	
				}
				if(ink == 3){
					top.document.location='deck.php';
				}
				if(ink == 4){
					salas_online();
					evento_mouse_salas_online = "online";
				}
			}
		
		function som_control(){
			if(som_ativo){
				som_ativo = false;
				document.getElementById('soundEfx').volume+=1;
				document.getElementById('soundEfx2').volume+=1;
				document.getElementById('soundEfx3').volume+=1;
				var obj1 = document.getElementById("apDiv1");
				obj1.innerHTML = "<img src='img/som_ativo.png' />";
	 	
			} else
			if(som_ativo == false){
				som_ativo = true;
				document.getElementById('soundEfx').volume-=1;
				document.getElementById('soundEfx2').volume-=1;
				document.getElementById('soundEfx3').volume-=1;
				var obj2 = document.getElementById("apDiv1");
				obj2.innerHTML = "<img src='img/som_inativo.png' />";
			}
		}
		
			window.onload = animation_download;
			
        </script>
        <style type="text/css">
#topLabel {
	width: 900px;
	height: 50px;
	z-index: 1;
	left: 8px;
	top: 3px;
	background-color: black;
}
#UserCristais2 {
	position: absolute;
	width: 183px;
	height: 26px;
	left: 694px;
	text-align: right;
	color: white;
	font: italic small-caps bold 20px
 	"Verdana", sans-serif;
	z-index: 2;
	top: 31px;
}
#UserCristais2 a{
	text-shadow:#000 3px -1px 3px, #000 -3px 1px 3px, #000 3px 1px 3px, #000 -3px -1px 3px;
	color: white;
}
#UserPergaminhos2 {
	position: absolute;
	width: 259px;
	height: 26px;
	left: 617px;
	text-align: right;
	color: white;
	font: italic small-caps bold 20px
 	"Verdana", sans-serif;
	z-index: 2;
	top: 10px;
}
#UserPergaminhos2 a{
	text-shadow:#000 3px -1px 3px, #000 -3px 1px 3px, #000 3px 1px 3px, #000 -3px -1px 3px;
	color: white;
}
#login_color {
	color: #FFF;
}
#UserName2 {
	position: absolute;
	width: 235px;
	height: 23px;
	top: 1px;
	left: 54px;
	text-align: center;
	color: white;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 16px;
	z-index: 2;
	font: italic small-caps bold 20px
 	"Verdana", sans-serif;
}
#UserName2 a{
font-family: Verdana, Geneva, sans-serif;
	text-shadow:#000 1px -1px 2px, #000 -1px 1px 2px, #000 1px 1px 2px, #000 -1px -1px 2px;
	color: white;
font-size: 36px;
}
#Img_User2 {
	position: absolute;
	width: 47px;
	height: 49px;
	top: 8px;
	left: 8px;
	z-index: 2;
	border: thin solid gray;
}
#UserNivel2 {
	position: absolute;
	width: 117px;
	height: 40px;
	top: 35px;
	left: 47px;
	text-align: center;
	color: white;
	font: italic small-caps bold 20px
 	"Verdana", sans-serif;
	z-index: 2;
}
#xp {
	position: absolute;
	width: 337px;
	height: 44px;
	top: 41px;
	left: 119px;
	text-align: center;
	color: white;
	font: italic small-caps bold 15px
 	"Verdana", sans-serif;
	z-index: 2;
}
    #apDiv1 {
	position: absolute;
	width: 45px;
	height: 40px;
	z-index: 3;
	left: 615px;
	top: 31px;
}
        </style>
</head>
<div id="topLabel">
    </div>
	<div id="apDiv1" onClick="som_control()"> <img src="img/som_ativo.png"> </div>
<canvas id="Menu" width="900" height="600"> Seu navegador não suporta HTML 5 :/ <br /> 
Por favor atualize! </canvas>
     <audio id="soundEfx" src="sounds/snd_1.mp3" style="display: none;"></audio>
     <audio id="soundEfx2" src="sounds/snd_2.mp3" style="display: none;"></audio>
     <audio id="soundEfx3" src="sounds/snd_3.wav" style="display: none;"></audio>
</body>
</html>
