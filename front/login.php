<?php
session_start();

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

    <title>Login - CTC Parceiros</title>

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
      unset($_SESSION['user'], $_SESSION['password'], $_SESSION['company_id'], $_SESSION['level_id'], $_SESSION['userid']);
      ?>

    <div class="container">
          <div class="">
              <form class="form-signin col-lg-offset-4 col-lg-4 col-lg-offset-4" method="POST" action="../back/authenticate.php">
                <img src="../img/ctclogin.png" style="margin-left: -50px"/>
                <br>
                  <p class="col-lg-12 text-center text-danger">
                      <?php
                      if(isset($_SESSION['loginError'])){
                          echo $_SESSION['loginError'];
                          unset($_SESSION['loginError']);
                      }
                      ?>
                  </p>
                <label for="username" class="sr-only">Usuário</label>
                <input type="text" id="username" name="inputUsername" class="form-control" placeholder="Usuário" required autofocus>
                <label for="password" class="sr-only">Senha</label>
                <input type="password" id="password" name="inputPassword" class="form-control" placeholder="Senha" required>
                <br>
                <button
              class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-user-o" aria-hidden="true"></i> Conecte-se</button>
              </form>
          </div>
    </div> <!-- /container -->
    
    <div class="container">
          <br>
          <p class="text-center">Não é parceiro?
          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Contato</button>

          <!-- /Modal -->
          <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
           <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">Contato</h4>
                    </div>
                <div class="modal-body">
                    <form method="post" action="../back/sendmail.php">
                        <div class="form-group">
                            <label for="empresa">Empresa</label>
                            <input type="text" class="form-control" id="empresa" name="empresa" required focus>
                        </div>
                        <div class="form-group col-lg-7">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required focus>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" required focus>
                        </div>
                        <div class="form-group">
                            <label for="mensagem">Mensagem</label>
                            <textarea class="form-control" rows="5" id="mensagem" name="mensagem"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Enviar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </form>
                    
                </div>
                <div class="modal-footer">
                </div>
                </div>
              </div>
          </div>
      </div>
    
    

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
