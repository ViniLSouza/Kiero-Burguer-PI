<?php

try {
    include "../conn.php";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT * FROM tbl_login");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_user'])) {
        $id = $_POST['user_id'];
        $tipo_usuario = $_POST['tipo_usuario'];

        try {
            $stmt = $conn->prepare("UPDATE tbl_login SET Tipo_Usuario = :tipo_usuario WHERE ID_Login = :id");
            $stmt->bindParam(':tipo_usuario', $tipo_usuario);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            header('Location: Gerenciamento-Clientes.php');
            exit();
        } catch (PDOException $e) {
            echo "Erro ao atualizar usuário: " . $e->getMessage();
        }
    } elseif (isset($_POST['delete_user'])) {
        $id = $_POST['user_id'];

        try {
            $stmt = $conn->prepare("DELETE FROM tbl_login WHERE ID_Login = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            header('Location: Gerenciamento-Clientes.php');
            exit();
        } catch (PDOException $e) {
            echo "Erro ao excluir usuário: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Usuários</title>
</head>

<body>
    <h1>Gerenciamento de Usuários</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo de Usuário</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($usuarios as $usuario) : ?>
            <tr>
                <td><?= $usuario['ID_Login'] ?></td>
                <td><?= $usuario['User_Login'] ?></td>
                <td><?= $usuario['Nome_Login'] ?></td>
                <td><?= $usuario['Email_Login'] ?></td>
                <td>
                    <form method="post" action="Gerenciamento-Clientes.php">
                        <input type="hidden" name="user_id" value="<?= $usuario['ID_Login'] ?>">
                        <select name="tipo_usuario">
                            <option value="0" <?= $usuario['Tipo_Usuario'] == 0 ? 'selected' : '' ?>>Normal</option>
                            <option value="1" <?= $usuario['Tipo_Usuario'] == 1 ? 'selected' : '' ?>>Admin</option>
                        </select>
                        <button type="submit" name="edit_user">Salvar</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="Gerenciamento-Clientes.php" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                        <input type="hidden" name="user_id" value="<?= $usuario['ID_Login'] ?>">
                        <button type="submit" name="delete_user">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>