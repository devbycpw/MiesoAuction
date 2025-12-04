<?php
// app/Models/Auction.php

class Auction {
    private $db;

    public function __construct() {
        require_once "../app/Core/DbConnection.php";
        $this->db = DbConnection::connect();
    }

    public function create(array $data) {
        $sql = "INSERT INTO auctions 
                (user_id, category_id, title, description, image, starting_price, estimated_value, status, start_time, end_time, seller_note, created_at, updated_at)
                VALUES (:user_id, :category_id, :title, :description, :image, :starting_price, :estimated_value, :status, :start_time, :end_time, :seller_note, :created_at, :updated_at)";

        $stmt = $this->db->prepare($sql);

        $currentTime = date('Y-m-d H:i:s');

        return $stmt->execute([
            ':user_id' => $data['user_id'],
            ':category_id' => $data['category_id'] ?? null,
            ':title' => $data['title'],
            ':description' => $data['description'] ?? null,
            ':image' => $data['image'] ?? null,
            ':starting_price' => $data['starting_price'],
            ':estimated_value' => $data['estimated_value'] ?? null,
            ':status' => $data['status'] ?? 'pending',
            ':start_time' => $data['start_time'] ?? null,
            ':end_time' => $data['end_time'] ?? null,
            ':seller_note' => $data['seller_note'] ?? null,
            ':created_at' => $currentTime,
            ':updated_at' => $currentTime
        ]);
    }

    public function all() {
        $sql = "SELECT * FROM auctions ORDER BY created_at DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM auctions WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, array $data) {
        $fields = [];
        $params = [':id' => $id];

        $allowFields = [
            'category_id', 'title', 'description', 'image', 'starting_price', 'estimated_value', 'final_price', 'status', 'start_time', 'end_time', 'seller_note', 'winner_id'
        ];

        foreach ($allowFields as $field) {
            if (isset($data[$field])) {
                $fields[] = "$field = :$field";
                $params[":$field"] = $data[$field];
            }
        }

        $fields[] = "updated_at = :updated_at";
        $params[':updated_at'] = date('Y-m-d H:i:s');

        if (empty($fields)) return false;

        $sql = "UPDATE auctions SET " . implode(", ", $fields) . " WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM auctions WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Ambil Auction lengkap dengan relasi:
     * - seller (user_id → users)
     * - category (category_id → categories)
     * - winner (winner_id → users)
     */
    public function getWithRelations($id) {
        $sql = "
            SELECT 
                a.*, 
                u.full_name AS seller_name, 
                u.email AS seller_email,
                c.name AS category_name,
                w.full_name AS winner_name,
                w.email AS winner_email
            FROM auctions a
            LEFT JOIN users u ON a.user_id = u.id
            LEFT JOIN categories c ON a.category_id = c.id
            LEFT JOIN users w ON a.winner_id = w.id
            WHERE a.id = :id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
