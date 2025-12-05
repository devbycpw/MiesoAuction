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
    }
