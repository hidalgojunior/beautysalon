<?php
session_start();
require_once 'config/constants.php';
require_once 'config/database.php';
require_once 'helpers/AuthHelper.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Agendamento Online</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php include 'includes/header.php'; ?>
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Agende seu horário</h1>
            <p>Facilidade e praticidade para cuidar da sua beleza</p>
            <div class="hero-actions">
                <?php if (!AuthHelper::isLoggedIn()): ?>
                    <a href="login.php" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </a>
                    <a href="cadastro.php" class="btn btn-outline">
                        <i class="fas fa-user-plus"></i>
                        Cadastre-se
                    </a>
                <?php else: ?>
                    <a href="agendar.php" class="btn btn-primary">
                        <i class="fas fa-calendar-plus"></i>
                        Agendar Agora
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Serviços -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-header">
                <h2>Nossos Serviços</h2>
                <p>Conheça os serviços disponíveis para agendamento</p>
            </div>
            <?php include 'includes/services-list.php'; ?>
        </div>
    </section>

    <!-- Como Funciona -->
    <section class="how-it-works" id="how">
        <div class="container">
            <div class="section-header">
                <h2>Como Funciona</h2>
                <p>Agendar seu horário é simples e rápido</p>
            </div>
            <?php include 'includes/how-it-works.php'; ?>
        </div>
    </section>

    <!-- Depoimentos -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>Depoimentos</h2>
                <p>O que nossos clientes dizem</p>
            </div>
            <?php include 'includes/testimonials.php'; ?>
        </div>
    </section>

    <!-- Contato -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="section-header">
                <h2>Entre em Contato</h2>
                <p>Tire suas dúvidas ou envie sua mensagem</p>
            </div>
            <?php include 'includes/contact-form.php'; ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="assets/js/main.js"></script>
</body>
</html> 