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

$hostname_conecta = "localhost";
$database_conecta = "copo";
$username_conecta = "root";
$password_conecta = "usbw";
$erro             = "";
$conexao  = mysql_pconnect($hostname_conecta, $username_conecta, $password_conecta) or trigger_error(mysql_error(),E_USER_ERROR);
$database = mysql_select_db($database_conecta);

if($conexao){
	if($database){
		
		$ImageUser = "";
		$ImageBusca = mysql_query("SELECT DISTINCT URL_Img FROM Pessoa WHERE IdPessoa='$SecId'");
		$ImageUser = mysql_fetch_row($ImageBusca);
		
		$Nivel = 0;
		$NivelBusca = mysql_query("SELECT DISTINCT Nivel FROM Nivel A, Inventario B WHERE B.IdPessoa='$SecId' and B.IdNivel = A.IdNivel");
		$Nivel = mysql_fetch_row($NivelBusca);
		
		$Qtd_Cristal = 0;
		$Qtd_CristalBusca = mysql_query("SELECT DISTINCT QtdCristais FROM Inventario WHERE IdPessoa='$SecId'");
		$Qtd_Cristal = mysql_fetch_row($Qtd_CristalBusca);
		
		$Qtd_Pergaminho = 0;
		$Qtd_PergaminhoBusca = mysql_query("SELECT DISTINCT QtdPergaminho FROM Inventario WHERE IdPessoa='$SecId'");
		$Qtd_Pergaminho = mysql_fetch_row($Qtd_PergaminhoBusca);
		
		
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









		
} else {
		   print "Não foi possível selecionar o Banco de Dados";
	
	}
} else {
           print "Erro ao conectar o MySQL";
	}



?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cards Of Pandora Online</title>
<link href="../script/script.css" rel="stylesheet" type="text/css">




