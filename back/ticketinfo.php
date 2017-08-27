<?php
session_start();
include_once("security.php");
include_once("conexao.php");
$id = $_GET['ver'];

$emp = $_SESSION['company_id'];

$query = mysqli_query($conn, "SELECT * FROM tickets WHERE id = $id");
$result = mysqli_num_rows($query);

$resultados = mysqli_query($conn, "SELECT * FROM companies");
$linhas = mysqli_num_rows($resultados);

while($result = mysqli_fetch_array($query)){
    echo "<form class='col-lg-offset-3 col-lg-6 col-lg-offset-3'>";
    echo "<div class='row'>";
    echo "<div class='form-group col-lg-4'>";
    echo "<label for='chamado'>Chamado</label>";
    echo "<input class='form-control' type='text' id='chamado' value='" . $result['id'] . "'>";
    $resultid = $result['id'];
    echo "</div>";
    echo "<div class='form-group col-lg-4'>";
    echo "<label for='status'>Status</label>";
    echo "<input class='form-control' type='text' disabled id='status' value='" . $result['status'] . "'>";
    echo "</div>";
    echo "<div class='form-group col-lg-4'>";
    echo "<label for='dataat'>Data</label>";
    $dt = $result['serviceday'];
    $data = explode("-", $dt);
    $data = array_reverse($data);
    $data = implode("/", $data);    
    echo "<input class='form-control' type='text' id='dataat' value='" . $data . "'>";
    echo "</div>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<div class='form-group col-lg-3'>";
    echo "<label for='periodo'>Período</label>";
    echo "<input class='form-control' type='text' id='periodo' disabled value='" . $result['period'] . "'>";
    echo "</div>";
    echo "<div class='form-group col-lg-9'>";
    echo "<label for='nomecliente'>Cliente</label>";
    echo "<input class='form-control' type='text' id='nomecliente' disabled value='" . $result['clientname'] . "'>";
    echo "</div>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<div class='form-group col-lg-12'>";
    echo "<label for='telcliente'>Telefones</label>";
    echo "<input class='form-control' type='text' id='telcliente' disabled value='" . $result['phones'] . "'>";
    echo "</div>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<div class='form-group col-lg-6'>";
    echo "<label for='projeto'>Projeto</label>";
    echo "<input type='text' class='form-control' disabled id='projeto' value='" . $result['project'] . "'>";
    echo "</div>";
    echo "<div class='form-group col-lg-6'>";
    echo "<label for='empresa'>Empresa</label>";
    while($linhas = mysqli_fetch_array($resultados)){
        if($result['company'] == $linhas['id']){
            echo "<input type='text' class='form-control' disabled id='empresa' value='" . $linhas['name'] . "'>";
        }
    }
    echo "</div>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<div class='form-group col-lg-4'>";
    echo "<label for='cep'>CEP</label>";
    echo "<input type='text' class='form-control' disabled id='cep' value='" . $result['zipcode'] . "'>";
    echo "</div>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<div class='form-group col-lg-8'>";
    echo "<label for='logradouro'>Logradouro</label>";
    echo "<input type='text' class='form-control' disabled id='logradouro' value='" . $result['street'] . "'>";
    echo "</div>";
    echo "<div class='form-group col-lg-4'>";
    echo "<label for='numlocal'>Número</label>";
    echo "<input type='text' class='form-control' disabled id='numlocal'  value='" . $result['numb'] . "'>";
    echo "</div>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<div class='form-group col-lg-4'>";
    echo "<label for='comp'>Complemento</label>";
    echo "<input type='text' class='form-control' disabled id='comp' value='" . $result['complement'] . "'>";
    echo "</div>";
    echo "<div class='form-group col-lg-4'>";
    echo "<label for='city'>Cidade</label>";
    echo "<input type='text' class='form-control' disabled id='city' value='" . $result['city'] . "'>";
    echo "</div>";
    echo "<div class='form-group col-lg-4'>";
    echo "<label for='uf'>Estado</label>";
    echo "<input type='text' class='form-control' disabled id='uf' value='" . $result['state'] . "'>";
    echo "</div>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<div class='form-group col-lg-12'>";
    echo "<label for='opd'>Informações de Abertura</label>";
    echo "<textarea rows='10' class='form-control' disabled id='opd'>". $result['opendescription'] . "</textarea>";
    echo "</div>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<div class='form-group col-lg-6'>";
    echo "<label for='horainicio'>Hora Início AT</label>";
    echo "<input class='form-control' id='horainicio' name='horainicio' value='" . $result['hourstart'] . "'>";
    echo "</div>";
    echo "<div class='form-group col-lg-6'>";
    echo "<label for='horafim'>Hora Final AT</label>";
    echo "<input class='form-control' id='horafim' name='horafim' value='" . $result['hourfinish'] . "'>";
    echo "</div>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<div class='form-group col-lg-12'>";
    echo "<label for='cld'>Informações de Fechamento</label>";
    if($emp == 1){
        echo "<textarea rows='5' class='form-control' id='cld'>". $result['closedescription'] . "</textarea>";
    } else {
        echo "<textarea rows='5' class='form-control' disabled id='cld'>". $result['closedescription'] . "</textarea>";
    }
    echo "</div>";
    echo "</div>";
    if($result['status'] == 'Fechado' || $result['status'] == 'Encerrado'){
        echo "<a class='btn btn-info btn-sm' href='../back/baixar.php?file=" . $result['attachment'] . "'>Baixar RAT</a> ";
    }
    if($result['status'] == 'Fechado' && $emp == 1){
        echo "<a class='btn btn-danger btn-sm' href='../back/encerrarchamado.php?id=" . $resultid . "'>Encerrar</a> ";
    }
    echo "<a href='listarchamados.php' class='btn btn-default btn-sm'>Voltar</a>";

    echo "</form>";
}