<?php
// Configurações do sistema
define('SITE_NAME', 'Kiero Burguer');
define('SITE_URL', 'http://localhost/Kiero-Burguer-PI');

// Configurações de email
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'seu-email@gmail.com');
define('SMTP_PASS', 'sua-senha');

// Configurações de upload
define('UPLOAD_DIR', 'assets/images/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif']);

// Configurações de paginação
define('ITEMS_PER_PAGE', 10);

// Mensagens de erro
define('ERROR_INVALID_CPF', 'CPF inválido');
define('ERROR_INVALID_EMAIL', 'E-mail inválido');
define('ERROR_INVALID_PASSWORD', 'Senha deve conter pelo menos 8 caracteres, uma letra maiúscula, uma minúscula, um número e um caractere especial');
define('ERROR_LOGIN_FAILED', 'Usuário ou senha incorretos');
define('ERROR_USER_EXISTS', 'Usuário já existe');
define('ERROR_EMAIL_EXISTS', 'E-mail já cadastrado');

// Mensagens de sucesso
define('SUCCESS_REGISTER', 'Cadastro realizado com sucesso!');
define('SUCCESS_LOGIN', 'Login realizado com sucesso!');
define('SUCCESS_LOGOUT', 'Logout realizado com sucesso!');
define('SUCCESS_ORDER', 'Pedido realizado com sucesso!');

// Tipos de usuário
define('USER_TYPE_ADMIN', 1);
define('USER_TYPE_CLIENT', 0);

// Status de pedido
define('ORDER_STATUS_PENDING', 0);
define('ORDER_STATUS_PREPARING', 1);
define('ORDER_STATUS_READY', 2);
define('ORDER_STATUS_DELIVERED', 3);
define('ORDER_STATUS_CANCELLED', 4);

// Formas de pagamento
define('PAYMENT_METHOD_CARD', 'card');
define('PAYMENT_METHOD_CASH', 'cash'); 