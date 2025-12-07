<?php


class PaymentController extends Controller
{
    private $payment;

    public function __construct()
    {
        parent::__construct();
        Auth::redirectUser(); // user harus login
        $this->payment = new Payment();
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
        // cek data
        if (!isset($_POST['auction_id'], $_POST['amount'], $_POST['payment_method'])) {
            die("Data tidak lengkap!");
        }

        $paymentProof = null;

        // upload bukti pembayaran
        if (isset($_FILES['payment_proof']) && $_FILES['payment_proof']['error'] === 0) {
            $fileName = time() . "_" . $_FILES['payment_proof']['name'];
            $targetDir = "../public/uploads/payment_proof/";
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES['payment_proof']['tmp_name'], $targetFile)) {
                $paymentProof = $fileName;
            }
        }

        $data = [
            'auction_id' => $_POST['auction_id'],
            'user_id' => Auth::user(),
            'amount' => $_POST['amount'],
            'payment_method' => $_POST['payment_method'],
            'payment_proof' => $paymentProof,
            'status' => 'pending'
        ];

        $this->payment->create($data);

        header("Location: /payments");
        exit;
    }

    // ---------------------------------------------------------
    // SHOW DETAIL PAYMENT + RELASI
    // ---------------------------------------------------------
    public function show($id)
    {
        $data['payment'] = $this->payment->getWithRelations($id);

        if (!$data['payment']) {
            die("Payment tidak ditemukan!");
        }

        $this->view("payments/show", $data);
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
}

