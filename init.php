<?php
// Ativa exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define o caminho base do projeto
define('ROOT_PATH', __DIR__);

// Carrega as configurações
require_once ROOT_PATH . '/config/config.php'; 