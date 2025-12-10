<?php


class CategoryController extends Controller
{
    private $category;

    public function __construct()
    {
        parent::__construct();
        Auth::redirectUser(); // Cek login
        $this->category = new Category();
    }

    public function index()
    {
        $data['categories'] = $this->category->all();
        $this->view("categories/index", $data);
    }

    public function create()
    {
        $this->view("categories/create");
    }

    public function store()
    {
        if (!isset($_POST['name']) || trim($_POST['name']) === '') {
            die("Nama kategori tidak boleh kosong");
        }

        $this->category->create([
            'name' => $_POST['name']
        ]);

        header("Location: /categories");
        exit;
    }

    public function edit($id)
    {
        $data['category'] = $this->category->findById($id);

        if (!$data['category']) {
            die("Kategori tidak ditemukan");
        }

        $this->view("categories/edit", $data);
    }

    public function update($id)
    {
        if (!isset($_POST['name']) || trim($_POST['name']) === '') {
            die("Nama kategori tidak boleh kosong");
        }

        $this->category->update($id, [
            'name' => $_POST['name']
        ]);

        header("Location: /categories");
        exit;
    }

    public function destroy($id)
    {
        $this->category->delete($id);

        header("Location: /categories");
        exit;
    }
}