<?php
class Database{
private $host = "127.0.0.1"; // Cambiado de "localhost" a "127.0.0.1"
private $port = "3306"; 
private $db = "tienda";
private $user = "root";
private $pass = "";

public function conectar(){
    try {
    $conexion = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db;charset=utf8mb4", $this->user, $this->pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
    return $conexion;
    echo "¡Conectado exitosamente!";
    
    } catch (PDOException $e) {
    die("Error de conexion: " . $e->getMessage());
    }
}
}
?>