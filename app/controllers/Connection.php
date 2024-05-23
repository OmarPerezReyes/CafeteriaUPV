<?php  
    // Conexion a la base de datos 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jaguares_con_hambre";

    // Crear conexión 
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
?>
