<?php

$usuario = $_GET['pesqusuario'];
$status = $_GET['pesqstatus'];

if($usuario == "" AND $status == ""){
    $resultado = mysqli_query($conn, "SELECT * FROM users ORDER BY id");
} else if($usuario != "" AND $status == "") {
    $resultado = mysqli_query($conn, "SELECT * FROM users WHERE username = '$usuario' ORDER BY id");
} else if($usuario != "" AND $status != "") {
    $resultado = mysqli_query($conn, "SELECT * FROM users WHERE username = '$usuario' AND status = '$status' ORDER BY id");
} else if ($usuario == "" AND $status != "") {
    $resultado = mysqli_query($conn, "SELECT * FROM users WHERE status = '$status' ORDER BY id");
}

$users = mysqli_num_rows($resultado);

while($users = mysqli_fetch_array($resultado)){
    echo "<tr>";
    echo "<td>" . $users['id'] . "</td>";
    echo "<td>" . $users['username'] . "</td>";
    echo "<td>" . $users['status'] . "</td>";
    echo "<td>";
    $nivelid = $users['level_id'];
    $querynivel = mysqli_query($conn, "SELECT * FROM levels WHERE id = '$nivelid'");
    $result = mysqli_num_rows($querynivel);
    while($result = mysqli_fetch_array($querynivel)){
        echo $result['description'];
    }
    echo "</td>";
    echo "<td>" . $users['created'] . "</td>";
    echo "<td>" . $users['modified'] . "</td>";
    echo "<td><form method='get' action='alterarusuario.php'><button type='submit' class='btn btn-warning btn-sm' name='botao' value='" . $users['id'] . "'>Alterar</button></form></td>";
    echo "<td><form method='get' action='../back/deleteuser.php'><button type='submit' class='btn btn-danger btn-sm' name='botaoexcluir' value='" . $users['id'] . "'><i class='fa fa-times' aria-hidden='true'></i></button></td></form>";
    echo "</tr>";
}

?>