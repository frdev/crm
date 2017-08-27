<?php
session_start();
include_once("../back/security.php");
include_once("../back/conexao.php");
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
          include_once("menucomum.php");
      }

      ?>
    <br><br><br>
    <div class="container">
        <div class="">
            <h1 class="text-center">Fechamento de Chamado</h1>
            <hr>
            <?php
            $numid = $_GET['fechar'];
            $query = mysqli_query($conn, "SELECT * FROM tickets WHERE id = $numid");
            $resultado = mysqli_num_rows($query);
            while($resultado = mysqli_fetch_array($query)){
                $data = $resultado['serviceday'];
                $periodo = $resultado['period'];
                $cliente = $resultado['clientname'];
                $tel = $resultado['phones'];
                $status = $resultado['status'];
                $projeto = $resultado['project'];
                $empresa = $resultado['company'];
                $cep = $resultado['zipcode'];
                $logradouro = $resultado['street'];
                $numlocal = $resultado['numb'];
                $comp = $resultado['complement'];
                $city = $resultado['city'];
                $uf = $resultado['state'];
                $open = $resultado['opendescription'];
            }
            ?>
            <form class="col-lg-offset-3 col-lg-6 col-lg-offset-3" method="post" action="../back/closeticket.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="numchamado">Número</label>
                        <input type="number" class="form-control" id="numchamado" name="numchamado" value="<?php echo $numid ?>">
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="status">Status</label>
                        <?php
                            echo '<input type="text" class="form-control" disabled id="status" name="status" value="' . $status . '">';
                        ?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="dataat">Data At</label>
                        <?php
                        echo '<input type="text" class="form-control" disabled id="dataat" value="' . $data . '">';
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label for="periodo">Período</label>
                        <?php
                        echo '<input type="text" class="form-control" id="periodo" disabled name="periodo" value="' . $periodo . '">';
                        ?>
                    </div>
                    <div class="form-group col-lg-9">
                        <label for="nomecliente">Cliente</label>
                        <?php
                        echo '<input type="text" class="form-control" id="nomecliente" disabled name="nomecliente" value="' . $cliente . '">';
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="telcliente">Telefones</label>
                        <?php
                        echo '<input type="text" class="form-control" id="telcliente" disabled name="telcliente" value="' . $tel . '">';
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="projeto">Projeto</label>
                        <?php
                        echo '<input type="text" class="form-control" disabled id="projeto" value="' . $projeto . '">';
                        ?>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="empresa">Empresa</label>
                        <?php
                        echo '<input type="text" class="form-control" disabled id="empresa" value="' . $empresa . '">';
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="cep">CEP</label>
                        <?php
                        echo '<input type="text" class="form-control" disabled id="cep" value="' . $cep . '">';
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-8">
                        <label for="logradouro">Logradouro</label>
                        <?php
                        echo '<input type="text" class="form-control" disabled id="logradouro" value="' . $logradouro . '">';
                        ?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="numlocal">Número local</label>
                        <?php
                        echo '<input type="text" class="form-control" disabled id="numlocal" value="' . $numlocal . '">';
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="complemento">Complemento</label>
                        <?php
                        echo '<input type="text" class="form-control" disabled id="numlocal" value="' . $numlocal . '">';
                        ?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="localidade">Cidade</label>
                        <?php
                        echo '<input type="text" class="form-control" disabled id="localidade" value="' . $city . '">';
                        ?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="uf">Estado</label>
                        <?php
                        echo '<input type="text" class="form-control" disabled id="uf" value="' . $uf . '">';
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mensagem">Informações de Abertura</label>
                    <?php
                    echo '<textarea rows="5" type="text" class="form-control" disabled id="mensagem">' . $open . '</textarea>';
                    ?>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="horainicio">Hora Início AT</label>
                        <input class="form-control" type="text" id="horainicio" name="horainicio" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="horafinal">Hora Final AT</label>
                        <input class="form-control" type="text" id="horafinal" name="horafinal" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fechamento">Fechamento</label>
                    <textarea rows="5" type="text" class="form-control" required id="fechamento" name="fechamento"></textarea>
                </div>
                <input type="file" class="form-control-file" required aria-describedby="fileHelp" name="arquivo"></input>
                <br><br>
                <button type="submit" class="btn btn-danger btn-md">Fechar</button>
                <a href="listarchamados.php" class="btn btn-default btn-md">Cancelar</a>
            </form>
        </div>  
    </div>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
