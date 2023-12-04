<?php
session_start();
if (isset($_SESSION['login'])) {
    $conn = new PDO('mysql:host=localhost;dbname=banco', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $funcaoConversao = function ($valor) {
        return intval($valor);
    };

    $cliente_id = $_SESSION['login'];
    $carrinhoItens = json_decode(file_get_contents('php://input'), true);

    if ($carrinhoItens !== null && isset($carrinhoItens['items'])) {
        $query_order = $conn->prepare('INSERT INTO pedidos (FKcliente, items) VALUES (:cliente_id, :items)');
        $query_order->bindParam(':cliente_id', $cliente_id);
        $array_items = array_map($funcaoConversao, $carrinhoItens["items"]);
        $query_order->bindParam(':items', json_encode($array_items));
        $query_order->execute();

        $id_pedido = $conn->lastInsertId();

        foreach ($array_items as $item) {
            $pedido = intval($id_pedido);
            $produto = intval($item);
            $stmt = $conn->prepare('INSERT INTO pedidos_consumiveis (FK_pedido, FK_consumivel) VALUES (:pedido,:produto)');
            $stmt->bindParam(':pedido', $pedido);
            $stmt->bindParam(':produto', $produto);
            $stmt->execute();
        }

        echo $id_pedido;
    } else {
        echo "Dados do carrinho não foram recebidos ou estão em um formato inválido.";
    }
}
