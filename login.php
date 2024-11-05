<?php 
require_once 'config/config.php';
require_once 'includes/header.php';

// Verifica se o usuário admin já existe
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->execute(['flutter.marilia@gmail.com']);
$adminExists = $stmt->rowCount() > 0;
?>

<div class="auth-container">
    <div class="auth-wrapper">
        <!-- Lado do Formulário -->
        <div class="auth-form-side">
            <div class="auth-header">
                <h2>Bem-vindo</h2>
                <p>Faça login para continuar</p>
            </div>

            <?php if (!$adminExists): ?>
            <div class="admin-setup">
                <button id="setupAdminBtn" class="btn btn-setup" onclick="setupAdmin()">
                    <i class="fas fa-user-shield"></i>
                    <span>Configurar Admin</span>
                </button>
            </div>
            <?php endif; ?>

            <form id="loginForm" class="auth-form">
                <input type="hidden" name="action" value="login">
                
                <!-- Email -->
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="flutter.marilia@gmail.com" 
                               class="form-control" 
                               required>
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
                               value="jr34139251"
                               class="form-control" 
                               required>
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Lembrar & Esqueci -->
                <div class="form-group form-flex">
                    <label class="checkbox-container">
                        <input type="checkbox" name="remember">
                        <span class="checkmark"></span>
                        <span>Lembrar-me</span>
                    </label>
                    <a href="recuperar-senha.php" class="forgot-link">Esqueci a senha</a>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary btn-block">
                    <span>Entrar</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <!-- Cadastro Link -->
                <div class="auth-footer">
                    <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
                </div>
            </form>
        </div>

        <!-- Lado do Banner -->
        <div class="auth-banner-side">
            <div class="banner-overlay"></div>
            <div class="banner-content">
                <div class="banner-header">
                    <div class="banner-logo">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h3>BeautySalon</h3>
                    <p>Sua experiência de beleza</p>
                </div>

                <div class="features-list">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="feature-text">
                            <h5>Agendamento Online</h5>
                            <p>Marque seus horários 24/7</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="feature-text">
                            <h5>Profissionais Qualificados</h5>
                            <p>Equipe especializada</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para configuração do admin -->
<script>
async function setupAdmin() {
    try {
        const response = await fetch('controllers/AuthController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=setup_admin'
        });

        const data = await response.json();
        
        if (data.success) {
            // Mostra mensagem de sucesso
            showAlert('success', 'Administrador configurado com sucesso!');
            
            // Remove o botão
            document.querySelector('.admin-setup').remove();
        } else {
            showAlert('error', data.message || 'Erro ao configurar administrador');
        }
    } catch (error) {
        showAlert('error', 'Erro ao processar a requisição');
    }
}

function showAlert(type, message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
        <span>${message}</span>
    `;
    
    document.querySelector('.auth-header').insertAdjacentElement('afterend', alertDiv);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}
</script>

<?php require_once 'includes/footer.php'; ?>