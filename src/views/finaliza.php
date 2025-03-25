<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIERO BURGUER</title>
    <link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/finaliza.css" media="screen" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body>
    <header>
        <div class="logoH">
            <a href="index.php"><img src="imagens/logo.png" class="logoN"></a>
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
            <p class='mensagemlogin'>Olá, <?php echo $row_nome['User_Login']; ?> seja bem-vindo de volta!
                <a class='logout' href='index.php?logout'>LOGOUT</a>
            </p>
        <?php endif; ?>
    </header>

    <section>
        <div class="pagamento">
            <h2>Valor total do seu pedido: R$<span id="valorTotal">00,00</span></h2>
            <p>Escolha a forma de pagamento:</p>

            <label for="cartao">
                <input type="radio" name="pagamento" id="cartao"> Cartão Crédito/Débito <i class="ph ph-credit-card"></i>
            </label>

            <label for="dinheiro">
                <input type="radio" name="pagamento" id="dinheiro"> Dinheiro <i class="ph ph-coins"></i>
            </label>
            <p><i class="ph ph-warning-circle"></i>Lembramos que o pagamento é feito na entrega!</p>
            <button>Finalizar</button>
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