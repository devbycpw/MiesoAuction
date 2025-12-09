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
                "title" => "Manage Auctions",
                "custom_css" => "admin-auctions"
            ]);
        }

        public function pending()
        {
            $data['pending_payments'] = $this->payment->getPendingPayments();
            $this->view("Admin/PaymentPending", [
                "pending_payments" => $data['pending_payments'],
                "custom_css" => "admin-payments"
            ]);
        }
        public function selectAll()
        {
            $data = $this->payment->all();
            $this->view("Admin/PaymentAll", [
                "data" => $data,
                "custom_css" => "admin-payments"
            ]);
        }
        public function selectRejected()
        {
            $data['rejected_payments'] = $this->payment->getRejectedPayments();
            $this->view("Admin/PaymentRejected", [
                "rejected_payments" => $data['rejected_payments'],
                "custom_css" => "admin-payments"
            ]);
        }
        public function selectApproved()
        {
            $data['approved_payments'] = $this->payment->getApprovedPayments();
            $this->view("Admin/PaymentApproved", [
                "approved_payments" => $data['approved_payments'],
                "custom_css" => "admin-payments"
            ]);
        }
        public function selectUser()
        {
            $data = $this->user->all();
            $this->view("Admin/ManageUser", $data);
        }

        public function delete($id){
            $user = $this->user->delete($id);
            header("Location:".BASE_URL."admin/users");
            exit;
        }

        public function createAdmin()
        {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (empty($name) || empty($email) || empty($password)) {
                Session::set("error", "All fields are required.");
                header("Location:".BASE_URL."admin/users");
                exit;
            }

            // Cek email sudah dipakai?
            if ($this->user->findByEmail($email)) {
                Session::set("error", "Email already exists.");
                header("Location:".BASE_URL."admin/users");
                exit;
            }

            $this->user->createAdmin([
                "name"     => $name,
                "email"    => $email,
                "password" => $password
            ]);

            Session::set("success", "Admin successfully created.");
            header("Location:".BASE_URL."admin/users");
            exit;
        }

        public function pageCreateAdmin() {
        $this->view("Admin/CreateAdmin",[
            "title" => "Create Admin",
            "layout" => "Main",
            "custom_css" => "register"
        ]);
    }
    }
