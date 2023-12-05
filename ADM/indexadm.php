<?php
session_start();
if (isset($_SESSION['login'])) {
  include "../conn.php";
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
  <link rel="stylesheet" type="text/css" href="../css/header.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página de Gerenciamento</title>
</head>
<style>
  body {
    font-family: Arial, sans-serif;
    text-align: center;
  }

  button {
    padding: 10px 20px;
    font-size: 16px;
    margin: 10px;
    border: none;
  }
</style>

<body>
  <header>
    <div class="logoH">
      <img src="../imagens/logo.png" class="logoN">
    </div>
    <ul class="nav">
    </ul>
    <?php if (!isset($_SESSION['login'])) : ?>
      <div class="loginH">
        <a href="../login.php" class="login">LOGIN</a>
      </div>
    <?php else : ?>
      <div class="teste">
        <p class='mensagemlogin'>Olá, <?php echo $row_nome['User_Login']; ?> seja bem-vindo de volta!
          <a class='logout' href='../index.php?logout'>LOGOUT</a>
        </p>
      </div>
    <?php endif; ?>
  </header>

  <h1>Bem-vindo à Página de Gerenciamento</h1>

  <button class="login" id="gerenciarCardapio">Gerenciar Cardápio</button>
  <button class="login" id="gerenciarUsuarios">Gerenciar Usuários</button>

  <script>
    document.getElementById('gerenciarCardapio').addEventListener('click', function() {
      window.location.href = 'cardapio.php';
    });

    document.getElementById('gerenciarUsuarios').addEventListener('click', function() {
      window.location.href = 'Gerenciamento-Clientes.php';
    });
  </script>
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