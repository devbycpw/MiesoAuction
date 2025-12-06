<?php

require_once "../app/Models/Bid.php";

class BidController extends Controller
{
    private $bid;

    public function __construct()
    {
        parent::__construct();
        Auth::redirectClient(); 
        $this->bid = new Bid();
    }

    // ---------------------------------------------------------
    // LIST SEMUA BID
    // ---------------------------------------------------------
    public function index()
    {
        $data['bids'] = $this->bid->all();
        $this->view("bids/index", $data);
    }

    // ---------------------------------------------------------
    // FORM CREATE
    // ---------------------------------------------------------
    public function create()
    {
        $this->view("bids/create");
    }

    // ---------------------------------------------------------
    // STORE BID BARU
    // ---------------------------------------------------------
    public function store()
    {
        if (!isset($_POST['auction_id'], $_POST['bid_amount'])) {
            die("Data tidak lengkap");
        }

        $data = [
            'auction_id' => $_POST['auction_id'],
            'user_id' => Auth::user(), 
            'bid_amount' => $_POST['bid_amount']
        ];

        $this->bid->create($data);

        header("Location: /bids");
        exit;
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
        $data['bids'] = $this->bid->findByAuction($auction_id);
        $this->view("bids/by_auction", $data);
    }

    // ---------------------------------------------------------
    // GET HIGHEST BID DARI LELANG
    // ---------------------------------------------------------
    public function highestBid($auction_id)
    {
        $data['highest'] = $this->bid->findHighestBid($auction_id);
        $this->view("bids/highest_bid", $data);
    }
}
