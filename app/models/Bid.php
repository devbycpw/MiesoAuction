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

    $stmt2 = $this->db->prepare("SELECT starting_price FROM auctions WHERE id = ?");
    $stmt2->execute([$auctionId]);
    return $stmt2->fetchColumn();
}
    
    public function placeBid($auctionId, $userId, $bidAmount)
    {
        $sql = "INSERT INTO bids (auction_id, user_id, bid_amount, created_at)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$auctionId, $userId, $bidAmount, date('Y-m-d H:i:s')]);
        $sql2 = "UPDATE auctions SET final_price = ? WHERE id = ?";
        $stmt2 = $this->db->prepare($sql2);
        $stmt2->execute([$bidAmount, $auctionId]);

        return true;
    }
    
    public function getHighestBid($auctionId)
    {
        $sql = "
            SELECT user_id, bid_amount
            FROM bids
            WHERE auction_id = :auction_id
            ORDER BY bid_amount DESC, created_at ASC
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':auction_id' => $auctionId]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getUserBidHistory($userId)
    {
        $sql = "
            SELECT 
                a.id AS auction_id,
                a.title,
                a.image,
                a.starting_price,
                a.status,
                a.end_time,
                a.winner_id,
                a.final_price,
                b.bid_amount,
                b.created_at AS bid_time,

                (SELECT MAX(b2.bid_amount)
                FROM bids b2
                WHERE b2.auction_id = a.id) AS highest_bid,

                CASE 
                    WHEN a.winner_id = :uid THEN 1
                    ELSE 0
                END AS is_winner,

                p.id AS payment_id,
                p.status AS payment_status

            FROM bids b
            JOIN auctions a ON a.id = b.auction_id
            LEFT JOIN payments p 
                ON p.auction_id = a.id 
                AND p.user_id = :uid

            WHERE b.user_id = :uid
            GROUP BY a.id
            ORDER BY a.end_time DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["uid" => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



}
