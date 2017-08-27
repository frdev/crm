<?php
session_start();
include_once("conexao.php");

$id = $_POST['idusuario'];
$usuario = $_POST['username'];
$senha = $_POST['password'];
$empresa = $_POST['company'];
$status = $_POST['status'];
$level = $_POST['level'];

$select = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
$total = mysqli_num_rows($select);

while($total = mysqli_fetch_array($select)){
    $senhaatual = $total['password'];
}

if($senhaatual == $senha){
    $query = mysqli_query($conn, "UPDATE users SET username = '$usuario',  
    company_id = $empresa, 
    level_id = $level,
    status = '$status',
    modified = now()
    WHERE  id = $id");
} else {
    $senha = md5($senha);
    $query = mysqli_query($conn, "UPDATE users SET username = '$usuario', 
    password = '$senha', 
    company_id = $empresa, 
    level_id = $level,
    status = '$status',
    modified = now()
    WHERE  id = $id");
}


$_SESSION['changeUserSuccess'] = "Usuário " . $usuario . " alterado com sucesso";
header("Location: ../front/listarusuarios.php");


?>
