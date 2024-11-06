<?php
require_once '../init.php';
session_start();

// Redireciona se já estiver logado
if (isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Inventário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: var(--champagne);
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
        }
        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: var(--cambridge-blue);
            color: white;
        }
        .btn-primary {
            background-color: var(--cambridge-blue);
            border-color: var(--cambridge-blue);
        }
        .btn-primary:hover {
            background-color: var(--khaki);
            border-color: var(--khaki);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card">
            <div class="card-header text-center py-3">
                <h4 class="mb-0">Sistema de Inventário</h4>
            </div>
            <div class="card-body p-4">
                <?php if (isset($_SESSION['flash_message'])): ?>
                    <div class="alert alert-<?= $_SESSION['flash_type'] ?>">
                        <?= $_SESSION['flash_message'] ?>
                    </div>
                    <?php 
                    unset($_SESSION['flash_message']);
                    unset($_SESSION['flash_type']);
                    ?>
                <?php endif; ?>

                <form action="auth/login.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <div class="mb-3">
                        <a href="recuperar-senha.php" class="text-muted">Esqueceu sua senha?</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 