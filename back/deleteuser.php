<?php

include_once("conexao.php");

$id = $_GET['botaoexcluir'];

$query = mysqli_query($conn, "DELETE FROM users WHERE id = $id");

header("Location: ../front/listarusuarios.php");

?>