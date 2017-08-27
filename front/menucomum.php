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
                <li class="dropdown"><a href="listarchamados.php">Chamados</a></li>
                <li><a href="rats.php">RAT's</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-user-o" aria-hidden="true"></i> <?php echo $_SESSION['user']; ?></a></li>
                <li><a href="alterarsenha.php"><i class="fa fa-address-book-o" aria-hidden="true"></i> Alterar senha</a></li>
                <li><a href="../back/logout.php"><i class="fa fa-times" aria-hidden="true"></i> Sair</a></li>
            </ul>
        </div>
    </div>
</nav>
