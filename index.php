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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIERO BURGUER</title>
    <link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
</head>
<style>
    body {
        background-image: url('imagens/parede-de-concreto.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: repeat;
    }

    .sobre {
        background-image: url('imagens/background.jpg');
    }

    footer {
        background-image: url('imagens/parede-de-concreto2.jpg');
        background-size: cover;
        background-position: center;
        box-shadow: 0 0 6px rgba(0, 0, 0, 1);
    }

    @media screen and (max-width: 1050px) {
        .mostruario {
            display: block;
        }

        .foto {
            width: 50%;
        }

        .texto {
            font-size: 25px;
        }
    }
</style>

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
            <p class='mensagemlogin'>Olá, <?php echo $row_nome['User_Login']; ?> seja bem-vindo de volta!
                <a class='logout' href='index.php?logout'>LOGOUT</a>
            </p>
        <?php endif; ?>
    </header>
    <section class="banner">
        <img src="imagens/banner.jpg" class="fotoB">
    </section>
    <section class="frase">
        <p class="fraseB">Seja bem-vindo à Kiero Burguer, onde cada mordida conta uma história de sabor e qualidade!</p>
    </section>
    <section class="sobre">
        <div>
            <p class="texto">Experimente e descubra o que é uma verdadeira experiência gastronômica!</p>
        </div>
        <div class="mostruario">
            <div>
                <img src="imagens/lanche.jpg" class="foto">
                <p class="texto">O lanche MAIS suculento!</p>
            </div>
            <div>
                <img src="imagens/batata.jpg" class="foto">
                <p class="texto">A batata MAIS crocante!</p>
            </div>
            <div>
                <img src="imagens/bebida.jpg" class="foto">
                <p class="texto">A bebida MAIS gelada!</p>
            </div>
        </div>
        <div>
            <p><a href="#" class="texto order">PEÇA JÁ</a></p>
        </div>
    </section>
    <footer>
        <p class="textoF">Kiero Burguer®</p>
        <p class="textoF dev">Desenvolvido por:</p>
        <div class="devs">
            <p class="textoF devs">Gabriel Gevezier</p>
            <p class="textoF devs">Hemily Batista</p>
            <p class="textoF devs">Luana Peracini</p>
            <p class="textoF devs">Vinicius Luciano</p>
            <p class="textoF devs">Wesley Scolaro</p>
        </div>
    </footer>
</body>

</html>