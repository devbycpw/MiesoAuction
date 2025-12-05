<?php
    class AdminAuctionController extends Controller {
        public function __construct() {
            Auth::redirectAdmin(); // hanya admin
        }

        public function index() {
            $this->view("Admin/auction");
        }
    }
?>