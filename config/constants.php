<?php
// Informações do Site
define('SITE_NAME', 'Beauty Agenda');
define('SITE_URL', 'http://localhost/agendamento');
define('SITE_EMAIL', 'contato@beautyagenda.com');

// Configurações de Ambiente
define('ENVIRONMENT', 'development'); // development ou production
define('DEBUG', true);

// Configurações de Timezone
date_default_timezone_set('America/Sao_Paulo');

// Configurações de Banco de Dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'agendamento');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configurações de Email
define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'seu-email@gmail.com');
define('MAIL_PASSWORD', 'sua-senha');
define('MAIL_FROM', 'seu-email@gmail.com');
define('MAIL_FROM_NAME', SITE_NAME);

// Configurações de Sessão
define('SESSION_LIFETIME', 7200); // 2 horas em segundos

// Configurações de Upload
define('UPLOAD_DIR', 'uploads/');
define('MAX_FILE_SIZE', 5242880); // 5MB em bytes
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif']);

// Configurações de Segurança
define('HASH_COST', 12); // Custo do bcrypt 