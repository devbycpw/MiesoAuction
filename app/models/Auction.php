<?php

class Auction {
    private $db;

    public function __construct() {
        require_once "../app/Core/DbConnection.php";
        $this->db = DbConnection::connect();
    }

    public function create(array $data) {
        $sql = "INSERT INTO auctions 
                (user_id, category_id, title, description, image, starting_price, status, start_time, end_time,  created_at, updated_at)
                VALUES (:user_id, :category_id, :title, :description, :image, :starting_price,  :status, :start_time, :end_time, :created_at, :updated_at)";

        $stmt = $this->db->prepare($sql);

        $currentTime = date('Y-m-d H:i:s');

        return $stmt->execute([
            ':user_id' => $data['user_id'],
            ':category_id' => $data['category_id'] ?? null,
            ':title' => $data['title'],
            ':description' => $data['description'] ?? null,
            ':image' => $data['image'] ?? null,
            ':starting_price' => $data['starting_price'],
            ':status' => $data['status'] ?? 'pending',
            ':start_time' => $data['start_time'] ?? null,
            ':end_time' => $data['end_time'] ?? null,
            ':created_at' => $currentTime,
            ':updated_at' => $currentTime
        ]);
    }

    public function all() {
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
            LEFT JOIN users w ON a.winner_id = w.id ORDER BY a.id DESC
            ";
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

    public function updateFinalPrice($auctionId, $finalPrice)
    {
        $sql = "UPDATE auctions SET final_price = :final_price, updated_at = :updated_at WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':final_price' => $finalPrice,
            ':updated_at' => date('Y-m-d H:i:s'),
            ':id' => $auctionId
        ]);
    }

    public function getActiveAuctions($categories = [])
    {
        if (empty($categories)) {
            // tidak ada filter → tampil semua active
            $sql = "
                SELECT a.*, c.name AS category_name 
                FROM auctions a 
                LEFT JOIN categories c ON c.id = a.category_id
                WHERE a.status = 'active'
                ORDER BY a.id DESC
            ";
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }

        // Jika ada kategori dipilih
        $placeholders = implode(',', array_fill(0, count($categories), '?'));

        $sql = "
            SELECT a.*, c.name AS category_name
            FROM auctions a
            LEFT JOIN categories c ON c.id = a.category_id
            WHERE a.status = 'active'
            AND a.category_id IN ($placeholders)
            ORDER BY a.id DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($categories);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function changeStatus($auction_id, $status)
    {
        $query = "UPDATE auctions SET status = :status, updated_at = NOW() WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        
        // Bind parameter
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $auction_id, PDO::PARAM_INT);
        
        // Execute dan kembalikan status keberhasilan
        return $stmt->execute();
    }
    public function getExpiredActiveAuctions()
    {
        $sql = "
            SELECT id, starting_price, end_time
            FROM auctions
            WHERE status = 'active'
            AND end_time < NOW()
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function closeAuction($auctionId, $winnerId, $finalPrice, $status = 'closed')
{
    $sql = "
        UPDATE auctions
        SET 
            status = :status,
            winner_id = :winner_id,
            final_price = :final_price,
            updated_at = NOW()
        WHERE id = :id
    ";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ':status' => $status,
        ':winner_id' => $winnerId,
        ':final_price' => $finalPrice,
        ':id' => $auctionId
    ]);
}
public function setStatusSold($auctionId)
    {
        $query = "UPDATE auctions SET status = 'sold', updated_at = NOW() WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        
        // Bind parameter
        $stmt->bindParam(':id', $auctionId, PDO::PARAM_INT);
        
        // Execute dan kembalikan status keberhasilan
        return $stmt->execute();
    }

    public function selectByIdClient(){
        $sql="SELECT 
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
            WHERE u.id = :id";
    }
    
}
