<?php
    class AboutUsController extends Controller{
        public function __construct() {
                parent::__construct();
            }

        public function index() {
            
            $this->view("AboutUsView", [
                "title" => "About Us",
                "layout" => "Main"
            ]);
        }
    }
?>