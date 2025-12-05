<?php
    require __DIR__ . "/../helpers/auth/Auth.php";
    require __DIR__ . "/../helpers/auth/Session.php";
    class HomeController extends Controller {

        public function __construct() {
                parent::__construct();
                Auth::redirectClient();
            }
        
        public function index() {
            $user = $this->model("User");
            $data = $user->all();
            $this->view("Home/index", [
                "users" => $data
            ]);
        }
    }
