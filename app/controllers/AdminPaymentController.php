<?php
class AdminPaymentController extends Controller {

    private $paymentModel;

    public function __construct() {
        parent::__construct();
        $this->paymentModel = $this->model('Payment'); 
        $this->auctionModel = $this->model('Auction'); 
    }
    
    public function show($id) {
        
        if (!Auth::isAdmin()) {
            http_response_code(403);
            die("Akses ditolak. Hanya Administrator yang diizinkan.");
        }

        $data_payment = $this->paymentModel->getWithRelations($id);

        if (!$data_payment) {
            http_response_code(404);
            die("Payment record not found for ID: " . $id);
        }

        $this->view("Admin/PaymentShow", [
            "payment" => $data_payment, 
            "title" => "Admin Payment Verification",
            "layout" => "Main",
            "custom_css" => "admin-payments"
        ]);
    }

    public function verify($id){
        if (!Auth::isAdmin()) {
            http_response_code(403);
            die("Akses ditolak.");
        }
        
        $payment = $this->paymentModel->findById($id);

        if (!$payment) {
            Session::set('error', 'Pembayaran ID ' . $id . ' tidak ditemukan.');
            header('Location: ' . BASE_URL . 'admin/payment/pending');
            exit;
        }
        
        $success = $this->paymentModel->changeStatus($id, 'verified');
        
        if ($success) {
            
            $auctionId = $payment['auction_id'];
            $auctionSuccess = $this->auctionModel->setStatusSold($auctionId); 
            
            if ($auctionSuccess) {
                Session::set('success', 'Pembayaran ID ' . $id . ' berhasil diverifikasi, dan Lelang ID ' . $auctionId . ' telah diubah menjadi SOLD.');
            } else {
                Session::set('error', 'Verifikasi berhasil, tetapi gagal mengubah status lelang menjadi SOLD.');
            }

        } else {
            Session::set('error', 'Gagal memverifikasi pembayaran ID ' . $id . '. Periksa ID atau koneksi database.');
        }

        header('Location: ' . BASE_URL . 'admin/payment/approved'); 
        exit;
    }

    public function reject($id){
        if (!Auth::isAdmin()) {
            http_response_code(403);
            die("Akses ditolak.");
        }
        
        $payment = $this->paymentModel->findById($id);

        if (!$payment) {
            Session::set('error', 'Pembayaran ID ' . $id . ' tidak ditemukan.');
            header('Location: ' . BASE_URL . 'admin/payment/pending');
            exit;
        }
        
        $success = $this->paymentModel->changeStatus($id, 'rejected');
        
        if ($success) {
            Session::set('success', 'Pembayaran ID ' . $id . ' berhasil ditolak. Pengguna dapat mengunggah bukti baru.');
        } else {
            Session::set('error', 'Gagal menolak pembayaran ID ' . $id . '. Periksa ID atau koneksi database.');
        }

        header('Location: ' . BASE_URL . 'admin/payment/rejected');
        exit;
    }
}
