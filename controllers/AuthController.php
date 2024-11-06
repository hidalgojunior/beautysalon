<?php
require_once ROOT_PATH . '/models/Usuario.php';

class AuthController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function login($email, $senha) {
        if (empty($email) || empty($senha)) {
            return [
                'success' => false,
                'message' => 'Preencha todos os campos'
            ];
        }

        $usuario = $this->usuarioModel->getByEmail($email);
        
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_nome'] = $usuario['nome'];
            $_SESSION['user_nivel'] = $usuario['nivel_acesso'];
            
            return [
                'success' => true,
                'message' => 'Login realizado com sucesso'
            ];
        }

        return [
            'success' => false,
            'message' => 'Email ou senha inválidos'
        ];
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . '/login.php');
        exit;
    }

    public function verificaAutenticacao() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/login.php');
            exit;
        }
    }
} 