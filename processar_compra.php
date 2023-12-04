<?php
$conn = new PDO('mysql:host=localhost;dbname=banco', 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = json_decode(file_get_contents("php://input"), true);

try {
    $stmt = $conn->prepare("INSERT INTO pedidos (id_produto, quantidade) VALUES (:idProduto, :quantidade)");

    foreach ($data as $idProduto => $quantidade) {
        $idProduto = intval($idProduto);
        $quantidade = intval($quantidade);

        $stmt->bindParam(':idProduto', $idProduto, PDO::PARAM_INT);
        $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->execute();
    }

    http_response_code(200);
    echo json_encode(array("message" => "Pedido processado com sucesso!"));

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Erro ao processar o pedido: " . $e->getMessage()));
}

$conn = null;
?>