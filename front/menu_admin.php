<?php
session_start();

?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expannded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">CONNECTCOM</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="listarusuarios.php">Usuários</a></li>
                        <li><a href="listarprojetos.php">Projetos</a></li>
                        <li><a href="listarempresas.php">Empresas</a></li>
                    </ul>
                </li>
                <li><a href="listarchamados.php">Chamados</a></li>
                <li><a href="rats.php">RAT's</a></li>
            </ul>
            <?php
                $s = mysqli_query($conn, "SELECT * FROM tickets WHERE status = 'Fechado'");
                $fechados = mysqli_num_rows($s);
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-user-o" aria-hidden="true"></i> <?php echo $_SESSION['user']; ?></a></li>
                <li><a href="listarchamados.php?pesqchamado=&pesqstatus=Fechado&pesqprojeto=&pesqempresa=&data=&datafinal="><i class="fa fa-bell" aria-hidden="true"></i> <?php echo $fechados; ?></a></li>
                <li><a href="alterarsenha.php"><i class="fa fa-address-book-o" aria-hidden="true"></i> Alterar senha</a></li>
                <li><a href="../back/logout.php"><i class="fa fa-times" aria-hidden="true"></i> Sair</a></li>
            </ul>
        </div>
    </div>
</nav>
