<?php

require_once "../app/Models/Auction.php";
require_once "../app/helpers/Upload.php";

class AuctionController extends Controller
{
    private $auction;

    public function __construct()
    {
        parent::__construct();
        $this->auction = new Auction();
    }

    // GET /auctions
    public function index()
    {
        $data = $this->auction->all();
        foreach ($data as &$a) {
            $a['current_price'] = $this->auction->getCurrentPrice($a['id']);
        }

        $this->view("Auction/index", [
            "auctions" => $data,
            "title" => "Auction",
            "layout" => "Main",
            "custom_js" => "auction"
        ]);
    }

    public function updateFinalPrice($auctionId, $price) {
        $sql = "UPDATE auctions SET final_price = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$price, $auctionId]);
    }




    // GET /auction/show/{id}
    public function show($id)
    {
        $auction = $this->auction->getWithRelations($id);
        if (!$auction) {
            http_response_code(404);
            die("Auction not found.");
        }

        $this->view("Auction/show", [
            "auction" => $auction,
            "title" => "Auction",
            "layout" => "Main"
        ]);
    }

    // GET /auction/create
    public function createForm()
    {
        $categories = $this->model("Category");
        $data_categories = $categories->all();
        $this->view("Auction/create",[
            "categories" => $data_categories,
            "custom_js"  => "auctionCreate"
        ]);
    }

    // POST /auction/store
    public function store()
    {
        // Validasi minimal
        if (empty($_POST['title']) || empty($_POST['starting_price'])) {
            http_response_code(400);
            die("Title & Starting Price wajib diisi.");
        }

        $userId = Session::get("user_id");

        // Upload gambar menggunakan helper
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

    // GET /auction/edit/{id}
    public function editForm($id)
{
    // Ambil data auction berdasarkan ID
    $auction = $this->auction->findById($id);
    if (!$auction) {
        http_response_code(404);
        die("Auction not found.");
    }

    // Ambil semua kategori
    $categories = $this->model("Category")->all();

    // Kirim ke view
    $this->view("Auction/edit", [
        "auction" => $auction,
        "categories" => $categories
    ]);
}


    // POST /auction/update/{id}
    public function update($id)
    {
        $auction = $this->auction->findById($id);
        if (!$auction) {
            http_response_code(404);
            die("Auction not found.");
        }

        $data = [];

        // Ambil semua input yang bukan kosong
        foreach ($_POST as $key => $value) {
            if (!empty($value)) {
                $data[$key] = $value;
            }
        }

        // Jika ada upload gambar baru
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

    // GET /auction/delete/{id}
    public function delete($id)
    {
        $auction = $this->auction->findById($id);
        if (!$auction) {
            http_response_code(404);
            die("Auction not found.");
        }

        $this->auction->delete($id);

        header("Location:".BASE_URL."auctions");
        exit;
    }
}
