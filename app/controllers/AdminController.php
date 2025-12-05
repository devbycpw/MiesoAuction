<?php
    
    require __DIR__ . "/../helpers/auth/Auth.php";
    require __DIR__ . "/../helpers/auth/Session.php";

    
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
    }
