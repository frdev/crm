<?php
session_start();
include_once("../conexao.php");
include_once("../security.php");

$company = $_POST['company'];

$select = mysqli_query($conn, "SELECT * FROM companies WHERE name = '$company'");

if(mysqli_num_rows($select) < 1){
    $query = mysqli_query($conn, "INSERT INTO companies (name) VALUES ('$company')");
    header("Location: ../../front/listarempresas.php");
} else {
    $_SESSION['companyCreateError'] = "Empresa já existente.";
    header("Location: ../../front/criarempresa.php");
}

?>