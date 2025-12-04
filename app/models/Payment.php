<?php
class Payment {
    private $db;

    public function __construct() {
        require_once "../app/Core/DbConnection.php";
        $this->db = DbConnection::connect();
    }

    public function create(array $data) {
        $sql = "INSERT INTO payments (
                    auction_id, user_id, amount, payment_method, 
                    payment_proof, status, admin_note, created_at, updated_at
                ) VALUES (
                    :auction_id, :user_id, :amount, :payment_method,
                    :payment_proof, :status, :admin_note, :created_at, :updated_at
                )";

        $stmt = $this->db->prepare($sql);

        $now = date('Y-m-d H:i:s');

        return $stmt->execute([
            ':auction_id' => $data['auction_id'],
            ':user_id' => $data['user_id'],
            ':amount' => $data['amount'],
            ':payment_method' => $data['payment_method'],
            ':payment_proof' => $data['payment_proof'] ?? null,
            ':status' => $data['status'] ?? 'pending',
            ':admin_note' => $data['admin_note'] ?? null,
            ':created_at' => $now,
            ':updated_at' => $now
        ]);
    }

    public function all() {
        return $this->db->query("SELECT * FROM payments ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM payments WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByAuction($auction_id) {
        $stmt = $this->db->prepare("SELECT * FROM payments WHERE auction_id = :auction_id");
        $stmt->execute([':auction_id' => $auction_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByUser($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM payments WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, array $data) {
        $fields = [];
        $params = [':id' => $id];
        $allowed = ['amount', 'payment_method', 'payment_proof', 'status', 'admin_note'];

        foreach ($allowed as $field) {
            if (isset($data[$field])) {
                $fields[] = "$field = :$field";$params[":$field"] = $data[$field];
            }
        }

        $fields[] = "updated_at = :updated_at";
        $params[':updated_at'] = date('Y-m-d H:i:s');

        if (empty($fields)) return false;
        $sql = "UPDATE payments SET " . implode(", ", $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute($params);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM payments WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getWithRelations($id) {
        $sql = "
            SELECT 
                p.*,
                u.full_name AS payer_name,
                u.email AS payer_email,
                a.title AS auction_title,
                a.final_price AS auction_final_price
            FROM payments p
            LEFT JOIN users u ON p.user_id = u.id
            LEFT JOIN auctions a ON p.auction_id = a.id
            WHERE p.id = :id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
