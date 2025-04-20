<?php
function conectarDB(){
    $dsn = "mysql:host=localhost; dbname=branches_db;charset=utf8";
    $usuarios = "root";
    $constraseña = "";

    try{
        $pdo = new PDO($dsn, $usuarios, $constraseña);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }catch (PDOException $e){
        die("Error de conexion: ". $e->getMessage());
    }
}
?>