<?php
    require __DIR__ . "/../helpers/auth/Auth.php";
    require __DIR__ . "/../helpers/auth/Session.php";
    
    class AdminController extends Controller{
        public function __construct() {
            parent::__construct();
            Auth::redirectAdmin();   // hanya admin
        }   
        
        public function index() {
            $this->view("Admin/Dashboard");
        }
    }

?>