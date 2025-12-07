<?php
    class HomeController extends Controller {

        public function __construct() {
                parent::__construct();
            }
        
        public function index() {
            $user = $this->model("User");
            $auction = $this->model("Auction");
            $data_auction = $auction->getActiveAuctions();
            $data_user = $user->all();
            $this->view("Home/index", [
                "users" => $data_user,
                "auctions" => $data_auction,
                "title" => "Home",
                "layout" => "Main",
                "custom_js" => "auction"
            ]);
        }

    }
