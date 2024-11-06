<?php
require_once ROOT_PATH . '/config/Database.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = ? AND ativo = 1");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados) {
        $sql = "INSERT INTO usuarios (nome, email, senha, nivel_acesso) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $dados['nome'],
            $dados['email'],
            password_hash($dados['senha'], PASSWORD_DEFAULT),
            $dados['nivel_acesso']
        ]);
    }
} 