<?php
require_once 'config/constants.php';
require_once 'config/database.php';
require_once 'includes/functions.php';

// Inicializa a sessão
iniciarSessao();

// Roteamento básico
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Verifica se é uma rota da área administrativa
if (strpos($page, 'admin/') === 0) {
    // Verifica se o usuário está logado e é administrador
    if (!isset($_SESSION['login']) || !isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != USER_TYPE_ADMIN) {
        header('Location: ' . SITE_URL . '/login.php');
        exit;
    }
    
    // Remove o prefixo 'admin/' e inclui o arquivo da área administrativa
    $admin_page = substr($page, 6);
    $file = 'admin/views/' . $admin_page . '.php';
} else {
    // Inclui o arquivo da área pública
    $file = 'src/views/' . $page . '.php';
}

// Verifica se o arquivo existe
if (file_exists($file)) {
    require_once $file;
} else {
    // Página não encontrada
    header("HTTP/1.0 404 Not Found");
    require_once 'src/views/404.php';
} 