<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

if (isset($_SESSION['login'])) {
    include "conn.php";
    $cons_pedidos = $conn->prepare('SELECT * FROM pedidos WHERE FKcliente = :pid ORDER BY data_hora DESC');
    $cons_pedidos->bindValue(':pid', $_SESSION['login']);
    $cons_pedidos->execute();
    $rows_pedidos = $cons_pedidos->fetchAll();

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
    <title>Meus Pedidos</title>
    <link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
    <style>
    </style>
</head>
<style>
    body {
        background-image: url('imagens/parede-de-concreto.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: repeat;
    }

    h2 {
        font-size: 30px;
        margin-block: 1em;
        text-align: center;
        color: #9b1c1c;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #9b1c1c;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #9b1c1c;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Estilos para telas menores */
    @media screen and (max-width: 768px) {

        th,
        td {
            font-size: 12px;
            padding: 6px;
            /* Reduzindo o padding para adicionar espaço entre os itens */
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
            <li class="itemN item"><a href="pedidos.php" class="name">Pedidos</a></li>
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

    <div class="container">
        <h2>Meus Pedidos</h2>
        <?php if (isset($_SESSION['login'])) : ?>
            <?php if (count($rows_pedidos) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Pedido</th>
                            <th>Data e Hora</th>
                            <th>Itens</th>
                            <th>Total</th>
                            <th>Endereço de Entrega</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows_pedidos as $pedido) : ?>
                            <tr>
                                <td><?php echo $pedido['id_pedido']; ?></td>
                                <td><?php echo $pedido['data_hora']; ?></td>
                                <td>
                                    <?php
                                    $cons_itens_pedido = $conn->prepare('SELECT c.nome, c.preco, COUNT(pc.FK_consumivel) as quantidade 
                                                                        FROM pedidos_consumiveis pc 
                                                                        INNER JOIN consumiveis c ON pc.FK_consumivel = c.id 
                                                                        WHERE pc.FK_pedido = :pedido_id
                                                                        GROUP BY c.nome, c.preco');
                                    $cons_itens_pedido->bindValue(':pedido_id', $pedido['id_pedido']);
                                    $cons_itens_pedido->execute();
                                    $rows_itens_pedido = $cons_itens_pedido->fetchAll();

                                    foreach ($rows_itens_pedido as $item) {
                                        echo $item['nome'] . " - Quantidade: " . $item['quantidade'] . " - R$ " . number_format($item['preco'], 2) . "<br>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $total_pedido = 0;
                                    foreach ($rows_itens_pedido as $item) {
                                        $total_pedido += $item['preco'];
                                    }
                                    echo "R$ " . number_format($total_pedido, 2);
                                    ?>
                                </td>
                                <td>
                                    <!-- Aqui você pode exibir o endereço de entrega, utilizando os dados do usuário -->
                                    <!-- Exemplo: -->
                                    <?php echo $row_nome['Logradouro_Login'] . ", " . $row_nome['Numero_Login'] . ", " . $row_nome['Complemento_Login'] . ", " . $row_nome['Bairro_Login'] . ", " . $row_nome['Cidade_Login'] . " - " . $row_nome['Estado_Login']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>Você não tem nenhum pedido.</p>
            <?php endif; ?>
        <?php else : ?>
            <p>Você precisa fazer login para visualizar seus pedidos.</p>
        <?php endif; ?>
    </div>

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

</html>