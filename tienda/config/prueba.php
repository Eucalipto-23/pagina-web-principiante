<?php
$host = "localhost";
$port = "3307";
$db = "tienda";
$user = "root";
$pass = "";

try{
    $conexion = new PDO("mysql:host=$host;port=$port; dbname=$db;charset=utf8mb4", $user, $pass);
    $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conectado";
} catch (PDOException $e) {
    die("Error de conexion: " . $e->getMessage());
}