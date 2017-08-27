<?php

session_start();

require_once 'security.php';
require_once 'conexao.php';

$arquivo = 'Relatorio Chamados CTC.xls';

if(isset($_GET['dtini']) && isset($_GET['dtfim'])){
    $ini = $_GET['dtini'];
    $dtfim = $_GET['dtfim'];
    $chamados = mysqli_query($conn, "SELECT * FROM tickets WHERE serviceday >= '$ini' AND serviceday <= '$dtfim'");
    $c = mysqli_num_rows($chamados);
} else {
    $chamados = mysqli_query($conn, "SELECT * FROM tickets");
    $c = mysqli_num_rows($chamados);
}

$html = "";
$html .= "<table border='1'>";
$html .= "<tr>";
$html .= "<td>Chamado</td>";
$html .= "<td>Data</td>";
$html .= "<td>Período</td>";
$html .= "<td>Projeto</td>";
$html .= "<td>Status</td>";
$html .= "<td>Empresa</td>";
$html .= "<td>Cidade</td>";
$html .= "<td>Valor</td>";
$html .= "</tr>";

while($c = mysqli_fetch_array($chamados)){
   $html .= "<tr>";
   $html .= "<td>" . $c['id'] . "</td>";

   $html .= "<td>" . $c['serviceday'] . "</td>"; 

   $html .= "<td>" . $c['period'] . "</td>";

   $html .= "<td>" . $c['project'] . "</td>";

   $html .= "<td>" . $c['status'] . "</td>"; 

   $comp = $c['company'];
   $company = mysqli_query($conn, "SELECT * FROM companies WHERE id = $comp");
   $lcomp = mysqli_fetch_array($company);
   $html .= "<td>" . $lcomp['name'] . "</td>";

   $html .= "<td>" . utf8_decode($c['city']) . "</td>";

   $html .= "<td>" . $c['valor'] . "</td>"; 
   
   $html .= "</tr>";
}

// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel; charset=utf-8");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );
// Envia o conteúdo do arquivo
echo $html;
exit; 
header("Location: .php");
?>

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

