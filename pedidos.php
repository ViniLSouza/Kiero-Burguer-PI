<?php
session_start();
if (isset($_SESSION['login'])) {
    include "conn.php";
    $cons_nome = $conn->prepare('SELECT * FROM tbl_login WHERE ID_Login=:pid');
    $cons_nome->bindValue(':pid', $_SESSION['login']);
    $cons_nome->execute();
    $row_nome = $cons_nome->fetch();


    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: login.php');
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Peça Aqui</title>
    <link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
</head>

<body>
<header>
        <div class="logoH">
        <a href="index.php"><img src="imagens/logo.png" class="logoN"></a>
        </div>
        <ul class="nav">
            <li class="itemN"><a href="index.php" class="name">Home</a></li>
            <li class="itemN"><a href="pedidos.php" class="name">Pedidos</a></li>
            <li class="itemN"><a href="carrinho.php" class="name">Peça aqui</a></li>
        </ul>
        <?php if (!isset($_SESSION['login'])) : ?>
            <div class="loginH">
                <a href="login.php" class="login">LOGIN</a>
            </div>
        <?php else : ?>
            <div class="teste">
                <p class='mensagemlogin'>Olá, <?php echo $row_nome['User_Login']; ?> seja bem-vindo de volta!
                    <a class='logout' href='index.php?logout'>LOGOUT</a>
                </p>
            </div>
        <?php endif; ?>
    </header>
</html>