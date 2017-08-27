<?php

session_start();
include_once("conexao.php");
include_once("security.php");


//Verifica se houve POST e se o usuário ou a senha está ou estão vazios
if((isset($_POST['inputUsername'])) && (isset($_POST['inputPassword']))){
    $user = mysqli_real_escape_string($conn, $_POST['inputUsername']);
    $password = mysqli_real_escape_string($conn, $_POST['inputPassword']);
    $password = md5($password);

    $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$password' AND status = 'Ativo' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $resultado = mysqli_fetch_assoc($result);


    if(empty($resultado)){
        $_SESSION['loginError'] = "Usuário ou senha inválidos.";
        header("Location: ../front/login.php");
    } else if(isset($resultado)){
        $_SESSION['userid'] = $resultado['id'];
        $_SESSION['user'] = $resultado['username'];
        $_SESSION['password'] = $resultado['password'];
        $_SESSION['company_id'] = $resultado['company_id'];
        $_SESSION['level_id'] = $resultado['level_id'];
        header("Location: ../front/listarchamados.php");
    } else {
        $_SESSION['loginError'] = "Usuário ou senha inválidos.";
        header("Location: ../front/login.php");
    }


} else {
    $_SESSION['loginError'] = "Usuário ou senha inválidos.";
    header("Location: ../front/login.php");
}





?>