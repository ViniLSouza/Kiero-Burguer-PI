<?php
// Funções de validação
function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
    if (strlen($cpf) != 11) {
        return false;
    }
    
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

function validarSenha($senha) {
    if (strlen($senha) < 8) {
        return false;
    }
    if (!preg_match('/[A-Z]/', $senha)) {
        return false;
    }
    if (!preg_match('/[a-z]/', $senha)) {
        return false;
    }
    if (!preg_match('/[0-9]/', $senha)) {
        return false;
    }
    if (!preg_match('/[^A-Za-z0-9]/', $senha)) {
        return false;
    }
    return true;
}

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Funções de segurança
function sanitizarInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function gerarHashSenha($senha) {
    return password_hash($senha, PASSWORD_DEFAULT);
}

function verificarSenha($senha, $hash) {
    return password_verify($senha, $hash);
}

// Funções de sessão
function iniciarSessao() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', 1);
    ini_set('session.cookie_samesite', 'Strict');
}

function verificarLogin() {
    if (!isset($_SESSION['login'])) {
        header('Location: login.php');
        exit();
    }
}

// Funções de formatação
function formatarCPF($cpf) {
    return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
}

function formatarCEP($cep) {
    return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $cep);
}

function formatarTelefone($telefone) {
    return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $telefone);
}

// Funções de mensagem
function mostrarMensagem($mensagem, $tipo = 'info') {
    $_SESSION['mensagem'] = [
        'texto' => $mensagem,
        'tipo' => $tipo
    ];
}

function exibirMensagem() {
    if (isset($_SESSION['mensagem'])) {
        $mensagem = $_SESSION['mensagem'];
        unset($_SESSION['mensagem']);
        return "<div class='mensagem {$mensagem['tipo']}'>{$mensagem['texto']}</div>";
    }
    return '';
} 