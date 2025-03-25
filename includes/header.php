<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

iniciarSessao();

$database = new Database();
$db = $database->getConnection();

if (isset($_SESSION['login'])) {
    $stmt = $db->prepare("SELECT User_Login FROM tbl_login WHERE ID_Login = :id");
    $stmt->bindValue(':id', $_SESSION['login']);
    $stmt->execute();
    $row_nome = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIERO BURGUER</title>
    <link rel="stylesheet" type="text/css" href="assets/css/components/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <header>
        <div class="logoH">
            <a href="index.php"><img src="assets/images/logo.png" class="logoN" alt="Kiero Burguer Logo"></a>
        </div>
        <ul class="nav">
            <li class="itemN"><a href="index.php" class="name">Home</a></li>
            <li class="itemN"><a href="pedidos.php" class="name">Pedidos</a></li>
            <li class="itemN"><a href="peca.php" class="name">Peça aqui</a></li>
        </ul>
        <?php if (!isset($_SESSION['login'])) : ?>
            <div class="loginH">
                <a href="login.php" class="login">LOGIN</a>
            </div>
        <?php else : ?>
            <p class='mensagemlogin'>
                Olá, <?php echo htmlspecialchars($row_nome['User_Login']); ?> seja bem-vindo de volta!
                <a class='logout' href='index.php?logout'>LOGOUT</a>
            </p>
        <?php endif; ?>
    </header>
    <?php echo exibirMensagem(); ?> 