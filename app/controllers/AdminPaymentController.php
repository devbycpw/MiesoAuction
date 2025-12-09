<?php
class AdminPaymentController extends Controller {

    private $paymentModel;

    public function __construct() {
        parent::__construct();
        
        // 1. Inisialisasi Model Payment (disarankan)
        // Asumsi: $this->model('Payment') mengembalikan instance dari Payment Model
        $this->paymentModel = $this->model('Payment'); 
        
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
            "layout" => "Main"
        ]);
    }
}