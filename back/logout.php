<?php
    session_start();
    session_destroy();
    unset($_SESSION['user'], $_SESSION['password'], $_SESSION['company_id'], $_SESSION['level_id'], $_SESSION['userid']);
    header("Location: ../front/login.php");
?>