<?php
// app/Models/Transaction.php

class Transaction {
    private $db;

    public function __construct() {
        require_once "../app/Core/DbConnection.php";
        $this->db = DbConnection::connect();
    }

    /**
     * Create Transaction
     */
    public function create(array $data) {
        $sql = "INSERT INTO transactions (payment_id, auction_id, buyer_id, seller_id, total_amount, created_at) VALUES (:payment_id, :auction_id, :buyer_id, :seller_id, :total_amount, :created_at)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':payment_id' => $data['payment_id'],
            ':auction_id' => $data['auction_id'],
            ':buyer_id' => $data['buyer_id'],
            ':seller_id' => $data['seller_id'],
            ':total_amount'=> $data['total_amount'],
            ':created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function all() {
        return $this->db->query("SELECT * FROM transactions ORDER BY created_at DESC")
                        ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByAuction($auction_id) {
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE auction_id = :auction_id");
        $stmt->execute([':auction_id' => $auction_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByBuyer($buyer_id) {
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE buyer_id = :buyer_id");
        $stmt->execute([':buyer_id' => $buyer_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findBySeller($seller_id) {
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE seller_id = :seller_id");
        $stmt->execute([':seller_id' => $seller_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, array $data) {
        $fields = [];
        $params = [':id' => $id];

        $allowed = ['payment_id', 'auction_id', 'buyer_id', 'seller_id', 'total_amount'];

        foreach ($allowed as $field) {
            if (isset($data[$field])) {
                $fields[] = "$field = :$field";
                $params[":$field"] = $data[$field];
            }
        }

        if (empty($fields)) return false;

        $sql = "UPDATE transactions SET " . implode(", ", $fields) . " WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM transactions WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getWithRelations($id) {
        $sql = "
            SELECT 
                t.*,

                p.amount AS payment_amount,
                p.payment_method AS payment_method,
                p.status AS payment_status,
                a.title AS auction_title,
                a.final_price AS auction_final_price,
                ub.full_name AS buyer_name,
                ub.email AS buyer_email,
                us.full_name AS seller_name,
                us.email AS seller_email
            FROM transactions t
            LEFT JOIN payments p ON t.payment_id = p.id
            LEFT JOIN auctions a ON t.auction_id = a.id
            LEFT JOIN users ub ON t.buyer_id = ub.id
            LEFT JOIN users us ON t.seller_id = us.id
            WHERE t.id = :id
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
