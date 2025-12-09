<?php
    class AdminController extends Controller{
        private $payment;
    private $user;
    public function __construct() {
        parent::__construct();
        Auth::redirectAdmin(); 
        $this->payment = $this->model("Payment");
        $this->user = $this->model("User");
    }   
        
        public function index() {
            $this->view("Admin/Dashboard",[
                "title" => "Admin Dashboard",
                "layout" => "Main"
            ]);
        }

        public function approve($id)
        {
            $auctionModel = $this->model('Auction');
            $success = $auctionModel->changeStatus($id, 'active');
            if ($success) {
                Session::set('success', 'Lelang ID ' . $id . ' berhasil diaktifkan dan sekarang aktif!');
            } else {
                Session::set('error', 'Gagal mengaktifkan lelang ID ' . $id . '. Periksa ID atau koneksi database.');
            }

            header('Location: ' . BASE_URL . 'admin/auctions'); 
            exit;
        }
        
        public function reject($id)
        {
            $auctionModel = $this->model('Auction');
            $success = $auctionModel->ChangeStatus($id, 'rejected');
            if ($success) {
                Session::set('success', 'Lelang ID ' . $id . ' berhasil direject!');
            } else {
                Session::set('error', 'Gagal gagal mereject lelang ID ' . $id . '. Periksa ID atau koneksi database.');
            }

            header('Location: ' . BASE_URL . 'admin/auctions'); 
            exit;
        }

        public function showAuctions(){
            $auction = $this->model("Auction");
            $data_auction = $auction->all();
            $this->View("Admin/ManageAuctions",[
                "auctions" => $data_auction,
                "title" => "Manage Auctions"
            ]);
        }

        public function pending()
        {
            $data['pending_payments'] = $this->payment->getPendingPayments();
            $this->view("Admin/PaymentPending", $data);
        }
        public function selectAll()
        {
            $data = $this->payment->all();
            $this->view("Admin/PaymentAll", $data);
        }
        public function selectRejected()
        {
            $data['rejected_payments'] = $this->payment->getRejectedPayments();
            $this->view("Admin/PaymentRejected", $data);
        }
        public function selectApproved()
        {
            $data['approved_payments'] = $this->payment->getApprovedPayments();
            $this->view("Admin/PaymentApproved", $data);
        }
        public function selectUser()
        {
            $data = $this->user->all();
            $this->view("Admin/ManageUser", $data);
        }
        

    }
