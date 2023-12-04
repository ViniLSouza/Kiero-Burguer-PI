<?php
try {
    $conn = new PDO('mysql:host=localhost;dbname=banco','root','');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão realizada com sucesso!";
} catch(PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $foto_nome_original = $_FILES['foto']['name'];
    $foto_nome_temporario = $_FILES['foto']['tmp_name'];
    $foto_tipo = $_FILES['foto']['type'];
    $foto_tamanho = $_FILES['foto']['size'];

    $nome_unico = time() . '_' . uniqid() . '_' . basename($foto_nome_original);

    $pastaDestino = "fotos/";

    $caminhoImagem = $pastaDestino . $nome_unico;

    if (move_uploaded_file($foto_nome_temporario, $caminhoImagem)) {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $tipo = $_POST['tipo'];

        $sql = "INSERT INTO consumiveis (foto, nome, descricao, preco, tipo) VALUES ('$nome_unico', '$nome', '$descricao', $preco, '$tipo')";
        
        try {
            $conn->exec($sql);
            echo "Dados inseridos com sucesso!";
            
            header("Location: cardapio.php");
            exit();
        } catch(PDOException $e) {
            echo "Erro ao inserir dados: " . $e->getMessage();
        }
    } else {
        echo "Erro ao mover o arquivo para o diretório de destino.";
    }
}

$conn = null;
?>
