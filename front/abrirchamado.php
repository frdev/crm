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
            <h1 class="text-center">Abertura de Chamado</h1>
            <hr>
            <form class="col-lg-offset-3 col-lg-6 col-lg-offset-3" method="POST" action="../back/incluir/createticket.php">
                <div class="row">
                    <div class="form-group col-lg-4" required>
                        <label for="numchamado">Número</label>
                        <input type="number" class="form-control" id="numchamado" name="numchamado" required autofocus>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" required>
                            <option value=""></option>
                            <option value="Roteirizar">Roteirizar</option>
                            <option value="Agendado">Agendado</option>
                            <option value="Fechado">Fechado</option>
                            <option value="Cancelado">Cancelado</option>
                            <option value="Cancelado">Encerrado</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="dataat">Data At</label>
                        <input type="date" class="form-control" id="dataat" name="dataat" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label for="periodo">Período</label>
                        <select class="form-control" name="periodo" required>
                            <option value="Manha" selected>Manhã</option>
                            <option value="Tarde">Tarde</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="valor">R$</label>
                        <input class="form-control" name="valor" id="valor" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="telcliente">Telefones</label>
                        <input type="text" class="form-control" id="telcliente" name="telcliente" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="nomecliente">Cliente</label>
                        <input type="text" class="form-control" id="nomecliente" name="nomecliente" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="projeto">Projeto</label>
                        <select class="form-control" id="projeto" name="project" required>
                            <option value=""></option>
                            <?php
                            $resultados = mysqli_query($conn, "SELECT * FROM projects");
                            $projects = mysqli_num_rows($resultados);
                            while($projects = mysqli_fetch_array($resultados)){
                                echo '<option value="' . $projects["description"] . '">' . $projects["description"] . '</option>';
                            }

                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="empresa">Empresa</label>
                        <select class="form-control" id="empresa" name="company" required>
                            <option value=""></option>
                            <?php
                            $resultados = mysqli_query($conn, "SELECT * FROM companies ORDER BY name");
                            $linhas = mysqli_num_rows($resultados);
                            while($linhas = mysqli_fetch_array($resultados)){
                                echo '<option value="' . $linhas["id"] . '">' . $linhas["name"] . '</option>';
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="cep">CEP</label>
                        <input type="text" onblur="pesquisacep(this.value)" class="form-control" id="cep" name="zipcode" required>
                    </div>
                </div>
                <div class="row">
                <div class="form-group col-lg-8">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" class="form-control" id="logradouro" name="street">
                </div>
                <div class="form-group col-lg-4">
                    <label for="numlocal">Número local</label>
                    <input type="text" class="form-control" id="numlocal" name="numlocal" required>
                </div>
                </div>
                <div class="row">
                <div class="form-group col-lg-4">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complement">
                </div>
                <div class="form-group col-lg-4">
                    <label for="localidade">Cidade</label>
                    <input type="text" class="form-control" id="localidade" name="city">
                </div>
                <div class="form-group col-lg-4">
                    <label for="uf">Estado</label>
                    <input type="text" class="form-control" id="uf" name="uf">
                </div>
                </div>

                <div class="form-group">
                    <label for="mensagem">Descrição</label>
                    <textarea class="form-control" rows="5" id="mensagem" name="descab" required></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-md">Criar</button>
                <button type="button" class="btn btn-default btn-md">Cancelar</button>
            </form>
        </div>  
    </div>
    
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
