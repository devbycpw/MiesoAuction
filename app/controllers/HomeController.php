<?php
class HomeController extends Controller {
    public function index() {
        $user = $this->model("User");
        $data = $user->all();

        $this->view("home/index", [
            "users" => $data
        ]);
    }
}