<!-- Cor do plano de fundo -->
<style type="text/css"> body { background-color: #000;  } </style>
<script src="Script/MenuScript.js"></script>

<script type="text/javascript">
		
			//////////////// Variaveis Globais /////////////
		
			var bg_fundo = null;
			var estado = true;
			var cartas_oponente = new Array();
			var cartas_usuario = new Array();
						var cartas_renderizar = new Array();
						var local_tabuleiro = new Array();
						var estado_carta = new Array();
							var rand_oponente = new Array();
							var rand_usuario  = new Array();
			var indice = 1;
			var bkIndice = 1;
			var indiceMenu1 = true;
			var indiceMenu2 = true;
			var IndMenu = 0; // Indice de qual Menu esta, Elite ou Novato
			var IOponente = 1; // Indice em qual oponente esta de 1 a 8
			var IOponenteE = 1;
			var MenuEscolha = 1;
			var partida_Em_Andamento = false; // indica se uma partida esta em execução
			var ppt = true; // ativa pedra papel tesoura
			var ppt_master = true; // ativa_todo_o papel e tesoura
			var escolha_ativa = true; // ativa o escolha
			var selecao = 'pedra';
			var selecao_escolha = 'primeiro'
			var regiao = "";
			var top_lane = 5;
			var mid_lane = 0;
			var bot_lane = 1;
			novato1 = true;
			novato2 = true;
			novato3 = true;
			novato4 = true;
			novato5 = true;
			novato6 = true;
			novato7 = true;
			novato8 = true;
			elite1 = true;
			elite2 = true;
			elite3 = true;
			elite4 = true;
			elite5 = true;
			elite6 = true;
			elite7 = true;
			elite8 = true;
		
			
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
			alert(jogador_name);
			
			var cartas = new Array();
			
			for(qtdC = 0; qtdC <= 7; qtdC++){
				var Carta = new carta();
				Carta.nome   = array_nomes[qtdC];
				Carta.burst  = array_burst[qtdC];
				Carta.rage   = array_rage[qtdC];
				Carta.ataque = array_ataque[qtdC];
				Carta.defesa = array_defesa[qtdC];
				cartas[qtdC] = Carta;
			}

//____________________________________________________________________________________________________________
//____________________________________________________________________________________________________________
//_________________________________________________ADVERSARIO_________________________________________________
//____________________________________________________________________________________________________________
//____________________________________________________________________________________________________________

			

		// Codificação camada de estrutura de game////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
			function ran(i, f) {
	if (i > f) {numInicial = f;numFinal = i+1;}else{numInicial = i;numFinal = f+1;}
	numRandom = Math.floor((Math.random()*(numFinal-numInicial))+numInicial);
	return numRandom;
	}
		
		function deck_oponente(oponente_id, regi){
			var add_average = 0;var add_average_max = 0;if(oponente_id > 8){add_average++;add_average_max += 2;}if(oponente_id > 12){add_average++;add_average_max += 2;}if(oponente_id > 14){add_average++;add_average_max += 2;}
			
			if(regi=="fogo"){var Carta = new carta();Carta.nome="born dragon";Carta.burst=17;Carta.rage=20;Carta.ataque=8;Carta.defesa=9;var Carta1 = new carta();Carta1.nome="cheliax";Carta1.burst=17;Carta1.rage=22;Carta1.ataque=7;Carta1.defesa=8;var Carta2 = new carta();Carta2.nome="xiao wu";Carta2.burst=19;Carta2.rage=17;Carta2.ataque=11;Carta2.defesa=10;var Carta3 = new carta();Carta3.nome="mei darkness";Carta3.burst=22;Carta3.rage=16;Carta3.ataque=8;Carta3.defesa=8;var Carta4 = new carta();Carta4.nome="minoking";Carta4.burst=17;Carta4.rage=15;Carta4.ataque=8;Carta4.defesa=9;var Carta5 = new carta();Carta5.nome="phoenix";Carta5.burst=20;Carta5.rage=19;Carta5.ataque=6;Carta5.defesa=10;var Carta6 = new carta();Carta6.nome="qinni";Carta6.burst=17;Carta6.rage=19;Carta6.ataque=9;Carta6.defesa=7;var Carta7 = new carta();Carta7.nome="sayuri";Carta7.burst=20;Carta7.rage=17;Carta7.ataque=10;Carta7.defesa=7;}if(regi=="agua"){var Carta = new carta();Carta.nome="jin-soo";Carta.burst=19;Carta.rage=17;Carta.ataque=8;Carta.defesa=7;var Carta1 = new carta();Carta1.nome="karin";Carta1.burst=17;Carta1.rage=22;Carta1.ataque=7;Carta1.defesa=8;var Carta2 = new carta();Carta2.nome="mistorn";Carta2.burst=17;Carta2.rage=16;Carta2.ataque=9;Carta2.defesa=9;var Carta3 = new carta();Carta3.nome="raindorn";Carta3.burst=18;Carta3.rage=15;Carta3.ataque=11;Carta3.defesa=8;var Carta4 = new carta();Carta4.nome="snowdorn";Carta4.burst=16;Carta4.rage=15;Carta4.ataque=9;Carta4.defesa=10;var Carta5 = new carta();Carta5.nome="pathfinder";Carta5.burst=20;Carta5.rage=19;Carta5.ataque=6;Carta5.defesa=8;var Carta6 = new carta();Carta6.nome="sun-ha";Carta6.burst=16;Carta6.rage=19;Carta6.ataque=10;Carta6.defesa=7;var Carta7 = new carta();Carta7.nome="tsubasa";Carta7.burst=19;Carta7.rage=22;Carta7.ataque=6;Carta7.defesa=10;}if(regi=="ar"){var Carta = new carta();Carta.nome="argorn";Carta.burst=20;Carta.rage=20;Carta.ataque=6;Carta.defesa=6;var Carta1 = new carta();Carta1.nome="flygorn";Carta1.burst=19;Carta1.rage=19;Carta1.ataque=7;Carta1.defesa=11;var Carta2 = new carta();Carta2.nome="kujgorn";Carta2.burst=18;Carta2.rage=17;Carta2.ataque=9;Carta2.defesa=7;var Carta3 = new carta();Carta3.nome="ghol";Carta3.burst=21;Carta3.rage=16;Carta3.ataque=9;Carta3.defesa=9;var Carta4 = new carta();Carta4.nome="gryph";Carta4.burst=17;Carta4.rage=15;Carta4.ataque=11;Carta4.defesa=9;var Carta5 = new carta();Carta5.nome="kruiser";Carta5.burst=21;Carta5.rage=19;Carta5.ataque=6;Carta5.defesa=10;var Carta6 = new carta();Carta6.nome="minerva";Carta6.burst=18;Carta6.rage=20;Carta6.ataque=9;Carta6.defesa=7;var Carta7 = new carta();Carta7.nome="nemeia";Carta7.burst=17;Carta7.rage=18;Carta7.ataque=10;Carta7.defesa=8;}if(regi=="terra"){var Carta = new carta();Carta.nome="dark naga";Carta.burst=18;Carta.rage=15;Carta.ataque=10;Carta.defesa=8;var Carta1 = new carta();Carta1.nome="hikari";Carta1.burst=19;Carta1.rage=20;Carta1.ataque=7;Carta1.defesa=11;var Carta2 = new carta();Carta2.nome="magasashi";Carta2.burst=17;Carta2.rage=17;Carta2.ataque=9;Carta2.defesa=7;var Carta3 = new carta();Carta3.nome="quimera";Carta3.burst=22;Carta3.rage=16;Carta3.ataque=9;Carta3.defesa=9;var Carta4 = new carta();Carta4.nome="shou";Carta4.burst=18;Carta4.rage=15;Carta4.ataque=11;Carta4.defesa=9;var Carta5 = new carta();Carta5.nome="yamato";Carta5.burst=20;Carta5.rage=19;Carta5.ataque=6;Carta5.defesa=10;var Carta6 = new carta();Carta6.nome="centaure";Carta6.burst=17;Carta6.rage=22;Carta6.ataque=9;Carta6.defesa=7;var Carta7 = new carta();Carta7.nome="cyclops";Carta7.burst=20;Carta7.rage=17;Carta7.ataque=10;Carta7.defesa=8;}if(regi=="espirito"){var Carta = new carta();Carta.nome="fate-e";Carta.burst=19;Carta.rage=18;Carta.ataque=8;Carta.defesa=7;var Carta1 = new carta();Carta1.nome="fate-k";Carta1.burst=18;Carta1.rage=17;Carta1.ataque=7;Carta1.defesa=11;var Carta2 = new carta();Carta2.nome="magile";Carta2.burst=17;Carta2.rage=18;Carta2.ataque=9;Carta2.defesa=7;var Carta3 = new carta();Carta3.nome="miku";Carta3.burst=20;Carta3.rage=16;Carta3.ataque=10;Carta3.defesa=9;var Carta4 = new carta();Carta4.nome="shoju";Carta4.burst=17;Carta4.rage=16;Carta4.ataque=11;Carta4.defesa=8;var Carta5 = new carta();Carta5.nome="showa";Carta5.burst=20;Carta5.rage=19;Carta5.ataque=6;Carta5.defesa=10;var Carta6 = new carta();Carta6.nome="soknight";Carta6.burst=18;Carta6.rage=20;Carta6.ataque=9;Carta6.defesa=7;var Carta7 = new carta();Carta7.nome="chimera";Carta7.burst=17;Carta7.rage=18;Carta7.ataque=10;Carta7.defesa=9;}
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
		cartas_usuario[2] = cartas[rand_usuario[2]]; //370 - 230
		cartas_usuario[3] = cartas[rand_usuario[3]];
		cartas_usuario[4] = cartas[rand_usuario[4]];
		cartas_usuario[5] = cartas[rand_usuario[5]];
		

		
		//function Start(){
		//	round_animation();
		//	drawImageSeq();
		//}
		
		var round = 1;
		renderizar_cartas = true;
		
		
		
		
		////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////
		
		
		//FUNÇÃO QUE FAZ O LAÇO DO JOGO, JOGADOR OU OPONENTE, E CALCULA OS ROUNDS
		function start_play(){
				// desenhar round
				drawImageSeq();
				round_animation();
				
				window.setTimeout(function() {
				if(vez_de_jogar == "jogador"){
					alert("Vez do jogador");
					alert("hora de jogar: " + finish_round);
					//colocar_carta_ativar = true;
					drawImageSeq();	 // limpa a tela
					window.onkeydown = Render_Cards; // coloca para o jogador selec uma carta <- q vai chamar a funç jogador
					finish_round++;
				} else
				if(vez_de_jogar == "oponente"){
					alert("Vez do oponente");
					alert("hroa de jogar: " + finish_round);
					//colocar_carta_ativar = true;
					oponente();
					finish_round++;
				}
				if(finish_round == 2){
					finish_round = 0;
					y++;
					round_turn = true;
				}
				
				}, 1); // era pra ser 700???
				//drawImageSeq();
				//renderizar_cartas = true;
		}
		
		function jogador(){
				// Desenhar n do round
				///////////////////////////////////// Round do jogador
window.setTimeout(function() {imgLight = new Image();imgLight.src = "img/back_ground_game_light.png";DesenhaP(imgLight, 1, 1);}, 10); // DESENHA TELA PRETA

				CentralizarCarta(); // SÓ DESENHA A CARTA NO CENTRO DA TELA
window.setTimeout(function() {imgLight = new Image();imgLight.src = "img/btn_in_game/confirmar.png";DesenhaP(imgLight, 700, 400); // DESENHA O BTN DE CONFIRMAR
				}, 10);
					window.onkeydown = Pick_a_card;	
		}
		var carta1 = 0;
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
					for(j = 0; j < local_tabuleiro.length; j++){
						if(local_carta != local_tabuleiro[j]){
							alert(local_carta + " != " + local_tabuleiro[j]);
							n_diferenca++;
						}
					}
					if(n_diferenca == qtd_cartas_renderizar){
						l = true;
					}
				}
			cartas_renderizar[qtd_cartas_renderizar] = cartas_oponente[carta1];
			local_tabuleiro[qtd_cartas_renderizar] = local_carta;
			estado_carta[qtd_cartas_renderizar] = "defense";
			qtd_cartas_renderizar++;
			alert("Quantidade de cartas: " + qtd_cartas_renderizar);
				start_play();
				}, 7000);
			;
			
			//alert("break here"); //  TRABALHAR AGORA AQUI!			
		}
		
		
		////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////
		
		
		function Render_Cards(e){
			if(renderizar_cartas){
				
				if(e.keyCode == 38){
					if(top_lane == qtd_cartas_deck) {top_lane = 0; } else {top_lane++; }
					if(mid_lane == qtd_cartas_deck) {mid_lane = 0; } else {mid_lane++; }
					if(bot_lane == qtd_cartas_deck) {bot_lane = 0; } else {bot_lane++; }}
				if(e.keyCode == 40){																																																																																																					  					if(top_lane == 0) {top_lane = qtd_cartas_deck; } else {top_lane--; }
				    if(mid_lane == 0) {mid_lane = qtd_cartas_deck; } else {mid_lane--; }
					if(bot_lane == 0) {bot_lane = qtd_cartas_deck; } else {bot_lane--; }}
				if(e.keyCode == 13){
					if(y <= 7){
						jogador(); // CHAMA A FUNÇÃO JOGADOR, COMPLETANDO O LAÇO!
					} else {
					 //// terminar o jogo aqui	
					}
					renderizar_cartas = false;
				}
			
				drawImageSeq(); // AJUSTAR AQUI PARA QUE NÃO RENDERIZE O VETOR QUANDO PASSAR
			}
		}
		
		var vez_de_jogar = "jogador";
		var finish_round = 0;
		var y = 1;
		
		
		round_turn = true;
		function round_animation(){
			
			i = 0;
			if(round_turn == true){
				round_turn = false;
			var intervalo1 = window.setInterval(function() {
				if(i==0){
					animation_round = new Image();
					animation_round.src = "img/round_animation/round0.png"; 
					Desenhar_round_animation(animation_round,y,1,100,138,152);
				}
				if(i==1){
					animation_round = new Image();
					animation_round.src = "img/round_animation/round1.png"; 
					Desenhar_round_animation(animation_round,y,1,100,138,152);
				}
				if(i==2){
					animation_round = new Image();
					animation_round.src = "img/round_animation/round2.png"; 
					Desenhar_round_animation(animation_round,y,1,100,138,152);
				}
				if(i==3){
					animation_round = new Image();
					animation_round.src = "img/round_animation/round3.png"; 
					Desenhar_round_animation(animation_round,y,1,100,138,152);
				}
				if(i==4){
					animation_round = new Image();
					animation_round.src = "img/round_animation/round4.png"; 
					Desenhar_round_animation(animation_round,y,1,100,138,152);
				}
				if(i==5){
					animation_round = new Image();
					animation_round.src = "img/round_animation/round5.png"; 
					Desenhar_round_animation(animation_round,y,1,100,138,152);
				}
				if(i==6){
					animation_round = new Image();
					animation_round.src = "img/round_animation/round6.png"; 
					Desenhar_round_animation(animation_round,y,1,100,138,152);
				}
				if(i==7){
					animation_round = new Image();
					animation_round.src = "img/round_animation/round7.png"; 
					Desenhar_round_animation(animation_round,y,1,100,138,152);
				}
				if(i==8){
					animation_round = new Image();
					animation_round.src = "img/round_animation/round8.png"; 
					Desenhar_round_animation(animation_round,y,1,100,138,152);
				}
				if(i==9){
					animation_round = new Image();
					animation_round.src = "img/round_animation/round9.png"; 
					Desenhar_round_animation(animation_round,y,1,100,138,152);
				}
				if(i==10){
					animation_round = new Image();
					animation_round.src = "img/round_animation/round10.png"; 
					Desenhar_round_animation(animation_round,y,1,100,138,152);
				}
				if(i==11){
					animation_round = new Image();
					animation_round.src = "img/round_animation/round11.png"; 
					Desenhar_round_animation(animation_round,y,1,100,138,152);
				}
				if(i==12){
					animation_round = new Image();
					animation_round.src = "img/round_animation/round12.png"; 
					Desenhar_round_animation(animation_round,y,1,100,138,152);
				i=0;
				} else {
				i++;
				}
			}, 50); // Executara isso em um intervalo de 50milisec
			window.setTimeout(function() {
				clearInterval(intervalo1);
				
			}, 700);
			
			}
		}
		
		
		
		var pick_or_no = 0;
		
		function Pick_a_card(e){
				
			if(e.keyCode == 37){
				window.setTimeout(function() {
				imgLight = new Image()
				imgLight.src = "img/btn_in_game/confirmar.png";
				DesenhaP(imgLight, 700, 400);
				}, 10);
				pick_or_no = 0;
			}
			if(e.keyCode == 39){
				window.setTimeout(function() {
				imgLight = new Image()
				imgLight.src = "img/btn_in_game/voltar.png";
				DesenhaP(imgLight, 700, 400);
				}, 10);
				pick_or_no = 1;
			}
			if(e.keyCode == 13){
				
				if(pick_or_no == 0){
					
				 if(vez_de_jogar == "jogador")
					vez_de_jogar = "oponente";
				
					drawImageSeq();
					window.setTimeout(function() {imagePPT = new Image();imagePPT.src = "img/btn_in_game/select.png";DesenharPPT(imagePPT, 320, 244);}, 1); // DESENHA O SELECIONAR NO MEIO DA TELA
					colocar_carta_ativar = true
					window.onkeydown = colocar_carta;
					
				} else if(pick_or_no == 1) { // AQUI NÃO TEM PROBLEMAS!!!
					
					if(finish_round > 0)
					finish_round--;
					
					drawImageSeq();
					renderizar_cartas = true;
					window.onkeydown = Render_Cards;
				}
				
			}
			
		}	
			var voltar = false;
			var pick = 6; // guarda a posição que a carta será colocada
			
			var colocar_carta_ativar = true;
			
			function colocar_carta(e){
			if(colocar_carta_ativar == true){
				if(e.keyCode == 37){ // esquerda
				var ave = pick - 1;
					if((pick>= 1)&&(pick<=12)&&(ave>=1)&&(ave<=12)){
						pick -= 1;
					}
					desenhar_position();
				}
				if(e.keyCode == 39){ // direita
				var ave = pick + 1;
					if((pick>= 1)&&(pick<=12)&&(ave>=1)&&(ave<=12)){
						pick += 1;
					}
					desenhar_position();
				}
				if(e.keyCode == 38){ // cima
				var ave = pick - 4;
					if((pick>= 1)&&(pick<=12)&&(ave>=1)&&(ave<=12)){
						pick -= 4;
					}
					desenhar_position();
				}
				if(e.keyCode == 40){ // baixo
				var ave = pick + 4;
					if((pick>= 1)&&(pick<=12)&&(ave>=1)&&(ave<=12)){
						pick += 4;
					}
					desenhar_position();
				}
				
				if(e.keyCode == 13){
					colocar_carta_ativar = false;
					retirar_carta_deck(); 
				if(mid_lane == qtd_cartas_deck + 1){
					mid_lane--; 
				}
				if(top_lane == qtd_cartas_deck + 1){
					top_lane--;
				}
				if(bot_lane == qtd_cartas_deck + 1){
					bot_lane--;
				}  // CODIGO PARA AJUSTAR O LAÇO APOS MENOS UMA CARA
					drawImageSeq();	// DESENHA NOVA CARTA - RENDERIZANDO TODAS!!! - COM A FUNÇÃO DE RENDERIZAÇÃO
					start_play(); // AQUI FINALIZA O LAÇO, VOLTANDO PARA O START_PLAY, QUE COMANDA TODAS AS OUTRAS FUNÇÕES
				}
			  }
			}
			
			qtd_cartas_deck = 5;
			qtd_cartas_renderizar = 1;
			
			function renderizar_tabuleiro(){
				for(p = 1; p < cartas_renderizar.length; p++){
					desenhar_carta_position(cartas_renderizar[p], local_tabuleiro[p], estado_carta[p]);
					alert("Estado carta: " + estado_carta[p]);
				}
			}

			function retirar_carta_deck(){
				cartas_renderizar[qtd_cartas_renderizar] = cartas_usuario[mid_lane];
				local_tabuleiro[qtd_cartas_renderizar] = pick;
				estado_carta[qtd_cartas_renderizar] = "atack";
				qtd_cartas_renderizar++;
				
							// CONCERTAR ALGORITMO A BAIXO DE FILA, TIRAR CARTA E SOBREPOR - PESQUISAR IBI
				for(i = 0; i <= qtd_cartas_deck; i++){
					if((i>=mid_lane)&&(i<=qtd_cartas_deck)){
						var aux_renderizar = i + 1;
						cartas_usuario[i] = cartas_usuario[aux_renderizar];
					}
					if(i==qtd_cartas_deck){
						cartas_usuario[i] = null;
					}
					
				}
				qtd_cartas_deck--;
			}
			
			function desenhar_carta_position(carta, posicao, estado){
				
			if(posicao == 1){	
				if(estado=="atack"){
				window.setTimeout(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 199, 78, 250, 124, 250, 238, 204, 180, 295, 180);
				}, 1);
				}
				if(estado=="defense"){
				window.setTimeout(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 199, 78, 250, 124, 250, 238, 204, 180, 295, 180);
				}, 1);
				}
			}
			
			if(posicao == 2){	
				if(estado=="atack"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 324, 78, 375, 124, 375, 238, 329, 180, 420, 180);
				}, 1);
				}
				if(estado=="defense"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 324, 78, 375, 124, 375, 238, 329, 180, 420, 180);
				}, 1);
				}
			}
			
			if(posicao == 3){	
				if(estado="atack"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 449, 78, 500, 124, 500, 238, 454, 180, 545, 180);
			}, 1);	
				}
				if(estado="defense"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 449, 78, 500, 124, 500, 238, 454, 180, 545, 180);
			}, 1);	
				}
			}
			
			if(posicao == 4){
				if(estado=="atack"){	
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 574, 78, 625, 124, 625, 238, 579, 180, 670, 180);
			}, 1);	
				}
				if(estado=="defense"){	
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 574, 78, 625, 124, 625, 238, 579, 180, 670, 180);
			}, 1);	
				}
			}
			
			if(posicao == 5){	
				if(estado=="atack"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 199, 246, 250, 292, 250, 406, 204, 348, 295, 348);
			}, 1);	
				}
				if(estado=="defense"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 199, 246, 250, 292, 250, 406, 204, 348, 295, 348);
			}, 1);	
				}
			}
			
			
			if(posicao == 6){	
				if(estado=="atack"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 324, 246, 375, 292, 375, 406, 329, 348, 420, 348);
			}, 1);	
				}
				if(estado=="defense"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 324, 246, 375, 292, 375, 406, 329, 348, 420, 348);
			}, 1);	
				}
			}
			
			
			if(posicao == 7){	
				if(estado=="atack"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 449, 246, 500, 292, 500, 406, 454, 348, 545, 348);
			}, 1);	
				}
				if(estado=="defense"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 449, 246, 500, 292, 500, 406, 454, 348, 545, 348);
			}, 1);	
				}
			}
			
			
			if(posicao == 8){	
				if(estado=="atack"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 574, 246, 625, 292, 625, 406, 579, 348, 670, 348);
			}, 1);	
				}
				if(estado=="defense"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 574, 246, 625, 292, 625, 406, 579, 348, 670, 348);
			}, 1);	
				}
			}
			
			if(posicao == 9){	
				if(estado=="atack"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 199, 412, 250, 458, 250, 572, 204, 514, 295, 514);
			}, 1);	
				}
				if(estado=="defense"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 199, 412, 250, 458, 250, 572, 204, 514, 295, 514);
			}, 1);	
				}
			}
			
			
			if(posicao == 10){	
				if(estado=="atack"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 324, 412, 375, 458, 375, 572, 329, 514, 420, 514);
			}, 1);	
				}
				if(estado=="defense"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 324, 412, 375, 458, 375, 572, 329, 514, 420, 514);
			}, 1);	
				}
			}
			
			if(posicao == 11){	
				if(estado=="atack"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 449, 412, 500, 458, 500, 572, 454, 514, 545, 514);
			}, 1);	
				}
				if(estado=="defense"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 449, 412, 500, 458, 500, 572, 454, 514, 545, 514);
			}, 1);	
				}
			}
			
			if(posicao == 12){	
				if(estado=="atack"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 574, 412, 625, 458, 625, 572, 579, 514, 670, 514);
			}, 1);
				}
				if(estado=="defense"){
				window.setInterval(function() {
				Carta_drawn = new Image()
				Carta_drawn.src = "img/ddl_cartas/"+carta.nome+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn, carta.burst, carta.rage, carta.ataque, carta.defesa, 574, 412, 625, 458, 625, 572, 579, 514, 670, 514);
			}, 1);
				}
			}
			
					renderizar_cartas = true;
					round_animation();
				
				
			}
			
			function desenhar_position(){
				drawImageSeq();
				if(pick == 1){
				window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/btn_in_game/select.png"; 
						DesenharPPT(imagePPT, 195, 78);
					}, 01);
				}
				if(pick == 2){
				window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/btn_in_game/select.png"; 
						DesenharPPT(imagePPT, 319, 78);
					}, 0);
				}
				if(pick == 3){
				window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/btn_in_game/select.png"; 
						DesenharPPT(imagePPT, 445, 78);
					}, 0);
				}
				if(pick == 4){
				window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/btn_in_game/select.png"; 
						DesenharPPT(imagePPT, 570, 78);
					}, 0);
				}
				if(pick == 5){
				window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/btn_in_game/select.png"; 
						DesenharPPT(imagePPT, 195, 244);
					}, 0);
				}
				if(pick == 6){
				window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/btn_in_game/select.png"; 
						DesenharPPT(imagePPT, 320, 244);
					}, 0);
				}
				if(pick == 7){
				window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/btn_in_game/select.png"; 
						DesenharPPT(imagePPT, 446, 244);
					}, 0);
				}
				if(pick == 8){
				window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/btn_in_game/select.png"; 
						DesenharPPT(imagePPT, 570, 244);
					}, 0);
				}
				if(pick == 9){
				window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/btn_in_game/select.png"; 
						DesenharPPT(imagePPT, 195, 412);
					}, 0);
				}
				if(pick == 10){
				window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/btn_in_game/select.png"; 
						DesenharPPT(imagePPT, 319, 412);
					}, 0);
				}
				if(pick == 11){
				window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/btn_in_game/select.png"; 
						DesenharPPT(imagePPT, 443, 412);
					}, 0);
				}
				if(pick == 12){
				window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/btn_in_game/select.png"; 
						DesenharPPT(imagePPT, 570, 412);
					}, 0);
				}
			}


			function CentralizarCarta(){
			window.setTimeout(function() {
			Carta_drawn = new Image()
			Carta_drawn.src = "img/ddl_cartas/"+cartas_usuario[mid_lane].nome+".png"; 
			DesenharCarta_tabuleiro(Carta_drawn, cartas_usuario[mid_lane].burst, cartas_usuario[mid_lane].rage, cartas_usuario[mid_lane].ataque, cartas_usuario[mid_lane].defesa, 743, 217, 790, 256, 790, 373, 750, 315, 843, 315);
					}, 50);
			}


		function drawImageSeq(){
			bg_fundo = CriarImagem('img/back_ground_game.jpg', Fundo);
			
			
			Carta_draw = new Image()
			Carta_draw.src = "img/ddl_cartas/"+cartas_usuario[top_lane].nome+".png"; 
			DesenharCarta_tabuleiro(Carta_draw, cartas_usuario[top_lane].burst, cartas_usuario[top_lane].rage, cartas_usuario[top_lane].ataque, cartas_usuario[top_lane].defesa, 743, 20, 790, 62, 790, 180, 750, 120, 843, 124);
				
			Carta_draw1 = new Image()
			Carta_draw1.src = "img/ddl_cartas/"+cartas_usuario[mid_lane].nome+".png"; 
			DesenharCarta_tabuleiro(Carta_draw1, cartas_usuario[mid_lane].burst, cartas_usuario[mid_lane].rage, cartas_usuario[mid_lane].ataque, cartas_usuario[mid_lane].defesa, 743, 217, 790, 256, 790, 373, 750, 315, 843, 315);	
			
			Carta_draw2 = new Image()
			Carta_draw2.src = "img/ddl_cartas/"+cartas_usuario[bot_lane].nome+".png"; 
			DesenharCarta_tabuleiro(Carta_draw2, cartas_usuario[bot_lane].burst, cartas_usuario[bot_lane].rage, cartas_usuario[bot_lane].ataque, cartas_usuario[bot_lane].defesa, 743, 411, 790, 453, 790, 569, 750, 512, 843, 513);					
			
			// fazer essa bosta aqui da 1
			if(qtd_cartas_renderizar > 1){
				renderizar_tabuleiro();
			}
			
			//DesenharNames("Oponente", jogador_name);
		}
		
		function Comecar_Jogo(fase){
			
		// o parametro fase é uma das variaveis mais importante do sistema
		// diz em qual fase o jogo esta no momento, ppt, escolher fase, etc.
		
		if(fase == 'ppt')	{
			window.setTimeout(function() {
				Pedra_Papel_Tesoura_Desenhar();
			}, 10); // será executada dps de 2seg
				
			if(ppt){
			window.onkeydown = Pedra_Papel_Tesoura_Selecionar;
			} 
		
		}
			
		if(fase == 'escolher'){
			
			bg_fundo = CriarImagem('img/back_ground_game.jpg', Fundo);			
			window.setTimeout(function() {
				Selecionar_Desenhar();
			}, 10); // será executada dps de 2seg
			
				if(escolha_ativa){
				window.onkeydown = Escolha_Selecionar;
				}
			}
		
		
		}
		
		function animation_oponente(){
				
			var i = 0;
			
			 var intervalo = window.setInterval(function() {
				
				if(i==0){
					window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/oponente_animation/opo_ani0.png"; 
						DesenharPPT(imagePPT, 1, 287);
					}, 1);
				}
				if(i==1){
					window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/oponente_animation/opo_ani1.png"; 
						DesenharPPT(imagePPT, 1, 287);
					}, 1);
				}
				if(i==2){
					window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/oponente_animation/opo_ani2.png"; 
						DesenharPPT(imagePPT, 1, 287);
					}, 1);
				}
				if(i==3){
					window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/oponente_animation/opo_ani3.png"; 
						DesenharPPT(imagePPT, 1, 287);
					}, 1);
				}
				if(i==4){
					window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/oponente_animation/opo_ani4.png"; 
						DesenharPPT(imagePPT, 1, 287);
					}, 1);
				}
				if(i==5){
					window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/oponente_animation/opo_ani5.png"; 
						DesenharPPT(imagePPT,1, 287);
					}, 1);
				}
				if(i==6){
					window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/oponente_animation/opo_ani6.png"; 
						DesenharPPT(imagePPT, 1, 287);
					}, 1);
				}
				if(i==7){
					window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/oponente_animation/opo_ani7.png"; 
						DesenharPPT(imagePPT, 1, 287);
					}, 1);
				}
				if(i==8){
					window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/oponente_animation/opo_ani8.png"; 
						DesenharPPT(imagePPT, 1, 287);
					}, 1);
				}
				if(i==9){
					window.setTimeout(function() {
						imagePPT = new Image();
						imagePPT.src = "img/oponente_animation/opo_ani9.png"; 
						DesenharPPT(imagePPT, 1, 287);
					}, 1);
					
					i=0;
					
				} else {
				i++;
				}
			
			}, 200); // Executara isso em um intervalo de 50milisec
			window.setTimeout(function() {
				clearInterval(intervalo);
				
			}, 6500); // ficara executando a função de cima ate chegar a 2seg e 200 milisec
		
		}
	
	
		function Pedra_Papel_Tesoura_Desenhar(){
						
						if(selecao == 'pedra'){
						imagePPT = new Image();
						imagePPT.src = "img/ppt/pedra.png"; 
						DesenharPPT(imagePPT, 197, 250);
						}
						if(selecao == 'papel'){
						imagePPT2 = new Image();
						imagePPT2.src = "img/ppt/papel.png"; 
						DesenharPPT(imagePPT2, 197, 250);
						}
						if(selecao == 'tesoura'){
						imagePPT3 = new Image();
						imagePPT3.src = "img/ppt/tesoura.png"; 
						DesenharPPT(imagePPT3, 197, 250);
						}
						
						
		}
		
		
		
		function Pedra_Papel_Tesoura_Selecionar(e){
		

			if(ppt){	
				if(e.keyCode == 39){
					if(selecao == 'pedra'){
						selecao = 'papel';
					} else 
					if(selecao == 'papel'){
						selecao = 'tesoura';
					}
				}
				if(e.keyCode == 37){
					if(selecao == 'tesoura'){
						selecao = 'papel';
					} else 
					if(selecao == 'papel'){
						selecao = 'pedra';
					}
				}
				
				Pedra_Papel_Tesoura_Desenhar();
				
				if(e.keyCode == 13){
					
					
					ppt_adversario = random(1,3);
					
					if((ppt_adversario == 1) && (selecao == 'tesoura')){
						ppt_win = false;
					} else
					if((ppt_adversario == 2) && (selecao == 'pedra')){
						ppt_win = false;
					} else
			    	if((ppt_adversario == 3) && (selecao == 'papel')){
						ppt_win = false;
					} else  { ppt_win = true; }
							
					ppt = false;
					ppt_master = false;
				
					
				if(ppt_win){
				Comecar_Jogo('escolher');	
				
				} else {
					
				 //alert("Perdeu troxa");
				 Comecar_Jogo('escolher');		
				
				
}}}}


		function Selecionar_Desenhar(){
						
						if(vez_de_jogar == "jogador"){
						imagePPT = new Image();
						imagePPT.src = "img/escolher/primeiro_re.png"; 
						DesenharPPT(imagePPT, 240, 250);
						}
						if(vez_de_jogar == "oponente"){
						imagePPT2 = new Image();
						imagePPT2.src = "img/escolher/segundo_re.png"; 
						DesenharPPT(imagePPT2, 240, 250);
						}
		}
		
		function Escolha_Selecionar(e){
		

			if(escolha_ativa){	
				if(e.keyCode == 40){
						vez_de_jogar = "oponente";
				}
				if(e.keyCode == 38){
						vez_de_jogar = "jogador";
				}
				
				Selecionar_Desenhar();
				
				if(e.keyCode == 13){
					start_play();
					escolha_ativa = false;
				}
				
			}
		}
		
		
