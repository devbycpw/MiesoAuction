<?php

    class ProfileController extends Controller{
        public function __construct() {
                parent::__construct();
            }
        
        public function index() {
            $user = $this->model("User");
            $data_user = $user->all();
            $this->view("profile/index", [
                "users" => $data_user,
                "title" => "profile",
                "custom_css" => "profile",
                "layout" => "Main",
                "custom_js" => "profile"
            ]);
        }
    }

?>