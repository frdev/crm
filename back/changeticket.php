<?php
session_start();
include_once("conexao.php");

$id = $_POST['numchamado'];
$status = $_POST['status'];
$per = $_POST['periodo'];
$valor = $_POST['valor'];
$cli = $_POST['nomecliente'];
$telefone = $_POST['telcliente'];
$data = $_POST['dataat'];
$projeto = $_POST['projeto'];
$empresa = $_POST['empresa'];
$cep = $_POST['cep'];
$logradouro = $_POST['logradouro'];
$numlocal = $_POST['numlocal'];
$comp = $_POST['complemento'];
$city = $_POST['city'];
$uf = $_POST['uf'];
$ab = $_POST['mensagem'];
$cl = $_POST['fechamento'];
$horainicio = $_POST['horainicio'];
$horafim = $_POST['horafinal'];




$query = mysqli_query($conn, "UPDATE tickets SET id = $id, 
status = '$status', 
serviceday = '$data', 
period = '$per', 
valor = $valor, 
clientname = '$cli', 
phones = '$telefone', 
project = '$projeto', 
company = $empresa, 
zipcode = '$cep', 
street = '$logradouro', 
numb = $numlocal, 
complement = '$comp', 
city = '$city', 
state = '$uf', 
opendescription = '$ab', 
closedescription = '$cl',
hourstart = '$horainicio',
hourfinish = '$horafim' WHERE id = $id");

$_SESSION['altchamado'] = "Chamado " . $id . " alterado com sucesso.";


header("Location: ../front/listarchamados.php");


?>