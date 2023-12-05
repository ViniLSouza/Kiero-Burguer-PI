<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIERO BURGUER</title>
    <link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
</head>
<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("passwordField");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>
<style>
    body {
        background-image: url('imagens/restaurante.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>

<body>
    <section class="container">
        <div class="box">
            <a href="index.php" class="ancora">‹ Voltar à página inicial</a>
            <h1 class="name">LOGIN</h1>
            <form action="login.php" method="post" class="login">
                <input type="text" name="username" placeholder="Usuário" required class="barra">
                <input type="password" id="passwordField" name="password" placeholder="Senha" required class="barra senha">
                <button type="button" onclick="togglePasswordVisibility()" class="show">Mostrar Senha</button>
                <input type="submit" value="Entrar" name="Entrar" class="botao">
            </form>
            <p>Não tem uma conta?<a href="cadastro.php" class="ancora"> Cadastre-se</a></p>
            <p class="noMarg">Kiero Burguer®</p>
        </div>
    </section>
</body>

</html>

<?php

if (isset($_POST['Entrar'])) {
    $user = $_POST['username'];
    $senha = $_POST['password'];

    include "conn.php";

    $ver_login = $conn->prepare('SELECT * FROM `tbl_login` WHERE `User_Login`=:puser AND `Senha_Login`=:psenha');

    $ver_login->bindValue(':puser', $user);
    $ver_login->bindValue(':psenha', $senha);

    $ver_login->execute();
    if ($ver_login->rowCount() == 0) {
        echo '<div class="erro">Login ou senha incorreto!</div>';
    } else {
        session_start();
        $row = $ver_login->fetch();
        $id_login = $row['ID_Login'];
        $_SESSION['login'] = $id_login;

        $tipo_usuario = $row['Tipo_Usuario'];

        if ($tipo_usuario == 1) {
            header('location: ADM/indexadm.php');
        } else {
            header('location: index.php');
        }
    }
}
