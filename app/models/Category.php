<?php

class Category{
    private $db;

    public function __construct(){
        require_once "../Core/DbConnection.php";
        $this->db = DbConnection::connect();
    }

    public function create(array $data){
        $sql = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name']
        ]);
    }
    // public function update($id, array $data){
    //     $fields =[];
    //     $params =[':id' => $id];

    //     if (!empty($data['name'])) {
    //         $fields[] = "name = :name";
    //         $params[':name'] = $data['name'];
    //     }
    //     if (empty($fields)) {
    //         return false;
    //     }
    //     $sql = "UPDATE categories SET ".implode(", ",$fields)."WHERE id =:id";
    //     $stmt->db->prepare($sql);
    //     return $stmt->execute();
    // }
}
    
?>