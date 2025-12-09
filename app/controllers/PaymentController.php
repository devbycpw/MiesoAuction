<?php
require "../app/helpers/Upload.php";
require_once "../app/Models/Auction.php";
require_once "../app/Models/Payment.php";

class PaymentController extends Controller
{
    private $payment;
    private $auction;

    public function __construct()
    {
        parent::__construct();
        $this->payment = new Payment();
        $this->auction = new Auction();
    }

    // ---------------------------------------------------------
    // LIST ALL PAYMENTS
    // ---------------------------------------------------------
    public function index()
    {
        $data['payments'] = $this->payment->all();
        $this->view("payments/index", $data);
    }

    // ---------------------------------------------------------
    // FORM CREATE PAYMENT (USER UPLOAD BUKTI PEMBAYARAN)
    // ---------------------------------------------------------
    public function create()
    {
        $this->view("payments/create");
    }

    // ---------------------------------------------------------
    // STORE PAYMENT
    // ---------------------------------------------------------
    public function store()
{
    // Validasi minimal
    if (empty($_POST['auction_id']) || empty($_POST['amount'])) {
        http_response_code(400);
        die("Auction & Amount wajib diisi.");
    }

    $userId = Auth::user("id");

    // Upload bukti pembayaran menggunakan Upload helper
    $paymentProof = Upload::save($_FILES['payment_proof'], "payment_proof");

    $data = [
        "auction_id"    => $_POST["auction_id"],
        "user_id"       => $userId,
        "amount"        => $_POST["amount"],
        "payment_proof" => $paymentProof,
        "status"        => "pending"
    ];

    $this->payment->create($data);

    header("Location: " . BASE_URL . "myBids");
    exit;
}


    // ---------------------------------------------------------
    // SHOW DETAIL PAYMENT + RELASI
    // ---------------------------------------------------------
    public function show($auctionId)
    {
        $auction = $this->auction->getWithRelations($auctionId);

        if (!$auction) {
            die("Auction tidak ditemukan!");
        }

        if ($auction['winner_id'] != Auth::isClient()) {
            die("Anda tidak berhak membayar auction ini.");
        }

        $data['auction'] = $auction;

        $this->view("payment/show", $data);
    }

    // ---------------------------------------------------------
    // FORM EDIT PAYMENT (ADMIN)
    // ---------------------------------------------------------
    public function edit($id)
    {
        $data['payment'] = $this->payment->findById($id);

        if (!$data['payment']) {
            die("Payment tidak ditemukan!");
        }

        $this->view("payments/edit", $data);
    }

