<?php

/*
//Criar a conexão
$conn = mysqli_connect($host, $user, $password);
mysqli_select_db($conn, )

if(!$conn){
    die("Falha na conexão - " . mysqli_connect_error());
} else {

}
*/


$conn = mysqli_connect("mysql.hostinger.com.br", "u976247183_root","feristow1508", "u976247183_ctc");

//mysqli_select_db($link, "projetoctc");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>