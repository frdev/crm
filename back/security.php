<?php
ob_start();
if(($_SESSION['user'] == "") || ($_SESSION['userid'] == "")){
    unset($_SESSION['user'], $_SESSION['password'], $_SESSION['company_id'], $_SESSION['level_id'], $_SESSION['userid']);
    //Mensagem de erro
    $_SESSION['loginError'] = "Área restrita para usuários cadastrados.";
    //Direciona usuário para página de login
    header("Location: ../front/login.php");
}
?>