<?php


    
    class AdminController extends Controller{
        public function __construct() {
            parent::__construct();
            Auth::redirectAdmin(); 
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
            $success = $auctionModel->statusActive($id, 'active');
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
            $success = $auctionModel->statusReject($id, 'rejected');
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

        

    }

