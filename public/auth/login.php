<?php
require_once '../../init.php';
require_once ROOT_PATH . '/controllers/AuthController.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new AuthController();
    $resultado = $auth->login($_POST['email'], $_POST['senha']);

    if ($resultado['success']) {
        $_SESSION['flash_message'] = $resultado['message'];
        $_SESSION['flash_type'] = 'success';
        header('Location: ' . BASE_URL . '/dashboard.php');
    } else {
        $_SESSION['flash_message'] = $resultado['message'];
        $_SESSION['flash_type'] = 'danger';
        header('Location: ' . BASE_URL . '/login.php');
    }
    exit;
}

header('Location: ' . BASE_URL . '/login.php');
exit; 