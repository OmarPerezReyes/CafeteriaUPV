<?php

class UsuarioModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarUsuario($matricula, $nombre, $apellido, $correo, $contrasena, $telefono) {
        // Verificar si el correo ya está registrado
        $consulta = "SELECT * FROM clientes WHERE correo = ?";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows > 0) {
            return false; // El correo ya está registrado
        } else {
            // Insertar el nuevo usuario en la base de datos
            $consulta = "INSERT INTO clientes (matricula, nombre, apellido, correo, contraseña, teléfono) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conexion->prepare($consulta);
            $stmt->bind_param("ssssss", $matricula, $nombre, $apellido, $correo, $contrasena, $telefono);
            
            if ($stmt->execute()) {
                return true; // Registro exitoso
            } else {
                return false; // Error al registrar usuario
            }
        }
    }
}
?>
