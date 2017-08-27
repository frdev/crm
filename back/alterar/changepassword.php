<?php
session_start();
include_once("../conexao.php");
include_once("../security.php");

$userid = $_SESSION['userid'];
$oldpassword = md5($_SESSION['password']);
$newpassword = md5($_POST['newpassword']);

$query = mysqli_query($conn, "UPDATE users SET password = '$newpassword' WHERE id = $userid");

$_SESSION['changePasswordSuccess'] = "Senha alterada com sucesso.";
header("Location: ../../front/alterarsenha.php");

?>
