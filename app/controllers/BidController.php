<?php

require_once "../app/Models/Bid.php";
require_once "../app/Models/Auction.php";
require_once "../app/Models/Payment.php";

class BidController extends Controller
{
    private $bid;
    private $auction;
    private $payment;

    public function __construct()
    {
        parent::__construct();
        Auth::redirectClient();
        $this->bid = new Bid();
        $this->auction = new Auction();
        $this->payment = new Payment();
    }

    public function index()
    {
        $userId = Auth::user("id");
        $user = $this->model("User")->findById($userId) ?? [];
        $history = $this->bid->getUserBidHistory($userId);
        $winningHistory = array_values(array_filter($history, function ($row) {
            return !empty($row["is_winner"]);
        }));

        $stats = [
            "totalSpend"   => 0,
            "itemsWon"     => 0,
            "paidSum"      => 0,
            "waitingSum"   => 0,
            "paidCount"    => 0,
            "waitingCount" => 0,
            "allCount"     => count($winningHistory)
        ];

        foreach ($winningHistory as $row) {
            $price = $row["final_price"] ?? $row["highest_bid"] ?? $row["bid_amount"] ?? 0;

            $stats["itemsWon"]++;
            $stats["totalSpend"] += $price;

            if (($row["payment_status"] ?? null) === "verified") {
                $stats["paidSum"] += $price;
                $stats["paidCount"]++;
            } else {
                $stats["waitingSum"] += $price;
                $stats["waitingCount"]++;
            }
        }

        $this->view("bids/index",[
            "history" => $winningHistory,
            "user" => $user,
            "title" => "My Bids",
            "layout" => "Main",
            "custom_css" => "mybids",
            "stats" => $stats
        ]);
    }

    public function transaction($auctionId)
    {
        Auth::redirectClient();
        $userId = Auth::user("id");

        $auction = $this->auction->getWithRelations($auctionId);
        if (!$auction) {
            http_response_code(404);
            die("Auction not found");
        }

        $history = $this->bid->getUserBidHistory($userId);
        $item = null;
        foreach ($history as $row) {
            if ((int)$row["auction_id"] === (int)$auctionId) {
                $item = $row;
                break;
            }
        }

        if (!$item) {
            http_response_code(403);
            die("You are not allowed to view this transaction");
        }

        $payment = $this->payment->getPaymentByAuctionAndUser($auctionId, $userId);
        $status = $payment["status"] ?? "unpaid";

        $this->view("bids/transaction", [
            "title" => "Transaction Detail",
            "layout" => "Main",
            "custom_css" => "transaction",
            "auction" => $auction,
            "item" => $item,
            "payment" => $payment,
            "status" => $status
        ]);
    }

    public function create()
    {
        $this->view("bids/create");
    }


    public function show($id)
    {
        $data['bid'] = $this->bid->getWithRelations($id);

        if (!$data['bid']) {
            die("Bid tidak ditemukan");
        }

        $this->view("bids/show", $data);
    }

    public function edit($id)
    {
        $data['bid'] = $this->bid->findById($id);

        if (!$data['bid']) {
            die("Bid tidak ditemukan");
        }

        $this->view("bids/edit", $data);
    }

    public function update($id)
    {
        if (!isset($_POST['bid_amount'])) {
            die("Nominal bid tidak boleh kosong");
        }

        $this->bid->update($id, [
            'bid_amount' => $_POST['bid_amount']
        ]);

        header("Location: /bids");
        exit;
    }

    public function destroy($id)
    {
        $this->bid->delete($id);

        header("Location: /bids");
        exit;
    }

    public function byAuction($auction_id)
    {
        $bids = $this->bid->findByAuction($auction_id);

        $this->view("bids/by_auction", [
            "bids" => $bids
        ]);
    }

    public function highestBid($auction_id)
    {
        $highest = $this->bid->findHighestBid($auction_id);

        $this->view("bids/highest_bid", [
            "highest" => $highest
        ]);
    }
    
    public function placeBid()
    {
        $auctionId = $_POST['auction_id'];
        $bidAmount = $_POST['bid_amount'];
        $userId    = Auth::user('id');

        $currentPrice = $this->bid->getCurrentPrice($auctionId);

        if ($bidAmount <= $currentPrice) {
            Session::set("error", "Bid must be higher than current price!");
            header("Location: " . BASE_URL . "auction/show/$auctionId");
            exit;
        }

        $this->bid->placeBid($auctionId, $userId, $bidAmount);

        Session::set("success", "Bid placed successfully!");
        header("Location: " . BASE_URL . "auction/show/$auctionId");
        exit;
    }





}
