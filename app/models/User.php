<?php
// app/Models/User.php (Modifikasi)
// ... (Bagian atas kelas)
class User {
    private $db;

    public function __construct() {
        // Memuat helper DB jika belum
        require_once "../app/Core/DbConnection.php"; 
        $this->db = DbConnection::connect();
    }

    public function create(array $data) {
        // Hashing password sebelum disimpan
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $role = 'client'; // Default role
        $currentTime = date('Y-m-d H:i:s');

        $sql = "INSERT INTO users 
                (full_name, email, password, role, created_at, updated_at) 
                VALUES (:name, :email, :password, :role, :created_at, :updated_at)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => $hashedPassword,
            ':role' => $role,
            ':created_at' => $currentTime,
            ':updated_at' => $currentTime
        ]);
    }
    
    
    public function all() {
        return $this->db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Mencari pengguna berdasarkan email
     * @param string $email
     * @return array|false
     */
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}