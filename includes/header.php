<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'BeautySalon'; ?></title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Base -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/components.css">
    
    <!-- CSS Específicos -->
    <?php
    // Detecta a página atual
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
    
    // Carrega CSS específico baseado na página
    switch ($currentPage) {
        case 'dashboard':
            echo '<link rel="stylesheet" href="assets/css/dashboard.css">';
            break;
        case 'login':
        case 'cadastro':
            echo '<link rel="stylesheet" href="assets/css/auth.css">';
            break;
        case 'agendamentos':
            echo '<link rel="stylesheet" href="assets/css/agendamentos.css">';
            break;
        // Adicione outros casos conforme necessário
    }
    ?>
</head>
<body>
    <header class="main-header">
        <div class="container">
            <nav class="nav-wrapper">
                <!-- Logo -->
                <a href="<?php echo SITE_URL; ?>" class="logo">
                    <span class="logo-text">BeautySalon</span>
                </a>

                <!-- Menu Toggle (Mobile) -->
                <button class="menu-toggle" aria-label="Abrir menu">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Navigation -->
                <div class="nav-menu">
                    <ul class="nav-links">
                        <li>
                            <a href="#services" class="nav-link">
                                <i class="fas fa-spa"></i>
                                <span>Serviços</span>
                            </a>
                        </li>
                        <li>
                            <a href="#how" class="nav-link">
                                <i class="fas fa-clipboard-list"></i>
                                <span>Como Funciona</span>
                            </a>
                        </li>
                        <li>
                            <a href="#testimonials" class="nav-link">
                                <i class="fas fa-star"></i>
                                <span>Depoimentos</span>
                            </a>
                        </li>
                        <li>
                            <a href="#contact" class="nav-link">
                                <i class="fas fa-envelope"></i>
                                <span>Contato</span>
                            </a>
                        </li>
                    </ul>

                    <div class="nav-auth">
                        <?php if (AuthHelper::isLoggedIn()): ?>
                            <div class="dropdown">
                                <button class="dropdown-toggle nav-button">
                                    <i class="fas fa-user-circle"></i>
                                    <span><?php echo AuthHelper::getUserName(); ?></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="perfil.php">
                                            <i class="fas fa-user"></i>
                                            <span>Meu Perfil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="meus-agendamentos.php">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>Agendamentos</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="logout.php">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span>Sair</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a href="login.php" class="nav-button btn-login">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Entrar</span>
                            </a>
                            <a href="cadastro.php" class="nav-button btn-register">
                                <i class="fas fa-user-plus"></i>
                                <span>Cadastrar</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </header> 