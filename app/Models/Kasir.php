<?php

namespace app\Models;

use app\Config\DatabaseConfig;
use mysqli;

class Kasir extends DatabaseConfig{
public $conn;

public function __construct()
{
    $this->conn = new mysqli($this -> host,$this -> user,$this -> password, $this -> database_name, $this -> port);
    if($this->conn->connect_error){
        die("Connection failed : ". $this->conn->connect_error);
    }
}

public function findAll()
{
    $sql = "SELECT kasir.*, product.product_name 
            FROM kasir
            JOIN product ON kasir.idProduct = product.id";
    
    $result = $this->conn->query($sql);
    $this->conn->close();
    
    $data = [];
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }

    return $data;
}


public function findById($id){
    $sql = "SELECT * FROM kasir WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt ->execute();
    $result = $stmt->get_result();
    $this->conn->close();
    $data = [];
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
    return $data;
}

public function create($data){
    $shift = $data['shift'];
    $idProduct = $data['idProduct'];
    $query = "INSERT INTO kasir (shift, idproduct) VALUES (?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("si", $shift, $idProduct);
    $stmt->execute();
    $this->conn->close();
}

public function update($data, $id) {
    $shift = $data['shift'];
    $idProduct = $data['idProduct'];
    $query = "UPDATE kasir SET shift = ?, idProduct = ? WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("sii", $shift, $idProduct, $id);
    $stmt->execute();
    $this->conn->close();
}


public function destroy($id){
    $query = "DELETE FROM kasir WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $this->conn->close();
    }
}