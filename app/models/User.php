<?php
// app/Models/User.php (Modifikasi)
class User {
    private $db;

    public function __construct() {
        require_once "../app/Core/DbConnection.php"; 
        $this->db = DbConnection::connect();
    }

    public function create(array $data) {
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $role = 'client';
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

    public function update($id, array $data) {
        $fields = [];
        $params = [':id' => $id];

        if (!empty($data['name'])) {
            $fields[] = "full_name = :name";
            $params[':name'] = $data['name'];
        }

        if (!empty($data['email'])) {
            $fields[] = "email = :email";
            $params[':email'] = $data['email'];
        }

        if (!empty($data['password'])) {
            $fields[] = "password = :password";
            $params[':password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        if (!empty($data['role'])) {
            $fields[] = "role = :role";
            $params[':role'] = $data['role'];
        }

        $fields[] = "updated_at = :updated_at";
        $params[':updated_at'] = date('Y-m-d H:i:s');

        if (empty($fields)) {
            return false;
        }

        $sql = "UPDATE users SET " . implode(", ", $fields) . " WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function all() {
        return $this->db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // cek apakah password lama cocok
    public function checkOldPassword($id, $oldPassword)
    {
        $user = $this->findById($id);

        if (!$user) {
            return false;
        }

        return password_verify($oldPassword, $user['password']);
    }

    // update password baru
    public function updatePassword($id, $newPassword)
    {
        $hash = password_hash($newPassword, PASSWORD_BCRYPT);

        $query = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
        return $query->execute([$hash, $id]);
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

public function createAdmin(array $data) {
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    $role = 'admin';
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


}
