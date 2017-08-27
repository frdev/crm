<?php
session_start();
include_once("conexao.php");

$idchamado = $_POST['numchamado'];
$horainicio = $_POST['horainicio'];
$horafim = $_POST['horafinal'];
$fechamento = $_POST['fechamento'];

echo $idchamado . $fechamento;

if($_FILES) { // Verificando se existe o envio de arquivos.
    if($_FILES['arquivo']) { // Verifica se o campo não está vazio.
        $dir = 'rats/'; // Diretório que vai receber o arquivo.
        $tmpName = $_FILES['arquivo']['tmp_name']; // Recebe o arquivo temporário.
        $name = $_FILES['arquivo']['name']; // Recebe o nome do arquivo.
        $extensao = pathinfo($name, PATHINFO_EXTENSION);
        $name = $idchamado . ".$extensao";
        $url = $name;
        $query = mysqli_query($conn, "UPDATE tickets SET closedescription = '$fechamento', hourstart = '$horainicio', hourfinish = '$horafim', attachment = '$url', status = 'Fechado' WHERE id = $idchamado");
        // move_uploaded_file( $arqTemporário, $nomeDoArquivo )
        if( move_uploaded_file( $tmpName, $dir . $name ) ) { // move_uploaded_file irá realizar o envio do arquivo.
            $_SESSION['altchamado'] = "Chamado " . $idchamado . " fechado com sucesso.";
            header('Location: ../front/listarchamados.php'); // Em caso de sucesso, retorna para a página de sucesso.
        } else {
            header('Location: ../front/painel.php'); // Em caso de erro, retorna para a página de erro.
        }

    }

}



?>