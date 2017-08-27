<?php
session_start();
include_once("../conexao.php");
include_once("../security.php");

$project = $_POST['project'];

$select = mysqli_query($conn, "SELECT * FROM projects WHERE description = '$project'");

if(mysqli_num_rows($select) < 1){
    $query = mysqli_query($conn, "INSERT INTO projects (description) VALUES ('$project')");
    header("Location: ../../front/listarprojetos.php");
} else {
    $_SESSION['projectCreateError'] = "Projeto já existente.";
    header("Location: ../../front/criarprojeto.php");
}

?>