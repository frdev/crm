<?php
session_start();
include_once("../back/security.php");
include_once("../back/conexao.php");

if($_SESSION['level_id'] == 2){
    $_SESSION['loginError'] = "Área restrita.";
    header("Location: ../back/logout.php");
} else if ($_SESSION['level_id'] == 1) {
    $userid = $_GET['botao'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$userid'");
    $users = mysqli_num_rows($query);
    while($users = mysqli_fetch_array($query)) {
        $usuario = $users['username'];
        $senha = $users['password'];
        $empresaid = $users['company_id'];
        $nivelid = $users['level_id'];
        $status = $users['status'];
    }
    /*$queryemp = mysqli_query($conn, "SELECT * FROM companies WHERE id = '$empresaid'");
    $companies = mysqli_num_rows($queryemp);
    while($companies = mysqli_fetch_array($queryemp)){
        $empresa = $companies['name'];
    }*/
    /*$querynv = mysqli_query($conn, "SELECT * FROM levels WHERE id = '$nivelid'");
    $levels = mysqli_num_rows($querynv);
    while($levels = mysqli_fetch_array($querynv)){
        $nivel = $levels['description'];
    }*/
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

    <title>Alterar Usuário - CTC Parceiros</title>

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
        <div class="">
            <h1 class="text-center">Alterando usuário</h1>
            <hr>
            <br>
            <?php
            $idusuario = $_GET['botao'];
            ?>
            <form class="col-lg-offset-3 col-lg-6 col-lg-offset-3" method="post" action="../back/changeuser.php">
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="username">Usuário</label>
                        <?php
                        echo "<input type='text' class='form-control' id='username' name='username' value='" . $usuario . "'>";
                        ?>
                    </div>
                    <input type="hidden" name="idusuario" value = "<?php echo $idusuario; ?>">
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <?php
                    echo "<input type='password' class='form-control' id='senha' name='password' value='" . $senha . "'>";
                    ?>
                </div>
                <div class="row">
                <div class="form-group col-lg-6">
                    <label for="empresa">Empresa</label>
                    <select class="form-control" id="empresa" name="company" required>
                        <?php
                        $resultados = mysqli_query($conn, "SELECT * FROM companies");
                        $linhas = mysqli_num_rows($resultados);
                        //echo '<option value="' . $empresaid . '">' . $empresa . '</option>';
                        while ($linhas = mysqli_fetch_array($resultados)) {
                            if($linhas['id'] == $empresaid){
                                echo '<option value="' . $empresaid . '" selected>' . $linhas["name"] . '</option>';
                            } else {
                                echo '<option value="' . $linhas["id"] . '">' . $linhas["name"] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-lg-6">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status" required>
                        <?php
                            if($status == 'Ativo'){
                                echo '<option value="' . $status . '" selected>' . $status . '</option>';
                                echo '<option value="Inativo" >Inativo</option>';
                            } else {
                                echo '<option value="' . $status . '">' . $status . '</option>';
                                echo '<option value="Ativo" >Ativo</option>';
                            }
                        ?>
                    </select>
                </div>
                </div>
                <div class="form-group">
                    <label for="nivel">Nível Acesso</label>
                    <select class="form-control" id="nivel" name="level" required>
                        <?php
                        $resultados = mysqli_query($conn, "SELECT * FROM levels");
                        $linhas = mysqli_num_rows($resultados);
                        while($linhas = mysqli_fetch_array($resultados)){
                            if($nivelid == $linhas["id"]){
                                echo '<option value="' . $linhas["id"] . '" selected>' . $linhas["description"] . '</option>';
                            } else {
                                echo '<option value="' . $linhas["id"] . '">' . $linhas["description"] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-warning btn-md">Alterar</button>
                <a href="painel.php" class="btn btn-default btn-md">Cancelar</a>
            </form>
        </div>
    </div>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
