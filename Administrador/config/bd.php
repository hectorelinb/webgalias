<?php
$host = "localhost";
$bd = "actas";
$user = 'root';
$password = '';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd", $user, $password);
    // Resto de tu código
    if ($conexion) {
        echo "Conectado a la base de datos";
    }
} catch (PDOException $ex) {
    echo "Error de conexión: " . $ex->getMessage();
}
?>