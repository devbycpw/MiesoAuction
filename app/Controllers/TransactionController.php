<?php

require_once "../app/Models/Transaction.php";
require_once "../app/Helpers/auth/Auth.php";

class TransactionController extends Controller
{
    private $transaction;

    public function __construct()
    {
        parent::__construct();
        Auth::redirectUser();        // hanya user login
        $this->transaction = new Transaction();
    }

    // ---------------------------------------------------------
    // LIST ALL TRANSACTIONS
    // ---------------------------------------------------------
    public function index()
    {
        $data['transactions'] = $this->transaction->all();
        $this->view("transactions/index", $data);
    }

    // ---------------------------------------------------------
    // DETAIL TRANSACTION + RELATIONS
    // ---------------------------------------------------------
    public function show($id)
    {
        $data['transaction'] = $this->transaction->getWithRelations($id);

        if (!$data['transaction']) {
            die("Transaksi tidak ditemukan!");
        }

        $this->view("transactions/show", $data);
    }

    // ---------------------------------------------------------
    // FORM CREATE (ADMIN OPTIONAL)
    // ---------------------------------------------------------
    public function create()
    {
        $this->view("transactions/create");
    }

    // ---------------------------------------------------------
    // STORE NEW TRANSACTION
    // ---------------------------------------------------------
    public function store()
    {
        if (
            !isset($_POST['payment_id']) ||
            !isset($_POST['auction_id']) ||
            !isset($_POST['buyer_id']) ||
            !isset($_POST['seller_id']) ||
            !isset($_POST['total_amount'])
        ) {
            die("Data tidak lengkap!");
        }

        $data = [
            'payment_id'  => $_POST['payment_id'],
            'auction_id'  => $_POST['auction_id'],
            'buyer_id'    => $_POST['buyer_id'],
            'seller_id'   => $_POST['seller_id'],
            'total_amount'=> $_POST['total_amount']
        ];

        $this->transaction->create($data);

        header("Location: /transactions");
        exit;
    }

    // ---------------------------------------------------------
    // EDIT FORM
    // ---------------------------------------------------------
    public function edit($id)
    {
        $data['transaction'] = $this->transaction->findById($id);

        if (!$data['transaction']) {
            die("Transaksi tidak ditemukan!");
        }

        $this->view("transactions/edit", $data);
    }

    // ---------------------------------------------------------
    // UPDATE TRANSACTION
    // ---------------------------------------------------------
    public function update($id)
    {
        $updateData = [];

        foreach (['payment_id','auction_id','buyer_id','seller_id','total_amount'] as $field) {
            if (isset($_POST[$field])) {
                $updateData[$field] = $_POST[$field];
            }
        }

        if (!empty($updateData)) {
            $this->transaction->update($id, $updateData);
        }

        header("Location: /transactions/show/$id");
        exit;
    }

    // ---------------------------------------------------------
    // DELETE TRANSACTION
    // ---------------------------------------------------------
    public function destroy($id)
    {
        $this->transaction->delete($id);

        header("Location: /transactions");
        exit;
    }

    // ---------------------------------------------------------
    // LIST BY AUCTION
    // ---------------------------------------------------------
    public function byAuction($auction_id)
    {
        $data['transactions'] = $this->transaction->findByAuction($auction_id);
        $this->view("transactions/by_auction", $data);
    }

    // ---------------------------------------------------------
    // LIST BY BUYER
    // ---------------------------------------------------------
    public function byBuyer($buyer_id)
    {
        $data['transactions'] = $this->transaction->findByBuyer($buyer_id);
        $this->view("transactions/by_buyer", $data);
    }

    // ---------------------------------------------------------
    // LIST BY SELLER
    // ---------------------------------------------------------
    public function bySeller($seller_id)
    {
        $data['transactions'] = $this->transaction->findBySeller($seller_id);
        $this->view("transactions/by_seller", $data);
    }
}
