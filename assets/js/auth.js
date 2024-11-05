document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM carregado, configurando listeners...');
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        console.log('Formulário de login encontrado');
        loginForm.addEventListener('submit', handleLogin);
    } else {
        console.error('Formulário de login não encontrado');
    }

    // Toggle Password Visibility
    const toggleButtons = document.querySelectorAll('.toggle-password');
    toggleButtons.forEach(button => {
        button.addEventListener('click', togglePasswordVisibility);
    });
});

async function handleLogin(e) {
    e.preventDefault();

    // Remove alertas anteriores
    removeAlerts();

    const form = e.target;
    const formData = new FormData(form);

    try {
        const response = await fetch('controllers/AuthController.php', {
            method: 'POST',
            body: formData
        });

        let data;
        const responseText = await response.text();
        
        try {
            // Remove qualquer HTML/texto antes do JSON
            const jsonString = responseText.substring(responseText.indexOf('{'));
            data = JSON.parse(jsonString);
        } catch (e) {
            console.error('Erro ao parsear resposta:', responseText);
            showAlert('error', 'Erro ao processar resposta do servidor');
            return;
        }

        if (data.success) {
            showAlert('success', data.message);
            
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 1000);
        } else {
            showAlert('error', data.message || 'Erro ao realizar login');
        }
    } catch (error) {
        console.error('Erro:', error);
        showAlert('error', 'Erro ao processar a requisição');
    }
}

function showAlert(type, message) {
    console.log(`Mostrando alerta: ${type} - ${message}`);
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
        <span>${message}</span>
    `;
    
    const authHeader = document.querySelector('.auth-header');
    if (authHeader) {
        authHeader.insertAdjacentElement('afterend', alertDiv);
    } else {
        console.error('Elemento .auth-header não encontrado');
    }

    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}

function removeAlerts() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => alert.remove());
}

function togglePasswordVisibility(e) {
    const button = e.currentTarget;
    const input = button.parentElement.querySelector('input');
    const icon = button.querySelector('i');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
} 