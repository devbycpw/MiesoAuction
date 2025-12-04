<?php
class User {
    private $db;

    public function __construct() {
        $this->db = DbConnection::connect();
    }

    public function all() {
        return $this->db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }
}
