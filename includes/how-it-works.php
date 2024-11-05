<div class="how-it-works-container">
    <div class="steps-wrapper">
        <!-- Passo 1 -->
        <div class="step-item">
            <div class="step-icon">
                <i class="fas fa-user-plus"></i>
                <span class="step-number">1</span>
            </div>
            <div class="step-content">
                <h3>Cadastre-se</h3>
                <p>Crie sua conta gratuitamente em poucos segundos usando seu email</p>
                <ul class="step-features">
                    <li>
                        <i class="fas fa-check"></i>
                        Processo rápido e seguro
                    </li>
                    <li>
                        <i class="fas fa-check"></i>
                        Sem taxas de cadastro
                    </li>
                </ul>
            </div>
        </div>

        <!-- Passo 2 -->
        <div class="step-item">
            <div class="step-icon">
                <i class="fas fa-calendar-alt"></i>
                <span class="step-number">2</span>
            </div>
            <div class="step-content">
                <h3>Escolha o Horário</h3>
                <p>Selecione o serviço e horário que melhor se adequa à sua agenda</p>
                <ul class="step-features">
                    <li>
                        <i class="fas fa-check"></i>
                        Disponibilidade em tempo real
                    </li>
                    <li>
                        <i class="fas fa-check"></i>
                        Horários flexíveis
                    </li>
                </ul>
            </div>
        </div>

        <!-- Passo 3 -->
        <div class="step-item">
            <div class="step-icon">
                <i class="fas fa-credit-card"></i>
                <span class="step-number">3</span>
            </div>
            <div class="step-content">
                <h3>Confirme a Reserva</h3>
                <p>Confirme seu agendamento e escolha a forma de pagamento</p>
                <ul class="step-features">
                    <li>
                        <i class="fas fa-check"></i>
                        Pagamento seguro
                    </li>
                    <li>
                        <i class="fas fa-check"></i>
                        Múltiplas formas de pagamento
                    </li>
                </ul>
            </div>
        </div>

        <!-- Passo 4 -->
        <div class="step-item">
            <div class="step-icon">
                <i class="fas fa-spa"></i>
                <span class="step-number">4</span>
            </div>
            <div class="step-content">
                <h3>Aproveite</h3>
                <p>Venha relaxar e aproveitar nossos serviços profissionais</p>
                <ul class="step-features">
                    <li>
                        <i class="fas fa-check"></i>
                        Atendimento personalizado
                    </li>
                    <li>
                        <i class="fas fa-check"></i>
                        Ambiente acolhedor
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="steps-cta">
        <?php if (!AuthHelper::isLoggedIn()): ?>
            <a href="cadastro.php" class="btn btn-primary">
                <i class="fas fa-user-plus"></i>
                Começar Agora
            </a>
        <?php else: ?>
            <a href="agendar.php" class="btn btn-primary">
                <i class="fas fa-calendar-plus"></i>
                Agendar Horário
            </a>
        <?php endif; ?>
    </div>
</div> 