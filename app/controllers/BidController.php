<?php

require_once "../app/Models/Bid.php";
require_once "../app/Models/Auction.php";

class BidController extends Controller
{
    private $bid;
    private $auction;

    public function __construct()
    {
        parent::__construct();
        Auth::redirectClient(); 
        $this->bid = new Bid();
        $this->auction = new Auction();
    }

    // ---------------------------------------------------------
    // LIST SEMUA BID
    // ---------------------------------------------------------
    public function index()
    {
        $userId = Auth::user("id");
        $history = $this->bid->getUserBidHistory($userId);
        $this->view("bids/index",[
            "history" => $history,
            "title" => "My Bids",
            "layout" => "Main"
        ]);
    }

    // ---------------------------------------------------------
    // FORM CREATE
    // ---------------------------------------------------------
    public function create()
    {
        $this->view("bids/create");
    }


    // ---------------------------------------------------------
    // DETAIL BID (DENGAN RELASI)
    // ---------------------------------------------------------
    public function show($id)
    {
        $data['bid'] = $this->bid->getWithRelations($id);

        if (!$data['bid']) {
            die("Bid tidak ditemukan");
        }

        $this->view("bids/show", $data);
    }

    // ---------------------------------------------------------
    // FORM EDIT
    // ---------------------------------------------------------
    public function edit($id)
    {
        $data['bid'] = $this->bid->findById($id);

        if (!$data['bid']) {
            die("Bid tidak ditemukan");
        }

        $this->view("bids/edit", $data);
    }

    // ---------------------------------------------------------
    // UPDATE BID (HANYA MENGUBAH NOMINAL)
    // ---------------------------------------------------------
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

    // ---------------------------------------------------------
    // DELETE BID
    // ---------------------------------------------------------
    public function destroy($id)
    {
        $this->bid->delete($id);

        header("Location: /bids");
        exit;
    }

    // ---------------------------------------------------------
    // GET BID BERDASARKAN AUCTION
    // ---------------------------------------------------------
    public function byAuction($auction_id)
    {
        $bids = $this->bid->findByAuction($auction_id);

        $this->view("bids/by_auction", [
            "bids" => $bids
        ]);
    }

    // ---------------------------------------------------------
    // GET HIGHEST BID DARI LELANG
    // ---------------------------------------------------------
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

        // Ambil harga terbaru
        $currentPrice = $this->bid->getCurrentPrice($auctionId);

        if ($bidAmount <= $currentPrice) {
            Session::set("error", "Bid must be higher than current price!");
            header("Location: " . BASE_URL . "auction/show/$auctionId");
            exit;
        }

        // Simpan bid + update final_price
        $this->bid->placeBid($auctionId, $userId, $bidAmount);

        Session::set("success", "Bid placed successfully!");
        header("Location: " . BASE_URL . "auction/show/$auctionId");
        exit;
    }





}
