<?php
session_start();
include_once("../back/conexao.php");
include_once("../back/security.php");
if($_SESSION['level_id'] == 2){
    $_SESSION['loginError'] = "Área restrita.";
    header("Location: ../back/logout.php");
}
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

    <title>Painel - CTC Parceiros</title>

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
          include_once("../back/logout.php");
      }

      ?>
    <br><br><br>
    <div class="container">
        <div class="row text-right">
            <a href="criarusuario.php" class="btn btn-info btn-md"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></a>
        </div>
        <h1 class="text-center">Pesquisar usuário</h1>
        <hr>
        <?php
            if(isset($_SESSION['changeUserSuccess'])){
                echo '<p class="text-center text-success">' . $_SESSION['changeUserSuccess'] . "</p>";
                unset($_SESSION['changeUserSuccess']);
            }
        ?>
        <div class="row">
            <div class="col-lg-12">
                <form method="get" action="listarusuarios.php">
                    <div class="form-group col-lg-3">
                        <input class="form-control" id="pesqusuario" name="pesqusuario" placeholder="Usuário">
                    </div>
                    <div class="form-group col-lg-3">
                        <select class="form-control" name="pesqstatus" placeholder="Status">
                            <option value=""></option>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                    </div>
                    <div class="from-group col-lg-offset-3 col-lg-3">
                        <label for="botaopesquisar"></label>
                        <button type="submit" class="btn btn-info btn-md" id="botaopesquisar">Pesquisar</button>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="table-responsive">
            <table class="table col-sm-12 col-md-12 col-lg-12">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Status</th>
                    <th>Acesso</th>
                    <th>Data criação</th>
                    <th>Data modificação</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    include_once("../back/searchuser.php");
                ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
