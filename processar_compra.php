<?php
session_start();
if (isset($_SESSION['login'])) {
    include "conn.php";

    $funcaoConversao = function($valor) {
        return intval($valor);
    };

    $cliente_id = $_SESSION['login'];
    $carrinhoItens = json_decode(file_get_contents('php://input'), true);

    $ids_itens = array_keys($carrinhoItens);

    $query_order = $conn->prepare('INSERT INTO pedidos (FKcliente, items) VALUES (:cliente_id, :items)');
    $inserir_pedido->bindParam(':cliente_id', $cliente_id);
    $array_items = array_map($funcaoConversao, $carrinhoItens["items"]);
    $query_order->bindParam(':items', json_encode($array_items));


    
    if ($query_order->execute()) {
        $id = $query_order->insert_id();
        foreach ($array_items as $item) {
            $pedido = $id;
            $produto = $item;
            $stmt = $conn->prepare('INSERT INTO pedido_consumiveis (pedido, produto) VALUES (?, ?)');
            $stmt->bind_param('ii', $pedido, $produto);
            $stmt->execute();
        }
        echo json_encode(array("status" => "success", "message" => "Pedido registrado com sucesso!"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Erro ao registrar o pedido."));
    }
}
?>