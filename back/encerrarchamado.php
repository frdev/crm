<?php
session_start();
include_once("conexao.php");
include_once("security.php");

$idchamado = $_GET['id'];

$select = mysqli_query($conn, "UPDATE tickets SET status = 'Encerrado' WHERE id = $idchamado");

$_SESSION['altchamado'] = "Chamado " . $id . " alterado com sucesso.";

header("Location: ../front/listarchamados.php?pesqchamado=&pesqstatus=Fechado&pesqprojeto=&pesqempresa=&data=&datafinal=");

?>