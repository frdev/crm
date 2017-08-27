<?php

require "../PHPMailer/PHPMailerAutoload.php";

$empresa = $_POST['empresa'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];

$Mailer = new PHPMailer();

//Definindo SMTP
$Mailer->IsSMTP();
//Enviar e-mail em HTML
$Mailer->isHTML(true);

//Aceita caracteres especiais
$Mailer->Charset = 'UTF-8';
//Configurações SMTP
$Mailer->SMTPAuth = true;
$Mailer->SMTPSecure = "ssl";

//Nome do servidor
$Mailer->Host = 'smtp.gmail.com';
//Porta de saída
$Mailer->Port = 465;

//Configurar conta de email
$Mailer->Username = 'felipertw2@gmail.com';
$Mailer->Password = 'euamoamozinho';

//Email remetente
$Mailer->From = $email;

//Nome remetente
$Mailer->FromName = $empresa;

//Assunto da mensagem
$Mailer->Subject = 'Parceria Connectcom';

//Corpo da mensagem
$Mailer->Body = 'Telefone: ' . $telefone . '\nMensagem: ' . $mensagem;

//Corpo da mensagem em texto
$Mailer->AltBody = 'Telefone: ' . $telefone . '\nMensagem: ' . $mensagem;

//Destinatario
$Mailer->AddAddress('felipertw2@gmail.com');

if($Mailer->Send()){
    header("Location: ../front/login.php");
} else {
    echo "Erro ao enviar e-mail" . $Mailer->ErrorInfo;
}



?>