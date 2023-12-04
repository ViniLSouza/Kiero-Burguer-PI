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
            <p class='mensagemlogin'>Olá, <?php echo $row_nome['User_Login']; ?> seja bem-vindo de volta!
                <a class='logout' href='index.php?logout'>LOGOUT</a>
            </p>
        <?php endif; ?>
    </header>
    <div class="itens">
        <?php
        $conn = new PDO('mysql:host=localhost;dbname=banco', 'root', '');

        if (!$conn) {
            die("Erro de conexão.");
        }

        $query = "SELECT id, foto, nome, descricao, preco, tipo FROM consumiveis";
        $result = $conn->query($query);

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="item">';
                echo '<img class="foto" src="ADM/fotos/' . $row['foto'] . '" alt="Imagem do Produto">';
                echo '<h3>' . $row['nome'] . '</h3>';
                echo '<p>' . $row['descricao'] . '</p>';
                echo '<p>Preço: R$ ' . number_format($row['preco'], 2, ',', '.') . '</p>';
                echo '<button onclick="adicionarAoCarrinho(' . $row['id'] . ', \'' . $row['nome'] . '\', ' . $row['preco'] . ')">Adicionar ao Carrinho</button>';
                echo '</div>';
            }
        } else {
            echo "Nenhum item disponível no momento.";
        }

        $conn = null;
        ?>
    </div>

    <div class="carrinho">
        <h2>Carrinho de Compras</h2>
        <div id="itens-carrinho">
            <div id="preco-total">Preço Total: R$ 0.00</div>
        </div>
        <button onclick="finalizarCompra()">Finalizar Compra</button>
    </div>

    <script>
        var carrinhoItens = {};
        var precoTotal = 0;

        function adicionarAoCarrinho(id, nome, preco) {
            const currentProduct = carrinhoItens[id];
            if (currentProduct) {
                carrinhoItens[id] = {
                    nome,
                    preco,
                    quantidade: carrinhoItens[id].quantidade + 1
                }
            } else {
                carrinhoItens = {
                    ...carrinhoItens,
                    [id]: {
                        nome,
                        preco,
                        quantidade: 1
                    }
                }
            }
            console.log(carrinhoItens[id])
            const currentElementId = document.getElementById(`item-${id}`)

            if (!currentElementId) {
                var itemHTML = '<div id="item-' + id + '">' + nome + ' - R$ ' + preco.toFixed(2) + " - quantidade: " + carrinhoItens[id].quantidade + ' <button onclick="removerDoCarrinho(' + id + ',' + preco + ')">Remover</button></div>';
                document.getElementById('itens-carrinho').innerHTML += itemHTML;
            } else {
                document.getElementById(`item-${id}`).innerHTML = `<div id="item-${id}">${nome} - R$ ${preco.toFixed(2)} - quantidade ${carrinhoItens[id].quantidade} <button onclick="removerDoCarrinho(${id}, ${preco})">Remover</button></div>`;
            }


            precoTotal += preco;
            atualizarPrecoTotal();
        }

        function removerDoCarrinho(id, preco) {
            console.log(Object.keys(carrinhoItens).length)
            if (Object.keys(carrinhoItens).length) {
                var itemElement = document.getElementById('item-' + id);
                console.log(itemElement)
                if (carrinhoItens[id].quantidade===1) {
                    itemElement.parentNode.removeChild(itemElement);
                    delete carrinhoItens[id];
                } else {
                    carrinhoItens[id] = {
                        ...carrinhoItens[id],
                        quantidade: carrinhoItens[id].quantidade - 1
                    }
                    itemElement.innerHTML = `${carrinhoItens[id].nome} - R$ ${preco.toFixed(2)} - quantidade: ${carrinhoItens[id].quantidade} <button onclick="removerDoCarrinho(${id}, ${preco})">Remover</button>`;
                }
                precoTotal -= preco;
                atualizarPrecoTotal();
            }
            
        }

        function atualizarPrecoTotal() {
            var precoTotalElement = document.getElementById('preco-total');
            precoTotalElement.textContent = 'Preço Total: R$ ' + precoTotal.toFixed(2);
        }

        function finalizarCompra() {
            if (!Object.keys(carrinhoItens).length) {
                alert("Adicione itens ao carrinho antes de finalizar a compra.");
                return;
            }

            const returnArrayQuantities = () => {
                const finalArray = []
                for(var key in carrinhoItens){
                    const currentObject = carrinhoItens[key];
                    for(let i = 0;i < currentObject.quantidade;i++){
                        finalArray.push(key)
                    }
                }
                return finalArray;
            }
            carrinhoItens = {
                ...carrinhoItens,
                items: returnArrayQuantities()      
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "processar_compra.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText)
                        alert("Compra finalizada com sucesso!");
                    } else {
                        alert("Erro ao processar o pedido. Por favor, tente novamente.");
                    }
                }
            };

            xhr.send(JSON.stringify(carrinhoItens));

            carrinhoItens = {};
            document.getElementById('itens-carrinho').innerHTML = '';
            precoTotal = 0;
            atualizarPrecoTotal();
        }
    </script>
</body>

</html>