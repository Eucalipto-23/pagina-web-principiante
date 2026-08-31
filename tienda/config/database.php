<?php

class Database {
    private $host = "localhost";
    private $port = "3307";
    private $db = "tienda";
    private $user = "root";
    private $pass = "";

    public function conectar() {
    try{
        $conexion = new PDO("mysql:host=$this->host;port=$this->port; 
        dbname=$this->db;charset=utf8mb4", $this->user, $this->pass);
        $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conexion;
            //echo "Conectado";
        } catch (PDOException $e) {
            die("Error de conexion: " . $e->getMessage());
    }
  }
}