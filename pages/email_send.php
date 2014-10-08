<?php require_once('../Connections/conexao.php'); ?>
<?php
// VARIAVEIS DE CONEXAO
$erro             = "";

$confirmacao             = "";
$msg_final = "";

if (isset($_GET['confirm'])) {
	$confirmacao = $_GET['confirm'];
	}
	
if($confirmacao == "tr"){
	$msg_final = "Email enviado! não esqueça de verificar a caixa de spams";
} else if($confirmacao == "fa"){
$msg_final = "Esse Email não esta cadastrado no sistema!";	
} else if($confirmacao == "try"){
	$msg_final = "Algum erro aconteceu, por favor, tente novamente!";	
} else if($confirmacao == "valid"){
	$msg_final = "Essa conta já está valida!";	
}


	
if(isset($_POST['cad_users']) && $_POST['cad_users'] == 'cad'){
// VARIAVEIS DE FORMULARIO
// Insert para pessoa

$mail           = $_POST["email"];
$confirm = false;
///////////////////////////////////////////////////////////////////////////////	
$usuario_cad = mysql_query("SELECT email FROM pessoa WHERE email = '$mail'")
              or die(mysql_error());
if(@mysql_num_rows($usuario_cad) >= '1')
	$confirm = true;

if($confirm){
	
		$NomeUser = "";
		$NomeBusca = mysql_query("SELECT DISTINCT Nome FROM pessoa WHERE email='$mail'");
		$NomeUser = mysql_fetch_row($NomeBusca);

		$CodigoValidate = "";
		$CodigoValidateBusca = mysql_query("SELECT DISTINCT Codigo_Validate FROM pessoa WHERE email='$mail'");
		$CodigoValidate = mysql_fetch_row($CodigoValidateBusca);
		
		$EstadoConta = "";
		$EstadoContaBusca = mysql_query("SELECT DISTINCT Validate FROM pessoa WHERE email='$mail'");
		$EstadoConta = mysql_fetch_row($EstadoContaBusca);

if($EstadoConta[0] == "true"){
		header ("location: email_send.php?confirm=valid");
} else {

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
$PHPMailer->Host = 'mx1.hostinger.com.br';
$PHPMailer->Port = '2525';
$PHPMailer->Username = 'contato@cardsofpandora.hol.es';
$PHPMailer->Password = 'thales123';
$PHPMailer->SMTPDebug = 1; 
 
// E-Mail do remetente (deve ser o mesmo de quem fez a autenticação
// nesse caso seu_login@gmail.com)
$PHPMailer->From = 'contato@cardsofpandora.hol.es';
 
// Nome do rementente
$PHPMailer->FromName = 'Cards Of Pandora';
 
// assunto da mensagem
$PHPMailer->Subject = 'Confirmação de Conta - Beta 1.0';
 
// corpo da mensagem
$PHPMailer->Body = '<h2 color = "red"> Sejá Bem Vindo ao mundo de Cards Of Pandora Beta 1.0! </h2> <br> <img src="http://i.imgur.com/O3VVCLb.png" align="center"> <br> <h3> Vejo que você e novo por aqui no Cards of Pandora, aqui acabamos com os inimigos e sempre lutamos para vencer! Então Prepare-se!!! </h3> <br> <h3> Olá '. $NomeUser[0] .', obrigado por testar nosso jogo, para validar a sua conta, por favor clique no link a baixo:</h3> <br> <h4><a href="http://cardsofpandora.hol.es/pages/confirmar.php?id='.$CodigoValidate[0].'"> http://cardsofpandora.hol.es/pages/confirmar.php?id='.$CodigoValidate[0].' </a><h4> <br> <h4> Caso não funcione por favor copie e cole no seu navegador </h4>';
 
// corpo da mensagem em modo texto
//$PHPMailer->AltBody = 'Mensagem em texto';
 
// adiciona destinatário (pode ser chamado inúmeras vezes)
$j = true;
while($j == true){
$PHPMailer->AddAddress( $mail );
if ($PHPMailer->Send())
{
	break;
	header ("location: email_send.php?confirm=tr");
}
}
}
	}else{
	header ("location: email_send.php?confirm=fa");
}
//@header ("location:registro.php?error=$erro");
}
?>
<!doctype html>
<html>
<head>
<meta charset="iso-8859-1">
<title>Cards Of Pandora Online</title>
<link href="../script/script.css" rel="stylesheet" type="text/css">
<link href="Script/css/email_send.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="" id="bg_inicial"><img src="../image/bg/label-3.png" width="1080" height="660" usemap="#campo_menu">

  <map name="campo_menu">
    <area shape="rect" coords="730,95,876,133" href="historia.php">
    <area shape="rect" coords="581,95,724,132" href="../index.php">
	</map>
  <div class="letras" id="EstiloCenter">Reenviar email de confirma&ccedil;&atilde;o
    <form name="form2" method="post" action="">
      <p><label>E-mail:</label>  
        <input type="email" id="email" name="email" required> 
        <input type="hidden" name="cad_users" value="cad" />
        <input type="submit" value="Enviar">
      </p>
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
    <div class="letras" id="Btn_Voltar">  </a>
      <form name="form1" method="post" action="../index.php">
        <input type="submit" name="confirmar" id="confirmar" value="Voltar" class="bradiusBTN" width="100" height="100">
      </form>
    </div>
</div>
<div class="letras" id="apDiv13"><?php echo $msg_final ?></div>
</body>
</html>