    // ---------------------------------------------------------
    // UPDATE PAYMENT BY ADMIN
    // ---------------------------------------------------------
    public function update($id)
    {
        $updateData = [];

        if (isset($_POST['amount'])) {
            $updateData['amount'] = $_POST['amount'];
        }
        if (isset($_POST['payment_method'])) {
            $updateData['payment_method'] = $_POST['payment_method'];
        }
        if (isset($_POST['status'])) {
            $updateData['status'] = $_POST['status'];
        }
        if (isset($_POST['admin_note'])) {
            $updateData['admin_note'] = $_POST['admin_note'];
        }

        // upload bukti baru (opsional)
        if (isset($_FILES['payment_proof']) && $_FILES['payment_proof']['error'] === 0) {
            $fileName = time() . "_" . $_FILES['payment_proof']['name'];
            $targetDir = "../public/uploads/payment_proof/";
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES['payment_proof']['tmp_name'], $targetFile)) {
                $updateData['payment_proof'] = $fileName;
            }
        }

        $this->payment->update($id, $updateData);

        header("Location: /payments/show/$id");
        exit;
    }

    // ---------------------------------------------------------
    // DELETE PAYMENT
    // ---------------------------------------------------------
    public function destroy($id)
    {
        $this->payment->delete($id);

        header("Location: /payments");
        exit;
    }

    // ---------------------------------------------------------
    // LIST PAYMENT BY AUCTION
    // ---------------------------------------------------------
    public function byAuction($auction_id)
    {
        $data['payments'] = $this->payment->findByAuction($auction_id);
        $this->view("payments/by_auction", $data);
    }

    // ---------------------------------------------------------
    // LIST PAYMENT BY USER
    // ---------------------------------------------------------
    public function byUser($user_id)
    {
        $data['payments'] = $this->payment->findByUser($user_id);
        $this->view("payments/by_user", $data);
    }
    

    public function pay($auctionId)
    {
        $userId  = Auth::user("id");
        $auction = $this->auction->findById($auctionId);

        if (!$auction || $auction['winner_id'] != $userId) {
            die("Unauthorized access.");
        }

        // sudah bayar?
        $existing = $this->payment->getPaymentByAuctionAndUser($auctionId, $userId);
        if ($existing) {
            redirect("my-bids");
        }

        $this->view("payments/form", [
            "auction" => $auction
        ]);
    }

    public function submitPayment($auctionId)
    {
        $userId  = Auth::user("id");
        $auction = $this->auction->findById($auctionId);

        if (!$auction || $auction['winner_id'] != $userId) {
            die("Unauthorized.");
        }

        // handle upload
        $proof = Upload::save($_FILES['payment_proof'], "payment_proof", 10_000_000);
        if (!$proof) {
            $reason = Upload::getLastError() ?: "Only jpg/jpeg/png/webp/heic under 10MB are allowed. Please also ensure PHP upload_max_filesize/post_max_size permit this size.";
            Session::set("error", "Upload failed. " . $reason);
            header("Location: " . BASE_URL . "bids/transaction/$auctionId");
            exit;
        }

        $this->payment->create([
            "auction_id"     => $auctionId,
            "user_id"        => $userId,
            "amount"         => $auction["final_price"],
            "payment_method" => $_POST["payment_method"],
            "payment_proof"  => $proof,
            "status"         => "pending"
        ]);

        redirect("my-bids");
    }

    /**
     * Upload atau reupload bukti pembayaran untuk auction tertentu oleh pemenang.
     */
    public function uploadProof($auctionId)
    {
        Auth::redirectClient();
        $userId = Auth::user("id");

        $auction = $this->auction->findById($auctionId);
        if (!$auction || (int)($auction["winner_id"] ?? 0) !== (int)$userId) {
            http_response_code(403);
            die("Unauthorized.");
        }

        // Fail fast with clearer error if PHP rejected the upload
        if (!isset($_FILES['payment_proof']) || $_FILES['payment_proof']['error'] !== UPLOAD_ERR_OK) {
            $code = $_FILES['payment_proof']['error'] ?? 'no_file';
            $msg = "Upload failed (code: $code). Please try again with jpg/jpeg/png/webp/heic under 10MB and ensure php.ini upload_max_filesize/post_max_size are high enough.";
            Session::set("error", $msg);
            header("Location: " . BASE_URL . "bids/transaction/$auctionId");
            exit;
        }

        $proof = Upload::save($_FILES["payment_proof"] ?? null, "payment_proof", 10_000_000);
        if (!$proof) {
            $reason = Upload::getLastError() ?: "Only jpg/jpeg/png/webp/heic under 10MB are allowed. Please also ensure PHP upload_max_filesize/post_max_size permit this size.";
            Session::set("error", "Upload failed. " . $reason);
            header("Location: " . BASE_URL . "bids/transaction/$auctionId");
            exit;
        }

        $existing = $this->payment->getPaymentByAuctionAndUser($auctionId, $userId);

        try {
            if ($existing) {
                $this->payment->update($existing["id"], [
                    "payment_proof" => $proof,
                    "status" => "pending"
                ]);
                $paymentId = $existing["id"];
            } else {
                $this->payment->create([
                    "auction_id" => $auctionId,
                    "user_id" => $userId,
                    "amount" => $auction["final_price"] ?? $auction["starting_price"] ?? 0,
                    "payment_proof" => $proof,
                    "status" => "pending"
                ]);
                // Ambil id terbaru
                $paymentId = $this->payment->getLastInsertId();
            }

            Session::set("success", "Payment proof uploaded. Awaiting verification. Ref: #$paymentId");
        } catch (Exception $e) {
            Session::set("error", "Upload saved but failed to record payment. DB error: " . $e->getMessage());
        }

        header("Location: " . BASE_URL . "bids/transaction/$auctionId");
        exit;
    }

}
