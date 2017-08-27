<?php
session_start();
include_once("../conexao.php");
include_once("../security.php");
require_once("../../phpmailer/class.phpmailer.php");

$numchamado = $_POST['numchamado'];
$status = $_POST['status'];
$dataat = $_POST['dataat'];
$periodo = $_POST['periodo'];
$valor = $_POST['valor'];
$cliente = $_POST['nomecliente'];
$tel = $_POST['telcliente'];
$projeto = $_POST['project'];
$empresa = $_POST['company'];
$cep = $_POST['zipcode'];
$logradouro = $_POST['street'];
$numlocal = $_POST['numlocal'];
$comp = $_POST['complement'];
$cidade = $_POST['city'];
$uf = $_POST['uf'];
$descab = $_POST['descab'];

$select = mysqli_query($conn, "SELECT id FROM tickets WHERE id = $numchamado");
$lista = mysqli_num_rows($select);

if($lista > 0){
    $_SESSION['ticketCreateError'] = "Chamado já existente.";
    header("Location: ../../front/abrirchamado.php");
} else {
    mysqli_query($conn, "INSERT INTO tickets (id, company, project, serviceday, period, valor, clientname, phones, opendescription, status, street, numb, complement, zipcode, city, state, closedescription, attachment) VALUES
($numchamado, $empresa, '$projeto', '$dataat', '$periodo', $valor, '$cliente', '$tel', '$descab', '$status', '$logradouro', '$numlocal', '$comp', '$cep', '$cidade', '$uf', null, null)");
/*
    //Variável que junta os valores acima e monta corpo do e-mail
    $Vai = "Chamado: " . $numchamado . "\n";
    $Vai .= "Data atendimento: " . $dataat . "\n";
    $Vai .= "Periodo: " . $periodo . "\n";
    $Vai .= "Projeto: " . $projeto . "\n";
    $Vai .= "Endereço: " . $logradouro . ", " . $numlocal . ", Complemento: " . $comp . ", CEP: " . $cep . "Cidade: " . $cidade . ", UF: " . $uf . "\n";
    $Vai .= "Descrição chamado: " . $descab . "\n";
    $Vai .= "Maiores informações, acessar a ferramenta -> frdev.16mb.com";

    require_once("../../phpmailer/class.phpmailer.php"); 

    define('GUSER', 'ctcchamados@gmail.com'); //<-- Insira aqui o seu gmail
    define('GPWD', 'ctcsp11@'); //<-- Senha

    function smtpmailer($para, $de, $de_nome, $assunto, $corpo){
    	global $error;
    	$mail = new PHPMailer();
    	$mail->IsSMTP();
    	$mail->SMTPDebug = 0;
    	$mail->SMTPAuth = true;
    	$mail->SMTPSecure = 'ssl';
    	$mail->Host = 'smtp.gmail.com';
    	$mail->Port = 465;
    	$mail->Username = GUSER;
    	$mail->Password = GPWD;
    	$mail->SetFrom($de, $de_nome);
    	$mail->Subject = $assunto;
    	$mail->Body = $corpo;
    	$mail->AddAddress($para);
    	if(!$mail->Send()){
    		$_SESSION['envioemail'] = "Mail error: " . $mail->ErrorInfo;
    		return false;
    	} else {
    		$_SESSION['envioemail'] = "Mensagem enviada!";
    		return true;
    	}
    }
    
    if($status == 'Agendado' && $empresa != 1){
        if (smtpmailer('felipertw2@gmail.com', 'ctcchamados@gmail.com', 'Teste', 'Teste', $Vai)) {
            echo $_SESSION['envioemail'];
        }
        if (!empty($error)) echo $error;
    }
*/
    $_SESSION['altchamado'] = "Chamado " . $numchamado . " criado com sucesso.";
    header("Location: ../../front/listarchamados.php");
}

?>