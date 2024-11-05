// Módulo principal
const App = {
    init() {
        this.initNavigation();
        this.initScrollEffects();
        this.initContactForm();
    },

    initNavigation() {
        // Menu mobile
        const menuToggle = document.querySelector('.menu-toggle');
        const nav = document.querySelector('.nav-links');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                nav.classList.toggle('active');
                menuToggle.classList.toggle('active');
            });
        }

        // Scroll suave
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                    nav.classList.remove('active');
                    menuToggle.classList.remove('active');
                }
            });
        });
    },

    initScrollEffects() {
        // Animação ao scroll
        const elements = document.querySelectorAll('.animate-on-scroll');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        });

        elements.forEach(element => observer.observe(element));
    },

    initContactForm() {
        const form = document.querySelector('.contact-form');
        
        if (form) {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const formData = new FormData(form);
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                
                try {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Enviando...';
                    
                    const response = await fetch('actions/contact.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        form.reset();
                        alert('Mensagem enviada com sucesso!');
                    } else {
                        throw new Error(data.message);
                    }
                } catch (error) {
                    alert(error.message || 'Erro ao enviar mensagem. Tente novamente.');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
            });
        }
    }
};

// Inicializar quando o documento estiver pronto
document.addEventListener('DOMContentLoaded', () => {
    App.init();
}); 