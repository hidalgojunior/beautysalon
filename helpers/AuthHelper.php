<?php
class AuthHelper {
    public static function isLoggedIn() {
        return isset($_SESSION['usuario_id']);
    }

    public static function requireLogin() {
        if (!self::isLoggedIn()) {
            header("Location: " . SITE_URL . "/login.php");
            exit;
        }
    }

    public static function requireAdmin() {
        self::requireLogin();
        if ($_SESSION['usuario_tipo'] !== 'admin') {
            header("Location: " . SITE_URL . "/403.php");
            exit;
        }
    }

    public static function getUserId() {
        return $_SESSION['usuario_id'] ?? null;
    }

    public static function getUserType() {
        return $_SESSION['usuario_tipo'] ?? null;
    }

    public static function getUserName() {
        return $_SESSION['usuario_nome'] ?? null;
    }

    public static function logout() {
        session_destroy();
        header("Location: " . SITE_URL . "/login.php");
        exit;
    }
} 