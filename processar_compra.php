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
    $query_order->bindParam(':cliente_id', $cliente_id);
    $array_items = array_map($funcaoConversao, $carrinhoItens["items"]);
    $query_order->bindParam(':items', json_encode($array_items));
    
    if ($query_order->execute()) {
        
        $id = intval($query_order->insert_id);
        foreach ($array_items as $item) {
            $pedido = $id;
            $produto = intval($item);
            $stmt = $conn->prepare('INSERT INTO pedido_consumiveis (FK_pedido, FK_consumivel) VALUES (?, ?)');
            $stmt->bindParam('ii', $pedido, $produto);
            $stmt->execute();
        }
        echo json_encode(array("status" => "success", "message" => $id));
    } else {
        echo json_encode(array("status" => "error", "message" => "Erro ao registrar o pedido."));
    }
}
?>