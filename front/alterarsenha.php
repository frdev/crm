<?php
session_start();
include_once("../back/conexao.php");
include_once("../back/security.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../img/favctc.ico">

    <title>Alterar senha - CTC Parceiros</title>

    <!-- Fontawesome -->
    <link href="../font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <?php
  if($_SESSION['level_id'] == 1){
      include_once("menu_admin.php");
  } else if ($_SESSION['level_id'] == 2){
      include_once("menucomum.php");
  }

  ?>
    <br><br><br>
    
    <div class="container">
        <div class="">
            <h1 class="text-center">Alterando senha</h1>
            <hr>
            <p class="text-center text-warning col-lg-12">
                <?php
                if(isset($_SESSION['changePasswordSuccess'])){
                    echo $_SESSION['changePasswordSuccess'];
                    unset($_SESSION['changePasswordSuccess']);
                }
                ?>
            </p>
            <form class="col-lg-offset-4 col-lg-4" method="post" action="../back/alterar/changepassword.php">
                <div class="form-group">
                    <label for="senhaatual">Senha Atual</label>
                    <input type="password" class="form-control" id="senhaatual" name="password">
                </div>
                <div class="form-group">
                    <label for="novasenha">Nova Senha</label>
                    <input type="password" class="form-control" id="novasenha" name="newpassword">
                </div>
                <button type="submit" class="btn btn-success btn-md">Alterar</button>
                <a href="painel.php" class="btn btn-default btn-md">Cancelar</a>
            </form>
        </div>
    </div>
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
