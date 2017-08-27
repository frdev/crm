<?php
session_start();
include_once("../conexao.php");
include_once("../security.php");

$username = $_POST['username'];
$password = $_POST['password'];
$password = md5($password);
$company = $_POST['empresa'];
$status = $_POST['status'];
$level = $_POST['nivel'];

$select = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");


if(mysqli_num_rows($select) < 1){
    $query = mysqli_query($conn, "INSERT INTO users (username, password, company_id, level_id, status, created)
 VALUES ('$username', '$password', '$company', '$level', '$status', NOW())");
    header("Location: ../../front/listarusuarios.php");
} else {
    $_SESSION['userCreateError'] = "Usuário já cadastrado";
    header("Location: ../../front/criarusuario.php");
}

?>
