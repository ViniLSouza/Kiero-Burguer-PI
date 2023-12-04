<?php
session_start();
if (isset($_SESSION['login'])) {
    include "conn.php";

    $cliente_id = $_SESSION['login'];
    $carrinhoItens = json_decode(file_get_contents('php://input'), true);

    $ids_itens = array_keys($carrinhoItens);

    $inserir_pedido = $conn->prepare('INSERT INTO pedidos (FKcliente, items) VALUES (:cliente_id, :items)');
    $inserir_pedido->bindParam(':cliente_id', $cliente_id);
    $inserir_pedido->bindParam(':items', json_encode(intval($carrinhoItens["items"])));
    
    if ($inserir_pedido->execute()) {
        echo json_encode(array("status" => "success", "message" => "Pedido registrado com sucesso!"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Erro ao registrar o pedido."));
    }
}
?>