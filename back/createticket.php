<?php
session_start();
include_once("../conexao.php");
include_once("../security.php");

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

    $_SESSION['altchamado'] = "Chamado " . $numchamado . " criado com sucesso.";
    header("Location: ../../front/listarchamados.php");
}

?>