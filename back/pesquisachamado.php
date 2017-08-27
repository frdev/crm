<?php

$empresa = $_SESSION['company_id'];
$chamado = $_GET['pesqchamado'];
$projeto = $_GET['pesqprojeto'];
$emp = $_GET['pesqempresa'];
$data = $_GET['data'];
$datafinal = $_GET['datafinal'];
$status = $_GET['pesqstatus'];
$dt = date("Y-m-d");


if($empresa == 1){
    $resultado = mysqli_query($conn, "SELECT * FROM tickets ORDER BY serviceday DESC");
    if($chamado != ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE id = $chamado ORDER BY serviceday DESC");
    } else 
    if($projeto != "" && $emp == "" && $data == "" && $datafinal == "" && $status == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE project = '$projeto' ORDER BY serviceday DESC");
    } else
    if($emp != "" && $projeto == "" && $data == "" && $datafinal == "" && $status == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE company = $emp ORDER BY serviceday DESC");
    } else
    if($projeto == "" && $emp == "" && $data != "" && $datafinal == "" && $status == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE serviceday = '$data' ORDER BY serviceday DESC");
    } else
    if($projeto == "" && $emp == "" && $data != "" && $datafinal != "" && $status == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE serviceday >= '$data' AND serviceday <= '$datafinal' ORDER BY serviceday DESC");
    } else
    if($projeto != "" && $emp == "" && $data != "" && $datafinal != "" && $status == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE serviceday >= '$data' AND serviceday <= '$datafinal' AND project = '$projeto' ORDER BY serviceday DESC");
    } else
    if($projeto != "" && $emp == "" && $data != "" && $datafinal == "" && $status == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE serviceday = '$data' AND project = '$projeto' ORDER BY serviceday DESC");
    } else 
    if($projeto == "" && $emp != "" && $data != "" && $datafinal == "" && $status == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE serviceday = '$data' AND company = $emp ORDER BY serviceday DESC");
    } else 
    if($projeto == "" && $emp != "" && $data != "" && $datafinal != "" && $status == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE serviceday >= '$data' AND serviceday <= '$datafinal' AND company = $emp ORDER BY serviceday DESC");
    } else
    if($status != "" /*&& $emp == "" && $projeto == "" && $data == "" && $datafinal == ""*/){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE status = '$status' ORDER BY serviceday DESC");
    } /*else
    if($status != "" && $emp == "" && $projeto == "" && $data != "" && $datafinal == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE status = '$status' AND serviceday = '$data' ORDER BY serviceday DESC");
    } else
    if($status != "" && $emp == "" && $projeto == "" && $data != "" && $datafinal != ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE status = '$status' AND serviceday >= '$data' AND serviceday <= '$datafinal' ORDER BY serviceday DESC");
    } else
    if($status != "" && $emp != "" && $projeto == "" && $data != "" && $datafinal != ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE status = '$status' AND serviceday >= '$data' AND serviceday <= '$datafinal' AND company = $emp ORDER BY serviceday DESC");
    }*/
} else {
    $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE company = $empresa ORDER BY serviceday DESC");
    if($chamado != ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE id = $chamado AND company = $empresa ORDER BY serviceday DESC");
    } else 
    if($emp == "" && $projeto != "" && $data == "" && $datafinal == "" && $status == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE project = '$projeto' AND company = $empresa ORDER BY serviceday DESC");
    } else
    if($projeto == "" && $emp == "" && $data != "" && $datafinal == "" && $status == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE serviceday = '$data' AND company = $empresa ORDER BY serviceday DESC");
    } else 
    if ($projeto == "" && $emp == "" && $data != "" && $datafinal != "" && $status == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE serviceday >= '$data' AND serviceday <= '$datafinal' AND company = $empresa ORDER BY serviceday DESC");
    } else
    if($projeto != "" && $emp == "" && $data != "" && $datafinal != "" && $status == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE serviceday >= '$data' AND serviceday <= '$datafinal' AND project = '$projeto' AND company = $empresa ORDER BY serviceday DESC");
    } else
    if($projeto != "" && $emp == "" && $data != "" && $datafinal == "" && $status == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE serviceday = '$data' AND project = '$projeto' AND company = $empresa ORDER BY serviceday DESC");
    } else
    if($status != "" && $emp == "" && $projeto == "" && $data == "" && $datafinal == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE status = '$status' AND company = $empresa ORDER BY serviceday DESC");
    } /*else
    if($status != "" && $emp == "" && $projeto == "" && $data != "" && $datafinal == ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE status = '$status' AND serviceday = '$data' AND company = $empresa ORDER BY serviceday DESC");
    } else
    if($status != "" && $emp == "" && $projeto == "" && $data != "" && $datafinal != ""){
        $resultado = mysqli_query($conn, "SELECT * FROM tickets WHERE status = '$status' AND serviceday >= '$data' AND serviceday <= '$datafinal' AND company = $empresa ORDER BY serviceday DESC");
    }*/
}
$total = mysqli_num_rows($resultado);
$linhas = mysqli_num_rows($resultado);
while($linhas = mysqli_fetch_array($resultado)){
    $idemp = $linhas['company'];
    $emp = mysqli_query($conn, "SELECT * FROM companies WHERE id = $idemp");
    $result = mysqli_num_rows($emp);
    echo "<tr>";
    if($linhas['serviceday'] == $dt){
        echo "<td><b>" . $linhas['id'] . "</b></td>";
        echo "<td><b><span class='text-success'>" . $linhas['serviceday'] . "</span></b></td>";
    } else {
        echo "<td>" . $linhas['id'] . "</td>";
        echo "<td>" . $linhas['serviceday'] . "</td>";
    }
    echo "<td>" . $linhas['period'] . "</td>";
    echo "<td>" . $linhas['project'] . "</td>";
    if($linhas['status'] == 'Roteirizar'){
        echo "<td class='text-warning'><b>" . $linhas['status'] . "</b></td>";
    } else if($linhas['status'] == 'Agendado'){
        echo "<td class='text-info'><b>" . $linhas['status'] . "</b></td>";
    } else if($linhas['status'] == 'Fechado'){
        echo "<td class='text-success'><b>" . $linhas['status'] . "</b></td>";
    } else if($linhas['status'] == 'Encerrado'){
        echo "<td><b>" . $linhas['status'] . "</b></td>";
    } else if($linhas['status'] == 'Cancelado'){
        echo "<td class='text-danger'><b>" . $linhas['status'] . "</b></td>";
    }
    
    while($result = mysqli_fetch_array($emp)){
        echo "<td>" . $result['name'] . "</td>";
    }
    echo "<td>" . $linhas['city'] . "</td>";
    if($empresa == 1){
    echo "<td>" . $linhas['valor'] . "</td>";
    }
    echo "<td><form method='get' action='../front/verchamado.php'><button type='submit' name='ver' class='btn btn-info btn-sm' value='"
        . $linhas['id'] ."'>Ver</button></form>";
    if($linhas['status'] == 'Agendado' || $linhas['status'] == 'Roteirizar'){
        echo "<td><form method='get' action='../front/fecharchamado.php'><button type='submit' name='fechar' class='btn btn-success btn-sm' value='"
            . $linhas['id'] ."'>Fechar</button></form>";
        if($_SESSION['level_id'] == 1) {
            echo "<td><form method='get' action ='../front/alterarchamado.php'><button type='submit' class='btn btn-warning btn-sm' name='alterar' value='"
                . $linhas['id'] . "'>Alterar</button></form></td>";
        }
    } else {
        if($_SESSION['level_id'] == 1){
            echo "<td></td>";
            echo "<td><form method='get' action ='../front/alterarchamado.php'><button type='submit' class='btn btn-warning btn-sm' name='alterar' value='"
                . $linhas['id'] . "'>Alterar</button></form></td>";
        }
    }
    echo "</tr>";
}
?>