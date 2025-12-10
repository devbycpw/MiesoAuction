<?php

require "../app/helpers/Upload.php";
require_once "../app/Models/Auction.php";
require_once "../app/Models/Bid.php";

class AuctionController extends Controller
{
    private $auction;
    private $bid;

    public function __construct()
    {
        parent::__construct();
        $this->auction = new Auction();
        $this->bid = new Bid();
    }


public function index()
{
    $this->autoCloseAuctions();

    $categories = []; 

    if (Auth::isAdmin()) {
        $data = $this->auction->all();
    } else {
        $categories = isset($_GET['category']) ? $_GET['category'] : [];
        $data = $this->auction->getActiveAuctions($categories);
    }

    foreach ($data as &$a) {
        $a['current_price'] = $this->bid->getCurrentPrice($a['id']);
    }
    $allCategories = $this->model("Category")->all();
    $this->view("Auction/index", [
        "auctions" 	 => $data,
        "categories" 	 => $allCategories, 	
        "selected" 	 => $categories, 
        "title" 	 => "Auction",
        "custom_css" => "AuctionsList",
        "layout" 	 => "Main",
        "custom_js" 	 => "auction"
    ]);
}

public function show($id)
    {
        $auction = $this->auction->getWithRelations($id);

        if (!$auction) {
            http_response_code(404);
            die("Auction not found.");
        }
        $auction['current_price'] = $this->bid->getCurrentPrice($id);
        $this->view("Auction/show", [
            "auction" => $auction,
            "title"   => "Auction",
            "layout"  => "Main",
            "custom_js" => "auctionShow",
            "custom_css" => "auction-show"
        ]);
    }
    public function createForm()
    {
        $categories = $this->model("Category");
        $data_categories = $categories->all();
        $this->view("Auction/create",[
            "categories" => $data_categories,
            "custom_js"  => "auctionCreate"
        ]);
    }
    public function store()
    {
        if (empty($_POST['title']) || empty($_POST['starting_price'])) {
            http_response_code(400);
            die("Title & Starting Price wajib diisi.");
        }

        $userId = Session::get("user_id");
        $imageName = Upload::save($_FILES['image'], "auction_images");
        $data = [
            "user_id" => $userId,
            "category_id" => $_POST["category_id"] ?? null,
            "title" => $_POST["title"],
            "description" => $_POST["description"] ?? null,
            "image" => $imageName,
            "starting_price" => $_POST["starting_price"],
            "estimated_value" => $_POST["estimated_value"] ?? null,
            "status" => "pending",
            "start_time" => $_POST["start_time"] ?? null,
            "end_time" => $_POST["end_time"] ?? null,
            "seller_note" => $_POST["seller_note"] ?? null
        ];

        $this->auction->create($data);
        header("Location:". BASE_URL ."auctions");
        exit;
    }

    public function editForm($id)
{
    $auction = $this->auction->findById($id);
    if (!$auction) {
        http_response_code(404);
        die("Auction not found.");
    }
    $categories = $this->model("Category")->all();
    $this->view("Auction/edit", [
        "auction" => $auction,
        "categories" => $categories
    ]);
}

    public function update($id)
    {
        $auction = $this->auction->findById($id);
        if (!$auction) {
            http_response_code(404);
            die("Auction not found.");
        }
        $data = [];
        foreach ($_POST as $key => $value) {
            if (!empty($value)) {
                $data[$key] = $value;
            }
        }
        if (!empty($_FILES['image']['name'])) {
            $imageName = Upload::save($_FILES['image'], "auction_images");

            if ($imageName) {
                $data["image"] = $imageName;
            }
        }

        $this->auction->update($id, $data);

        header("Location: ".BASE_URL."auction/show/$id");
        exit;
    }

    public function delete($id)
    {
        $auction = $this->auction->findById($id);
        $this->auction->delete($id);
        header("Location:".BASE_URL."auctions");
        exit;
    }

    public function autoCloseAuctions()
    {
        $expiredAuctions = $this->auction->getExpiredActiveAuctions();
        foreach ($expiredAuctions as $auction) {

            $highestBid = $this->bid->getHighestBid($auction['id']);

            if ($highestBid) {
                $winnerId   = $highestBid['user_id'];
                $finalPrice = $highestBid['bid_amount'];
                $status     = "closed";

            } else {
                $winnerId   = null;
                $finalPrice = $auction['starting_price']; 
                $status     = "closed";
            }

            $this->auction->closeAuction(
                $auction['id'],
                $winnerId,
                $finalPrice,
                $status
            );
        }

    }

    
}
