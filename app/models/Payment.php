<?php
class Payment {
    private $db;

    public function __construct() {
        require_once "../app/Core/DbConnection.php";
        $this->db = DbConnection::connect();
    }

    public function create(array $data) {
        $now = date("Y-m-d H:i:s");

        $sql = "INSERT INTO payments 
                (auction_id, user_id, amount, payment_proof, status, created_at, updated_at)
                VALUES 
                (:auction_id, :user_id, :amount, :payment_proof, :status, :created_at, :updated_at)";

        $stmt = $this->db->prepare($sql);

        $ok = $stmt->execute([
            ":auction_id"     => $data["auction_id"],
            ":user_id"        => $data["user_id"],
            ":amount"         => $data["amount"],
            ":payment_proof"  => $data["payment_proof"],
            ":status"         => $data["status"] ?? "pending",
            ":created_at"     => $now,
            ":updated_at"     => $now
        ]);

        return $ok ? $this->db->lastInsertId() : false;
    }

    public function update($id, array $data) {
        $fields = [];
        $params = [":id" => $id];
        $allowed = ["amount", "payment_proof", "status", "payment_method", "admin_note"];

        foreach ($allowed as $field) {
            if (array_key_exists($field, $data)) {
                $fields[] = "$field = :$field";
                $params[":$field"] = $data[$field];
            }
        }

        $fields[] = "updated_at = :updated_at";
        $params[":updated_at"] = date("Y-m-d H:i:s");

        if (empty($fields)) return false;

        $sql = "UPDATE payments SET " . implode(", ", $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }

    public function getPaymentByAuctionAndUser($auctionId, $userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM payments WHERE auction_id = ? AND user_id = ?");
        $stmt->execute([$auctionId, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function all()
    {
        $sql = "
            SELECT 
                p.*, 
                a.title AS auction_title,
                u.full_name AS user_name,
                u.email AS user_email
            FROM payments p
            JOIN auctions a ON p.auction_id = a.id
            JOIN users u ON p.user_id = u.id
            ORDER BY p.created_at ASC
        ";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function getPendingPayments()
    {
        $sql = "
            SELECT 
                p.*, 
                a.title AS auction_title,
                u.full_name AS user_name,
                u.email AS user_email
            FROM payments p
            JOIN auctions a ON p.auction_id = a.id
            JOIN users u ON p.user_id = u.id
            WHERE p.status = 'pending'
            ORDER BY p.created_at ASC
        ";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getApprovedPayments()
    {
        $sql = "
            SELECT 
                p.*, 
                a.title AS auction_title,
                u.full_name AS user_name,
                u.email AS user_email
            FROM payments p
            JOIN auctions a ON p.auction_id = a.id
            JOIN users u ON p.user_id = u.id
            WHERE p.status = 'verified'
            ORDER BY p.created_at ASC
        ";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRejectedPayments()
    {
        $sql = "
            SELECT 
                p.*, 
                a.title AS auction_title,
                u.full_name AS user_name,
                u.email AS user_email
            FROM payments p
            JOIN auctions a ON p.auction_id = a.id
            JOIN users u ON p.user_id = u.id
            WHERE p.status = 'rejected'
            ORDER BY p.created_at ASC
        ";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function changeStatus($payment_id, $status){
        $query = "UPDATE payments SET status = :status, updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $payment_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
