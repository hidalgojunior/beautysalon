<div class="contact-form-container">
    <!-- Lado Esquerdo - Formulário -->
    <div class="contact-form-wrapper">
        <form id="contactForm" class="contact-form" method="POST">
            <div class="form-header">
                <h3>Envie sua Mensagem</h3>
                <p>Responderemos o mais breve possível</p>
            </div>

            <!-- Nome -->
            <div class="form-group floating-label">
                <input type="text" 
                       id="nome" 
                       name="nome" 
                       class="form-control" 
                       placeholder=" "
                       required>
                <label for="nome">Nome Completo</label>
            </div>

            <!-- Email -->
            <div class="form-group floating-label">
                <input type="email" 
                       id="email" 
                       name="email" 
                       class="form-control" 
                       placeholder=" "
                       required>
                <label for="email">Email</label>
            </div>

            <!-- Assunto -->
            <div class="form-group">
                <select id="assunto" 
                        name="assunto" 
                        class="form-control form-select" 
                        required>
                    <option value="" disabled selected>Selecione o Assunto</option>
                    <option value="duvida">Dúvida</option>
                    <option value="agendamento">Agendamento</option>
                    <option value="sugestao">Sugestão</option>
                    <option value="reclamacao">Reclamação</option>
                    <option value="outro">Outro</option>
                </select>
            </div>

            <!-- Mensagem -->
            <div class="form-group floating-label">
                <textarea id="mensagem" 
                          name="mensagem" 
                          class="form-control" 
                          rows="4" 
                          placeholder=" "
                          required></textarea>
                <label for="mensagem">Sua Mensagem</label>
            </div>

            <!-- Botão Submit -->
            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">
                    <span class="btn-text">Enviar Mensagem</span>
                    <span class="btn-icon">
                        <i class="fas fa-paper-plane"></i>
                    </span>
                </button>
            </div>
        </form>
    </div>

    <!-- Lado Direito - Contato Rápido -->
    <div class="quick-contact">
        <div class="quick-contact-header">
            <h3>Contato Rápido</h3>
            <p>Escolha a melhor forma de falar conosco</p>
        </div>

        <!-- WhatsApp Card -->
        <div class="contact-card whatsapp-card">
            <div class="card-icon">
                <i class="fab fa-whatsapp"></i>
            </div>
            <div class="card-content">
                <h4>WhatsApp</h4>
                <p>Atendimento imediato</p>
                <a href="https://wa.me/5511999999999" 
                   class="btn btn-whatsapp" 
                   target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    Iniciar Conversa
                </a>
            </div>
        </div>

        <!-- Email Card -->
        <div class="contact-card email-card">
            <div class="card-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="card-content">
                <h4>Email</h4>
                <p>Resposta em até 24h</p>
                <a href="mailto:contato@exemplo.com" 
                   class="btn btn-email">
                    <i class="fas fa-envelope"></i>
                    contato@exemplo.com
                </a>
            </div>
        </div>

        <!-- Horário Card -->
        <div class="contact-card schedule-card">
            <div class="card-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="card-content">
                <h4>Horário de Atendimento</h4>
                <ul class="schedule-list">
                    <li>
                        <span>Segunda à Sexta:</span>
                        <span>09h às 20h</span>
                    </li>
                    <li>
                        <span>Sábado:</span>
                        <span>09h às 18h</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> 