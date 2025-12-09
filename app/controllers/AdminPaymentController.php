<?php
class AdminPaymentController extends Controller {

    private $paymentModel;

    public function __construct() {
        parent::__construct();
        
        // 1. Inisialisasi Model Payment (disarankan)
        // Asumsi: $this->model('Payment') mengembalikan instance dari Payment Model
        $this->paymentModel = $this->model('Payment'); 
        $this->auctionModel = $this->model('Auction'); 
        
        // Opsional: Redirect jika bukan Admin (seperti Auth::redirectAdmin())
        // Auth::redirectAdmin(); 
    }
    
    /**
     * Menampilkan detail pembayaran spesifik untuk verifikasi admin.
     * Route: admin/showPayment/{id}
     *
     * @param int $id ID dari record pembayaran (payment_id).
     */
    public function show($id) { // <-- ID harus diterima di sini
        
        // 2. Wajib: Pengecekan Akses Admin
        if (!Auth::isAdmin()) {
            http_response_code(403);
            die("Akses ditolak. Hanya Administrator yang diizinkan.");
        }

        // 3. Ambil data Payment dengan relasi
        $data_payment = $this->paymentModel->getWithRelations($id);

        if (!$data_payment) {
            http_response_code(404);
            die("Payment record not found for ID: " . $id);
        }

        // 4. Load View
        $this->view("Admin/PaymentShow", [
            // Kirim sebagai 'payment' (singular) agar lebih mudah diakses di View
            "payment" => $data_payment, 
            "title" => "Admin Payment Verification",
            "layout" => "Main",
            "custom_css" => "admin-payments"
        ]);
    }

    public function verify($id){
        // Pastikan hanya admin yang dapat mengakses
        if (!Auth::isAdmin()) {
            http_response_code(403);
            die("Akses ditolak.");
        }
        
        // 1. Ambil data pembayaran untuk mendapatkan auction_id
        $payment = $this->paymentModel->findById($id);

        if (!$payment) {
            Session::set('error', 'Pembayaran ID ' . $id . ' tidak ditemukan.');
            header('Location: ' . BASE_URL . 'admin/payment/pending');
            exit;
        }
        
        // 2. Ubah status pembayaran menjadi 'verified'
        $success = $this->paymentModel->changeStatus($id, 'verified');
        
        if ($success) {
            
            // 3. JIKA SUKSES: Ubah status lelang (auction) menjadi 'sold'
            $auctionId = $payment['auction_id'];
            // ASUMSI: Auction Model memiliki setStatusSold($auctionId)
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

    // ------------------------------------------------------------------
    // Metode Baru: Reject Payment
    // ------------------------------------------------------------------
    public function reject($id){
        if (!Auth::isAdmin()) {
            http_response_code(403);
            die("Akses ditolak.");
        }
        
        // Ambil data pembayaran
        $payment = $this->paymentModel->findById($id);

        if (!$payment) {
            Session::set('error', 'Pembayaran ID ' . $id . ' tidak ditemukan.');
            header('Location: ' . BASE_URL . 'admin/payment/pending');
            exit;
        }
        
        // Ubah status pembayaran menjadi 'rejected'
        $success = $this->paymentModel->changeStatus($id, 'rejected');
        
        if ($success) {
            // Karena rejected, status lelang tetap 'closed'.
            Session::set('success', 'Pembayaran ID ' . $id . ' berhasil ditolak. Pengguna dapat mengunggah bukti baru.');
        } else {
            Session::set('error', 'Gagal menolak pembayaran ID ' . $id . '. Periksa ID atau koneksi database.');
        }

        header('Location: ' . BASE_URL . 'admin/payment/rejected'); // Redirect ke daftar rejected
        exit;
    }
}