function random(par1, par2)
{
    // cast para inteiro, pois os parâmetros de entrada são tipos genéricos
    par1 = parseInt(par1);
    par2 = parseInt(par2);

    return (par1 + (Math.floor(Math.random() * (par2 + 1 - par1))));
    //Math.random() retorna uma número real aleatório entre 0 e 1
    //Math.floor retorna a parte inteira de um número real (na verdade o menor inteiro mais próximo)
} 
		
		function ComecarPartida(id_oponente, nivel, regiao){
				alert(regiao);
				if(nivel == "elite"){
					id_oponente += 8;
				}
				deck_oponente(id_oponente, regiao);
				partida_Em_Andamento = true;
				Animacao_Comecar_Partida();
		}
		
		function Animacao_Comecar_Partida() {
			 var i = 0;
			
			 var intervalo = window.setInterval(function() {
				
				if(i==0)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame1.png', Fundo);
				if(i==1)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame2.png', Fundo);
				if(i==2)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame3.png', Fundo);
				if(i==3)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame4.png', Fundo);
				if(i==4)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame5.png', Fundo);
				if(i==5)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame6.png', Fundo);
				if(i==6)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame7.png', Fundo);
				if(i==7)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame8.png', Fundo);
				if(i==8)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame9.png', Fundo);
				if(i==9)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame10.png', Fundo);
				if(i==10)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame11.png', Fundo);
				if(i==11)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame12.png', Fundo);
				if(i==12)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame13.png', Fundo);
				if(i==13)
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame14.png', Fundo);
				if(i==14){
				bg_fundo = CriarImagem('img/SplashTry1/Iniciar_Batalha/startgame15.png', Fundo);
				
				i=0;
				} else {
				i++;
				}
			
			}, 120); // Executara isso em um intervalo de 50milisec
			window.setTimeout(function() {
				clearInterval(intervalo);
				
				bg_fundo = CriarImagem('img/back_ground_game.jpg', Fundo)
			
				Comecar_Jogo('ppt');
				
			
				
			}, 1); // ficara executando a função de cima ate chegar a 2seg e 200 milisec
			}
		
		
		
		
		
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//////////////////// Menu 3 ////////////////////
			
			function EscolherNovato(IA){
				if((IA == 1)&&(novato1==true)){
						regiao = "espirito";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Novatos/Op1.png"; 
						DesenharPersonagens(imageMenu2, "1/8", 385, 205, 760, 245);
						FaltandoEsquerda();
				}
				if((IA == 2)&&(novato2==true)){
						regiao = "terra";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Novatos/Op2.png"; 
						DesenharPersonagens(imageMenu2, "2/8", 385, 205, 760, 245);
						NaoFaltando();
				}
				if((IA == 3)&&(novato3==true)){
						regiao = "agua";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Novatos/Op3.png"; 
						DesenharPersonagens(imageMenu2, "3/8", 385, 205, 760, 245);
						NaoFaltando();
				}
				if((IA == 4)&&(novato4==true)){
						regiao = "ar";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Novatos/Op4.png"; 
						DesenharPersonagens(imageMenu2, "4/8", 385, 205, 760, 245);
						NaoFaltando();
				}
				if((IA == 5)&&(novato5==true)){
						regiao = "fogo";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Novatos/Op5.png"; 
						DesenharPersonagens(imageMenu2, "5/8", 385, 205, 760, 245);
						NaoFaltando();
						window.onkeydown = EventoIniciarPartida();
				}
				if((IA == 6)&&(novato6==true)){
						regiao = "terra";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Novatos/Op6.png"; 
						DesenharPersonagens(imageMenu2, "6/8", 385, 205, 760, 245);
						NaoFaltando();
				}
				if((IA == 7)&&(novato7==true)){
						regiao = "ar";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Novatos/Op7.png"; 
						DesenharPersonagens(imageMenu2, "7/8", 385, 205, 760, 245);
						NaoFaltando();
				}				
				if((IA == 8)&&(novato8==true)){
						regiao = "fogo";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Novatos/Op8.png"; 
						DesenharPersonagens(imageMenu2, "8/8", 385, 205, 760, 245);
						FaltandoDireita();
				}

			}
			
			function EscolherElite(IAE){
				if((IAE == 1)&&(elite1==true)){
						regiao = "fogo";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Elite/OpE1.png"; 
						DesenharPersonagens(imageMenu2, "1/8", 385, 205, 760, 245);
						FaltandoEsquerda();
				}
				if((IAE == 2)&&(elite2==true)){
						regiao = "espirito";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Elite/OpE2.png"; 
						DesenharPersonagens(imageMenu2, "2/8", 385, 205, 760, 245);
						NaoFaltando();
				}
				if((IAE == 3)&&(elite3==true)){
						regiao = "agua";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Elite/OpE3.png"; 
						DesenharPersonagens(imageMenu2, "3/8", 385, 205, 760, 245);
						NaoFaltando();
				}
				if((IAE == 4)&&(elite4==true)){
						regiao = "ar";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Elite/OpE4.png"; 
						DesenharPersonagens(imageMenu2, "4/8", 385, 205, 760, 245);
						NaoFaltando();
				}
				if((IAE == 5)&&(elite5==true)){
						regiao = "espirito";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Elite/OpE5.png"; 
						DesenharPersonagens(imageMenu2, "5/8", 385, 205, 760, 245);
						NaoFaltando();
				}
				if((IAE == 6)&&(elite6==true)){
						regiao = "terra";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Elite/OpE6.png"; 
						DesenharPersonagens(imageMenu2, "6/8", 385, 205, 760, 245);
						NaoFaltando();
				}
				if((IAE == 7)&&(elite7==true)){
						regiao = "fogo";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Elite/OpE7.png"; 
						DesenharPersonagens(imageMenu2, "7/8", 385, 205, 760, 245);
						NaoFaltando();
				}				
				if((IAE == 8)&&(elite8==true)){
						regiao = "ar";
						imageMenu2 = new Image();
						imageMenu2.src = "img/Enemy/Elite/OpE8.png"; 
						DesenharPersonagens(imageMenu2, "8/8", 385, 205, 760, 245);
						FaltandoDireita();
				}
			}
			function SplashTry4(i){
				
				if(partida_Em_Andamento == false){
					
			if(i == 1){
				EscolherNovato(IOponente);
				MenuEscolha = 1;
				window.onkeydown = PressMenu3;
			}
			if(i == 2){
				EscolherElite(IOponenteE);
				MenuEscolha = 2;
				window.onkeydown = PressMenu3;
			}
			
				}
				
			}
			function PressMenu3(e){
			if(partida_Em_Andamento == false){
				var ManterEscolha = true;
				if(MenuEscolha == 1){
					
				if((e.keyCode == 37) && (IOponente > 1)) {
					IOponente--; 
				}
				if((e.keyCode == 39) && (IOponente < 8)) {
					IOponente++; 
				}
				if(e.keyCode == 27){
					EscolherAdversario1();
					ManterEscolha = false;
					window.onkeydown = PressMenu2;	
				}
				if(e.keyCode == 13){
					// proximos eventos, uffa! deu trabalho pra relembrar
					alert(IOponente);
					ComecarPartida(IOponente, 'novato', regiao);
				}
				
				
				
				
				if(ManterEscolha)
				EscolherNovato(IOponente); 
				

				} 
				
				
				else 
				
				if(MenuEscolha == 2){
				if((e.keyCode == 37) && (IOponenteE > 1)) {
					IOponenteE--; 
				}
				
				if((e.keyCode == 39) && (IOponenteE < 8)) {
					IOponenteE++; 
				}

				if(e.keyCode == 27){
					EscolherAdversario2();
					ManterEscolha = false;
					window.onkeydown = PressMenu2;
					
				}
				
				if(e.keyCode == 13){
					
					// proximos eventos, uffa! deu trabalho pra relembrar
					ComecarPartida(IOponenteE, 'elite' ,regiao);
					
					
				}

				if(ManterEscolha)
				EscolherElite(IOponenteE); 
				
				
				} 
				
			}
				
			}		
		
			//////////////////// Menu 2 ////////////////////	
			
			
			function SplashTry1() {
			 var i = 0;
			
			 var intervalo = window.setInterval(function() {
				
				if(i==0)
				bg_fundo = CriarImagem('img/SplashTry1/sp0.png', Fundo);
				if(i==1)
				bg_fundo = CriarImagem('img/SplashTry1/sp1.png', Fundo);
				if(i==2)
				bg_fundo = CriarImagem('img/SplashTry1/sp2.png', Fundo);
				if(i==3)
				bg_fundo = CriarImagem('img/SplashTry1/sp3.png', Fundo);
				if(i==4){
				bg_fundo = CriarImagem('img/SplashTry1/sp4.png', Fundo);
				i=0;
				} else {
				i++;
				}
			
			}, 300); // Executara isso em um intervalo de 50milisec
			window.setTimeout(function() {
				clearInterval(intervalo);
				EscolherAdversario1();
				window.onkeydown = PressMenu2;
				
				
			
				
			}, 1); // ficara executando a função de cima ate chegar a 2seg e 200 milisec
			}
			

			function PressMenu2(e){
			 
			 if(partida_Em_Andamento == false){
			 
             if((e.keyCode == 38)){
				EscolherAdversario1();
			 }
			
			 if((e.keyCode == 40)){
				EscolherAdversario2();
			 }
			 if(e.keyCode == 13){
				 indiceMenu2 = false;
				 SplashTry4(IndMenu);
			 }
			 }
			}
			
			function EscolherAdversario1(){
				IndMenu = 1;
				imageMenu2 = new Image();
				imageMenu2.src = "img/Menu2Try3/bgMenu1.png"; 
				DesenharImagemTextMenu2(imageMenu2, "Novatos", "Os novatos são", 400, 200, 400, 250);
			}
			
			function EscolherAdversario2(){
				IndMenu = 2;
				imageMenu2 = new Image();
				imageMenu2.src = "img/Menu2Try3/bgMenu2.png"; 
				DesenharImagemTextMenu2(imageMenu2, "Elite", "Os Elites são", 400, 200, 400, 250);
			}
			


			function FaltandoEsquerda(){
				imageRight = new Image();
				imageRight.src = "img/setas/right.png"; 
				DesenhaP(imageRight , 790, 220);

				imageLeft = new Image();
				imageLeft.src = "img/setas/leftno.png"; 
				DesenhaP(imageLeft , 720, 220);

			}

			function FaltandoDireita(){
				imageRight = new Image();
				imageRight.src = "img/setas/rightno.png"; 
				DesenhaP(imageRight , 790, 220);

				imageLeft = new Image();
				imageLeft.src = "img/setas/left.png"; 
				DesenhaP(imageLeft , 720, 220);

			}

			function NaoFaltando(){
				imageRight = new Image();
				imageRight.src = "img/setas/right.png"; 
				DesenhaP(imageRight , 790, 220);

				imageLeft = new Image();
				imageLeft.src = "img/setas/left.png"; 
				DesenhaP(imageLeft , 720, 220);

			}

					
			/////////////////////////////////////////////////////////////////////////////
			

		
			//////////////////// Menu 1 ///////////////////////
			
			function PressMenu1(e)
			{
				// Menu 1
				if(indiceMenu1){
			// Verificar se esta clicando para Cima
             if((e.keyCode == 37) && (indice != 4)){ // esq
				indice = 4;
				carregaImagem();
			 }
			// Verifica se esta clicando para Baixo
			 if((e.keyCode == 39) && (indice == 4)){ // direita
				indice = 1;
				carregaImagem();
			 }
			 if((e.keyCode == 38)&&(indice >= 2)){// cima
				 indice--;
				 carregaImagem();
			 }
			 if((e.keyCode == 40)&&(indice <= 3)){// baixo
				 indice++;
				 carregaImagem();
			 }
			 if((e.keyCode == 13)&&(indiceMenu1)){
				 GameLoop();
				 indiceMenu1 = false;
			 }
				}
			 
			}
			
            function carregaImagem() {
					bg_fundo = CriarImagem('img/MenuTry0/SoloBG.png', Fundo);
				
				if(indice == 1){
					bg_fundo = CriarImagem('img/MenuTry0/SoloBG.png', Fundo);
				}
				if(indice == 2){
					bg_fundo = CriarImagem('img/MenuTry0/SoloBG1.png', Fundo);
				}
				if(indice == 3){
					bg_fundo = CriarImagem('img/MenuTry0/SoloBG2.png', Fundo);
				}
				if(indice == 4){
					bg_fundo = CriarImagem('img/MenuTry0/SoloBG3.png', Fundo);
				}
            }


			
			window.onkeydown = PressMenu1;
            window.onload = carregaImagem;
			window.onmousedown = pressionaMouse;

        
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
					LimparTela();
				}
			
			}
			
			
			
		

        </script>


</head>

<body>
<div class="login_style" id="bg_logonApp">
  
  <div class="logon_logo" id="logon_logoApp"><img src="../image/Logo.png" width="250" height="110"></div>
  <div class="login_color" id="bg_appCentral">
    <canvas id="Menu" width="900" height="600"> Se você visualizar esse texto, seu browser não suporta a tag canvas. </canvas>
 	  </div>
</div>
</body>
</html>
