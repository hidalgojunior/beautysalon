<section class="hero">
    <div class="hero-pattern"></div>
    <div class="container">
        <div class="hero-content">
            <h1 class="animate-fade-in">
                Cuide da sua beleza com quem entende
            </h1>
            <p class="animate-fade-in-delay-1">
                Agende seu horário online de forma rápida e prática. 
                Profissionais experientes para cuidar de você.
            </p>
            
            <div class="hero-features animate-fade-in-delay-2">
                <div class="feature-item">
                    <i class="fas fa-clock"></i>
                    <span>Agendamento Online 24/7</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-calendar-check"></i>
                    <span>Confirmação Instantânea</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-smile"></i>
                    <span>Profissionais Qualificados</span>
                </div>
            </div>

            <div class="hero-actions animate-fade-in-delay-3">
                <?php if (!AuthHelper::isLoggedIn()): ?>
                    <a href="cadastro.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-user-plus"></i>
                        Criar Conta Grátis
                    </a>
                    <a href="login.php" class="btn btn-outline btn-lg">
                        <i class="fas fa-sign-in-alt"></i>
                        Já tenho conta
                    </a>
                <?php else: ?>
                    <a href="agendar.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-calendar-plus"></i>
                        Agendar Agora
                    </a>
                    <a href="meus-agendamentos.php" class="btn btn-outline btn-lg">
                        <i class="fas fa-calendar-alt"></i>
                        Meus Agendamentos
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section> 