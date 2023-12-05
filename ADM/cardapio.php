<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200;400;600;700&display=swap');
    body {
    background-image: url('../imagens/parede-de-concreto.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-family: Arial, sans-serif;
    flex-direction: column;
    position: relative;
    padding-bottom: 60px;
}

form {
    background-color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 20px;
}

a {
    display: block;
    margin-bottom: 10px;
    color: #9b1c1c;
    text-decoration: none;
    font-weight: bold;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #9b1c1c;
}

input[type="text"],
input[type="number"],
textarea,
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

input[type="file"] {
    margin-bottom: 15px;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #9b1c1c;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #751515;
}

.consumivel-item {
    display: flex;
    text-align: center;
    align-items: center;
    justify-content: center;
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 20px;
    width: 80%;
    margin: 10px auto;
    max-width: 600px;
    flex-wrap: wrap;
}

.btn {
    width: 100px;
    height: 100px;
}

.foto {
    width: 20%;
    height: 100%;
    margin-inline: 1em;
}

.margin {
    margin-inline: 1em;
}

.fotob {
    width: 150px;
    height: 150px;
    overflow: hidden;
}

.fotob img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.tipo {
    font-size: 20px;
}
    </style>
</head>

<body>
    <form action="processar_cadastro.php" method="post" enctype="multipart/form-data">
        <a href="indexadm.php">Voltar a página inicial</a>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*" required>
        <br><br>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" rows="4" cols="50" required></textarea>
        <br><br>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" required>
        <br><br>

        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required class="tipo">
            <option value="hamburguer">Hambúrguer</option>
            <option value="porcao">Porção</option>
            <option value="bebida">Bebida</option>
        </select>
        <br><br>

        <input type="submit" value="Cadastrar">
    </form>

    <?php
    try {
        include "../conn.php";
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['excluir_id'])) {
                $excluirId = $_POST['excluir_id'];

                $sql = "DELETE FROM consumiveis WHERE id = :excluirId";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':excluirId', $excluirId);
                $stmt->execute();

                $caminho_imagem = 'fotos/' . $foto_a_excluir;
                if (file_exists($caminho_imagem)) {
                    unlink($caminho_imagem);
                    echo 'Imagem excluída com sucesso.';
                }

                header("Location: cardapio.php");
                exit();
            }

            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $novoNome = $_POST['novo_nome'];
                $novaDescricao = $_POST['nova_descricao'];
                $novoPreco = $_POST['novo_preco'];
                $novoTipo = $_POST['novo_tipo'];

                $sql = "UPDATE consumiveis SET nome = :novoNome, descricao = :novaDescricao, preco = :novoPreco, tipo = :novoTipo WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':novoNome', $novoNome);
                $stmt->bindParam(':novaDescricao', $novaDescricao);
                $stmt->bindParam(':novoPreco', $novoPreco);
                $stmt->bindParam(':novoTipo', $novoTipo);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                header("Location: cardapio.php");
                exit();
            }
        }

        $sql = "SELECT * FROM consumiveis";
        $result = $conn->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="consumivel-item">';
            echo '<h3>' . $row['nome'] . '</h3>';
            echo '<div class="fotob">';
            echo '<img class="foto" src="fotos/' . $row['foto'] . '" alt="Imagem do Produto">';
            echo '</div>';
            echo '<p class="margin">' . $row['descricao'] . '</p>';
            echo '<p class="margin">Preço: R$ ' . number_format($row['preco'], 2, ',', '.') . '</p>';
            echo '<p class="margin">Tipo: ' . $row['tipo'] . '</p>';

            echo '<button onclick="showEditForm(' . $row['id'] . ')" class="btn">Editar</button>';

            echo '<form style="display: inline-block;" method="post" action="cardapio.php">';
            echo '<input type="hidden" name="excluir_id" value="' . $row['id'] . '">';
            echo '<input type="submit" value="Excluir" onclick="return confirm(\'Tem certeza que deseja excluir este item?\')">';
            echo '</form>';

            echo '<form id="editForm-' . $row['id'] . '" style="display: none;" action="cardapio.php" method="post">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo 'Novo Nome: <input type="text" name="novo_nome" value="' . $row['nome'] . '"><br>';
            echo 'Nova Descrição: <textarea name="nova_descricao">' . $row['descricao'] . '</textarea><br>';
            echo 'Novo Preço: <input type="number" name="novo_preco" value="' . $row['preco'] . '"><br>';
            echo 'Novo Tipo: <input type="text" name="novo_tipo" value="' . $row['tipo'] . '"><br>';
            echo '<input type="submit" value="Salvar">';
            echo '</form>';

            echo '</div>';
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?>
    <?php

    if (isset($_POST['productId'])) {
        $productId = $_POST['productId'];

        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array();
        }

        $_SESSION['carrinho'][] = $productId;
        header('Location: peça.php');
        exit();
    } else {
        echo "";
    }
    ?>

    <script>
        function showEditForm(itemId) {
            var formId = 'editForm-' + itemId;
            var editForm = document.getElementById(formId);
            if (editForm.style.display === "none") {
                editForm.style.display = "block";
            } else {
                editForm.style.display = "none";
            }
        }
    </script>
</body>

</html>