<?php

class ClienteModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerUsuarioPorCorreo($correo) {
        try {
            $query = "SELECT * FROM clientes WHERE correo = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $correo); // Vincular el parámetro
            $stmt->execute();
            $result = $stmt->get_result(); // Obtener el resultado de la consulta
            $usuario = $result->fetch_assoc(); // Obtener el primer resultado como arreglo asociativo
            return $usuario; // Retornar el arreglo asociativo
        } catch (PDOException $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            // Puedes registrar el error en un archivo de registro o mostrar un mensaje más detallado al usuario
            return false;
        }

    }

    
}
?>
