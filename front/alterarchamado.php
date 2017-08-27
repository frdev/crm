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
      <script type="text/javascript" >

          function limpa_formulário_cep() {
              //Limpa valores do formulário de cep.
              document.getElementById('logradouro').value=("");
              document.getElementById('localidade').value=("");
              document.getElementById('uf').value=("");
          }

          function meu_callback(conteudo) {
              if (!("erro" in conteudo)) {
                  //Atualiza os campos com os valores.
                  document.getElementById('logradouro').value=(conteudo.logradouro);
                  document.getElementById('localidade').value=(conteudo.localidade);
                  document.getElementById('uf').value=(conteudo.uf);
              } //end if.
              else {
                  //CEP não Encontrado.
                  limpa_formulário_cep();
                  alert("CEP não encontrado.");
              }
          }

          function pesquisacep(valor) {

              //Nova variável "cep" somente com dígitos.
              var cep = valor.replace(/\D/g, '');

              //Verifica se campo cep possui valor informado.
              if (cep != "") {

                  //Expressão regular para validar o CEP.
                  var validacep = /^[0-9]{8}$/;

                  //Valida o formato do CEP.
                  if(validacep.test(cep)) {

                      //Preenche os campos com "..." enquanto consulta webservice.
                      document.getElementById('logradouro').value="...";
                      document.getElementById('localidade').value="...";
                      document.getElementById('uf').value="...";

                      //Cria um elemento javascript.
                      var script = document.createElement('script');

                      //Sincroniza com o callback.
                      script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                      //Insere script no documento e carrega o conteúdo.
                      document.body.appendChild(script);

                  } //end if.
                  else {
                      //cep é inválido.
                      limpa_formulário_cep();
                      alert("Formato de CEP inválido.");
                  }
              } //end if.
              else {
                  //cep sem valor, limpa formulário.
                  limpa_formulário_cep();
              }
          };

      </script>
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
              <h1 class="text-center">Alterar Chamado</h1>
              <hr>
              <?php
              $numid = $_GET['alterar'];
              $query = mysqli_query($conn, "SELECT * FROM tickets WHERE id = $numid");
              $resultado = mysqli_num_rows($query);
              while($resultado = mysqli_fetch_array($query)){
                  $data = $resultado['serviceday'];
                  $periodo = $resultado['period'];
                  $valor = $resultado['valor'];
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
                  $close = $resultado['closedescription'];
                  $horainicio = $resultado['hourstart'];
                  $horafim = $resultado['hourfinish'];
              }
              ?>


              <form class="col-lg-offset-3 col-lg-6 col-lg-offset-3" method="post" action="../back/changeticket.php">
                  <div class="row">
                      <div class="form-group col-lg-4">
                          <label for="numchamado">Número</label>
                          <input type="number" class="form-control" id="numchamado" name="numchamado" required value="<?php echo $numid ?>">
                      </div>
                      <div class="form-group col-lg-4">
                          <label for="status">Status</label>
                          <select class="form-control" id="status" name="status" required>
                          <?php
                          if($status == 'Agendado'){
                              echo '<option value="' . $status . '" selected>' . $status . '</option>';
                              echo '<option value="Roteirizar">Roteirizar</option>';
                              echo '<option value="Fechado">Fechado</option>';
                              echo '<option value="Cancelado">Cancelado</option>';
                              echo '<option value="Encerrado">Encerrado</option>';
                          } else if ($status == 'Fechado'){
                              echo '<option value="' . $status . '" selected>' . $status . '</option>';
                              echo '<option value="Roteirizar">Roteirizar</option>';
                              echo '<option value="Agendado">Agendado</option>';
                              echo '<option value="Cancelado">Cancelado</option>';
                              echo '<option value="Encerrado">Encerrado</option>';
                          } else if ($status == 'Cancelado'){
                              echo '<option value="' . $status . '" selected>' . $status . '</option>';
                              echo '<option value="Roteirizar">Roteirizar</option>';
                              echo '<option value="Agendado">Agendado</option>';
                              echo '<option value="Fechado">Fechado</option>';
                              echo '<option value="Encerrado">Encerrado</option>';
                          } else if ($status == 'Encerrado'){
                              echo '<option value="' . $status . '" selected>' . $status . '</option>';
                              echo '<option value="Roteirizar">Roteirizar</option>';
                              echo '<option value="Agendado">Agendado</option>';
                              echo '<option value="Fechado">Fechado</option>';
                              echo '<option value="Cancelado">Cancelado</option>';
                          } else if ($status == 'Roteirizar'){
                              echo '<option value="' . $status . '" selected>' . $status . '</option>';
                              echo '<option value="Agendado">Agendado</option>';
                              echo '<option value="Fechado">Fechado</option>';
                              echo '<option value="Cancelado">Cancelado</option>';
                              echo '<option value="Encerrado">Encerrado</option>';
                          }
                          ?>
                          </select>
                      </div>
                      <div class="form-group col-lg-4">
                          <label for="dataat">Data At</label>
                          <?php
                          echo '<input type="date" class="form-control" id="dataat" required name="dataat" value="' . $data . '">';
                          ?>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-lg-3">
                          <label for="periodo">Período</label>
                          <select class="form-control" id="periodo" name="periodo" required>
                              <?php
                              if($periodo == 'Manha'){
                                  echo '<option value="' . $periodo . '" selected>Manhã</option>';
                                  echo '<option value="Tarde">Tarde</option>';
                              } else if ($periodo == 'Tarde') {
                                  echo '<option value="' . $periodo . '" selected>Tarde</option>';
                                  echo '<option value="Manha">Manhã</option>';
                              } else {
                                  echo '<option value="Manha">Manhã</option>';
                                  echo '<option value="Tarde">Tarde</option>';
                              }
                              ?>
                          </select>
                      </div>
                      <div class="form-group col-lg-3">
                          <label for="valor">R$</label>
                          <?php
                          echo '<input type="text" class="form-control" id="valor" required name="valor" value="' . $valor . '">';
                          ?>
                      </div>
                      <div class="form-group col-lg-6">
                          <label for="telcliente">Telefones</label>
                          <?php
                          echo '<input type="text" class="form-control" id="telcliente" required name="telcliente" value="' . $tel . '">';
                          ?>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-lg-12">
                          <label for="nomecliente">Cliente</label>
                          <?php
                          echo '<input type="text" class="form-control" id="nomecliente" required name="nomecliente" value="' . $cliente . '">';
                          ?>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-lg-6">
                          <label for="projeto">Projeto</label>
                          <select class="form-control" id="projeto" name="projeto">
                          <?php
                          $resultados = mysqli_query($conn, "SELECT * FROM projects");
                          $projects = mysqli_num_rows($resultados);
                          while($projects = mysqli_fetch_array($resultados)){
                              if($projects['description'] == $projeto){
                                  echo '<option value="' . $projects["description"] . '" selected>' . $projects["description"] . '</option>';
                              } else {
                                  echo '<option value="' . $projects["description"] . '">' . $projects["description"] . '</option>';
                              }
                          }
                          ?>
                          </select>
                      </div>
                      <div class="form-group col-lg-6">
                          <label for="empresa">Empresa</label>
                          <select class="form-control" id="empresa" name="empresa">
                          <?php
                            $resultados = mysqli_query($conn, "SELECT * FROM companies");
                            $linhas = mysqli_num_rows($resultados);
                            while($linhas = mysqli_fetch_array($resultados)){
                                if($linhas['id'] == $empresa){
                                    echo '<option value="' . $linhas["id"] . '" selected>' . $linhas["name"] . '</option>';
                                } else {
                                    echo '<option value="' . $linhas["id"] . '">' . $linhas["name"] . '</option>';
                                }
                            }
                          ?>
                          </select>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-lg-4">
                          <label for="cep">CEP</label>
                          <?php
                          echo '<input type="text" class="form-control" onblur="pesquisacep(this.value)" id="cep" name="cep" value="' . $cep . '">';
                          ?>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-lg-8">
                          <label for="logradouro">Logradouro</label>
                          <?php
                          echo '<input type="text" class="form-control" id="logradouro" name="logradouro" value="' . $logradouro . '">';
                          ?>
                      </div>
                      <div class="form-group col-lg-4">
                          <label for="numlocal">Número local</label>
                          <?php
                          echo '<input type="text" class="form-control" id="numlocal" name="numlocal" value="' . $numlocal . '">';
                          ?>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-lg-4">
                          <label for="complemento">Complemento</label>
                          <?php
                          echo '<input type="text" class="form-control" id="complemento" name="complemento" value="' . $comp . '">';
                          ?>
                      </div>
                      <div class="form-group col-lg-4">
                          <label for="localidade">Cidade</label>
                          <?php
                          echo '<input type="text" class="form-control" id="localidade" name="city" value="' . $city . '">';
                          ?>
                      </div>
                      <div class="form-group col-lg-4">
                          <label for="uf">Estado</label>
                          <?php
                          echo '<input type="text" class="form-control" id="uf" name="uf" value="' . $uf . '">';
                          ?>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="mensagem">Informações de Abertura</label>
                      <?php
                      echo '<textarea rows="5" type="text" class="form-control" name="mensagem" id="mensagem">' . $open . '</textarea>';
                      ?>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="horainicio">Hora Início AT</label>
                        <?php
                        echo "<input class='form-control' type='text' id='horainicio' value='" . $horainicio . "'name='horainicio'>";
                        ?>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="horafim">Hora Final AT</label>
                        <?php
                        echo "<input class='form-control' type='text' id='horafinal' value='" . $horafim . "'name='horafinal'>";
                        ?>
                    </div>
                </div>
                  <div class="form-group">
                      <label for="fechamento">Fechamento</label>
                      <?php
                      echo '<textarea rows="5" type="text" class="form-control" id="fechamento" name="fechamento">' . $close . '</textarea>';
                      ?>
                  </div>
                  <button type="submit" class="btn btn-warning btn-md">Alterar</button>
                  <a href="listarchamados.php" class="btn btn-default btn-md">Cancelar</a>
              </form>
          </div>
      </div>
    
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
