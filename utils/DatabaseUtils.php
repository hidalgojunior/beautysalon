<?php
class DatabaseUtils {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function beginTransaction() {
        return $this->db->beginTransaction();
    }

    public function commit() {
        return $this->db->commit();
    }

    public function rollback() {
        return $this->db->rollback();
    }

    public function lastInsertId() {
        return $this->db->lastInsertId();
    }
} 