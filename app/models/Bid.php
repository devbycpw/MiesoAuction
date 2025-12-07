<?php

class Bid {
    private $db;

    public function __construct() {
        require_once "../app/Core/DbConnection.php";
        $this->db = DbConnection::connect();
    }

    public function create(array $data) {
        $sql = "INSERT INTO bids (auction_id, user_id, bid_amount, created_at) VALUES (:auction_id, :user_id, :bid_amount, :created_at)";

        $stmt = $this->db->prepare($sql);         

        return $stmt->execute([
            ':auction_id' => $data['auction_id'],
            ':user_id' => $data['user_id'],
            ':bid_amount' => $data['bid_amount'],
            ':created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function all() {
        return $this->db->query("SELECT * FROM bids ORDER BY created_at DESC")
                        ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM bids WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByAuction($auction_id) {
        $stmt = $this->db->prepare("SELECT * FROM bids WHERE auction_id = :auction_id ORDER BY bid_amount DESC");
        $stmt->execute([':auction_id' => $auction_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findHighestBid($auction_id) {
        $stmt = $this->db->prepare("SELECT * FROM bids WHERE auction_id = :auction_id ORDER BY bid_amount DESC LIMIT 1");
        $stmt->execute([':auction_id' => $auction_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, array $data) {
        $fields = [];
        $params = [':id' => $id];
        if (isset($data['bid_amount'])) {
            $fields[] = "bid_amount = :bid_amount";
            $params[':bid_amount'] = $data['bid_amount'];
        }

        if (empty($fields)) return false;
        $sql = "UPDATE bids SET " . implode(", ", $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM bids WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getWithRelations($id) {
        $sql = "
            SELECT 
                b.*,
                u.full_name AS bidder_name,
                u.email AS bidder_email,
                a.title AS auction_title,
                a.starting_price AS auction_start_price
            FROM bids b
            LEFT JOIN users u ON b.user_id = u.id
            LEFT JOIN auctions a ON b.auction_id = a.id
            WHERE b.id = :id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCurrentPrice($auctionId)
{
    $stmt = $this->db->prepare("SELECT MAX(bid_amount) FROM bids WHERE auction_id = ?");
    $stmt->execute([$auctionId]);
    $highest = $stmt->fetchColumn();

    if ($highest !== null) {
        return $highest;
    }

    // fallback → starting price
    $stmt2 = $this->db->prepare("SELECT starting_price FROM auctions WHERE id = ?");
    $stmt2->execute([$auctionId]);
    return $stmt2->fetchColumn();
}
    
    public function placeBid($auctionId, $userId, $bidAmount)
    {
        // Insert bid
        $sql = "INSERT INTO bids (auction_id, user_id, bid_amount, created_at)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$auctionId, $userId, $bidAmount, date('Y-m-d H:i:s')]);

        // Update auction.final_price
        $sql2 = "UPDATE auctions SET final_price = ? WHERE id = ?";
        $stmt2 = $this->db->prepare($sql2);
        $stmt2->execute([$bidAmount, $auctionId]);

        return true;
    }
    
    public function getHighestBid($auctionId)
    {
        $sql = "
            SELECT user_id, amount
            FROM bids
            WHERE auction_id = :auction_id
            ORDER BY amount DESC, created_at ASC
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':auction_id' => $auctionId]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



}
