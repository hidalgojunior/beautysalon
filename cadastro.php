<?php 
require_once 'config/config.php';
require_once 'includes/header.php';
?>

<div class="auth-container">
    <div class="auth-wrapper">
        <!-- Lado do Formulário -->
        <div class="auth-form-side">
            <div class="auth-header">
                <h2>Criar sua conta</h2>
                <p>Preencha seus dados para começar</p>
            </div>

            <form id="registerForm" class="auth-form" method="POST" action="controllers/AuthController.php">
                <input type="hidden" name="action" value="register">
                
                <!-- Grid de 2 colunas -->
                <div class="form-grid">
                    <!-- Nome -->
                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" 
                                   id="nome" 
                                   name="nome" 
                                   class="form-control" 
                                   required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-control" 
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Senha -->
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" 
                               id="senha" 
                               name="senha" 
                               class="form-control" 
                               minlength="6"
                               required>
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <small class="form-text">Mínimo de 6 caracteres</small>
                </div>

                <!-- Confirmar Senha -->
                <div class="form-group">
                    <label for="confirmar_senha">Confirmar Senha</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" 
                               id="confirmar_senha" 
                               name="confirmar_senha" 
                               class="form-control" 
                               minlength="6"
                               required>
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Termos -->
                <div class="form-group terms-group">
                    <label class="checkbox-container">
                        <input type="checkbox" name="termos" required>
                        <span class="checkmark"></span>
                        <span class="terms-text">
                            Li e aceito os <a href="#" data-modal="termos">Termos de Uso</a> e a 
                            <a href="#" data-modal="privacidade">Política de Privacidade</a>
                        </span>
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary btn-block">
                    <span>Criar Conta</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <!-- Divisor -->
                <div class="divider">
                    <span>ou</span>
                </div>

                <!-- Social Login -->
                <div class="social-login">
                    <button type="button" class="btn btn-google">
                        <i class="fab fa-google"></i>
                        <span>Continuar com Google</span>
                    </button>
                </div>

                <!-- Login Link -->
                <div class="auth-footer">
                    <p>Já tem uma conta? <a href="login.php">Fazer Login</a></p>
                </div>
            </form>
        </div>

        <!-- Lado do Banner -->
        <div class="auth-banner-side">
            <div class="banner-overlay"></div>
            <div class="banner-content">
                <div class="banner-header">
                    <i class="fas fa-spa banner-icon"></i>
                    <h3>BeautySalon</h3>
                    <p class="banner-subtitle">Sua plataforma de beleza</p>
                </div>

                <div class="banner-features">
                    <h4>Por que escolher nosso salão?</h4>
                    
                    <div class="features-list">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="feature-text">
                                <h5>Agendamento Online</h5>
                                <p>Marque seus horários 24h por dia, 7 dias por semana</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <div class="feature-text">
                                <h5>Profissionais Qualificados</h5>
                                <p>Equipe especializada e constantemente atualizada</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-gem"></i>
                            </div>
                            <div class="feature-text">
                                <h5>Produtos Premium</h5>
                                <p>Utilizamos as melhores marcas do mercado</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="banner-testimonial">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left"></i>
                        <p>"Atendimento excelente e profissionais muito capacitados. Super recomendo!"</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="author-info">
                                <h5>Maria Silva</h5>
                                <p>Cliente desde 2022</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?> 