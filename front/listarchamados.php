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

$empid = $_SESSION['company_id'];

if($_SESSION['company_id'] == 1){
    $queryfechados = mysqli_query($conn, "SELECT * FROM tickets WHERE status = 'Fechado'");
    $totalfechados = mysqli_num_rows($queryfechados);

    $queryroteirizar = mysqli_query($conn, "SELECT * FROM tickets WHERE status = 'Roteirizar'");
    $totalroteirizar = mysqli_num_rows($queryroteirizar);

    $querycancelados = mysqli_query($conn, "SELECT * FROM tickets WHERE status = 'Cancelado'");
    $totalcancelados = mysqli_num_rows($querycancelados);

    $queryagendados = mysqli_query($conn, "SELECT * FROM tickets WHERE status = 'Agendado'");
    $totalagendados = mysqli_num_rows($queryagendados);

    $queryencerrados = mysqli_query($conn, "SELECT * FROM tickets WHERE status = 'Encerrado'");
    $totalencerrados = mysqli_num_rows($queryencerrados);
} else {
    $queryfechados = mysqli_query($conn, "SELECT * FROM tickets WHERE status = 'Fechado' AND company = $empid");
    $totalfechados = mysqli_num_rows($queryfechados);

    $queryroteirizar = mysqli_query($conn, "SELECT * FROM tickets WHERE status = 'Roteirizar' AND company = $empid");
    $totalroteirizar = mysqli_num_rows($queryroteirizar);

    $querycancelados = mysqli_query($conn, "SELECT * FROM tickets WHERE status = 'Cancelado' AND company = $empid");
    $totalcancelados = mysqli_num_rows($querycancelados);

    $queryagendados = mysqli_query($conn, "SELECT * FROM tickets WHERE status = 'Agendado' AND company = $empid");
    $totalagendados = mysqli_num_rows($queryagendados);

    $queryencerrados = mysqli_query($conn, "SELECT * FROM tickets WHERE status = 'Encerrado' AND company = $empid");
    $totalencerrados = mysqli_num_rows($queryencerrados);
}

?>
<br><br><br>
<div class="container">
    <?php
        if($_SESSION['level_id'] == 1){
            $botaoadd = "<div class='row'>";
            $botaoadd .= "<form action='../back/gerarrelatorio.php' method='get'>";
            $botaoadd .= "<a href='abrirchamado.php' style='margin-top: 20px; margin-left: 15px;' class='btn btn-info btn-md pull-right'><i class='fa fa-plus fa-lg\' aria-hidden='true'></i></a>";
            $botaoadd .= "<input type='submit' style='margin-top: 20px;' class='btn btn-default btn-md pull-right' value='Relatório'>   ";
            $botaoadd .= "<div class='form-group col-lg-2 pull-right'>";
            $botaoadd .= "<span>Fim</span><input class='form-control' type='date' name='dtfim'/>";
            $botaoadd .= "</div>";
            $botaoadd .= "<div class='form-group col-lg-2 pull-right'>";
            $botaoadd .= "<span>Início</span><input class='form-control' type='date' name='dtini'/>";
            $botaoadd .= "</div>";
            $botaoadd .= "</form>";
            $botaoadd .= "</div>";
        } else {
            $botaoadd = "";
        }
        echo $botaoadd;
    ?>
    <h1 class="text-center">Pesquisar chamado</h1>
    <hr>
    <?php
    if(isset($_SESSION['altchamado'])){
        echo '<p class="text-center">' . $_SESSION['altchamado'] . '</p>';
        unset($_SESSION['altchamado']);
    }
    if(isset($_SESSION['envioemail'])){
        echo '<p class="text-center">' . $_SESSION['envioemail'] . '</p>';
        unset($_SESSION['envioemail']);
    }
    ?>
    <div class="row">
        <form method="get" action="listarchamados.php">
           <div class="row">
            <div class="form-group col-lg-2">
                <label for="pesqchamado">Chamado</label>
                <input class="form-control" id="pesqchamado" name="pesqchamado" placeholder="Número do chamado">
            </div>
            <div class="form-group col-lg-2">
                <label for="pesqprojeto">Projeto</label>
                <select class="form-control" id="pesqprojeto" name="pesqprojeto">
                    <option value=""></option>
                    <?php
                    $proj = mysqli_query($conn, "SELECT * FROM projects ORDER BY description");
                    $r = mysqli_num_rows($proj);
                    while($r = mysqli_fetch_array($proj)){
                        echo "<option value='" . $r['description'] . "'>" . $r['description'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            
            <?php
               if($_SESSION['company_id'] == 1){
            ?>
            <div class="form-group col-lg-2">
                <label for="pesqempresa">Empresa</label>
                <select class="form-control" id="pesqempresa" name="pesqempresa">
                    <option value=""></option>
                    <?php
                    $emp = mysqli_query($conn, "SELECT * FROM companies ORDER BY name");
                    $result = mysqli_num_rows($emp);
                    while($result = mysqli_fetch_array($emp)){
                        echo "<option value='" . $result['id'] . "'>" . $result['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <?php
               }
            ?>
            <div class="form-group col-lg-2">
                <label for="data">Data</label>
                <input type="date" class="form-control" name="data" id="data">
            </div>
            <div class="form-group col-lg-2">
                <label for="datafinal">Data Final</label>
                <input type="date" class="form-control" name="datafinal" id="datafinal">
            </div>
            <div class="form-group col-lg-2" style="margin-top: 23px;">
                <label for="botaopesquisar"></label>
                <button type="submit" class="btn btn-info btn-md" id="botaopesquisar">Pesquisar</button>
            </div>
            </div>
        </form>
        <hr>
        <div class="row">
            <a style='margin-right: 45px;' href="listarchamados.php?pesqchamado=&pesqstatus=Roteirizar&pesqprojeto=&pesqempresa=&data=&datafinal=" class="btn btn-sm btn-warning col-lg-2">À Roteirizar (<?=$totalroteirizar; ?>)</a>
            <a style='margin-right: 45px;' href="listarchamados.php?pesqchamado=&pesqstatus=Agendado&pesqprojeto=&pesqempresa=&data=&datafinal=" class="btn btn-sm btn-info col-lg-2">Agendados (<?=$totalagendados; ?>)</a>
            <a style='margin-right: 45px;' href="listarchamados.php?pesqchamado=&pesqstatus=Fechado&pesqprojeto=&pesqempresa=&data=&datafinal=" class="btn btn-sm btn-success col-lg-2">Fechados (<?=$totalfechados; ?>)</a>
            <a href="listarchamados.php?pesqchamado=&pesqstatus=Cancelado&pesqprojeto=&pesqempresa=&data=&datafinal=" class="btn btn-sm btn-danger col-lg-2">Cancelados (<?=$totalcancelados; ?>)</a>
            <a style='margin-left: 45px;' href="listarchamados.php?pesqchamado=&pesqstatus=Encerrado&pesqprojeto=&pesqempresa=&data=&datafinal=" class="btn btn-sm btn-default col-lg-2">Encerrados (<?=$totalencerrados; ?>)</a>
        </div>
    </div>
    <hr>
    <?php
    $empresa = $_SESSION['company_id'];
    ?>
    <div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Chamado</th>
            <th>Data atendimento</th>
            <th>Período</th>
            <th>Projeto</th>
            <th>Status</th>
            <th>Empresa</th>
            <th>Cidade</th>
            <?php
                if($empresa == 1){
            ?>
            <th>R$</th>
            <?php } ?>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        include_once("../back/pesquisachamado.php");
        ?>
        </tbody>
    </table>
    </div>
</div>


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
