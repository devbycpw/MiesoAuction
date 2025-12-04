<?php
class CategoryController extends Controller{
    public function index(){
        $category = $this->model("Category");
        $data = $category->all();
        $this->view("admin/adminManageCategoryView", [
            "catgories" => $data
        ]);
    }
}
?>