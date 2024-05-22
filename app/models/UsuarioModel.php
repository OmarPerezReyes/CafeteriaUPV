<?php

class UsuarioModel
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function registrarUsuario($matricula, $nombre, $apellido, $correo, $contrasena, $telefono)
    {
        // Verificar si la matrícula ya está registrada
        $consultaMatricula = "SELECT * FROM clientes WHERE matricula = ?";
        $stmtMatricula = $this->conexion->prepare($consultaMatricula);
        $stmtMatricula->bind_param("s", $matricula);
        $stmtMatricula->execute();
        $resultadoMatricula = $stmtMatricula->get_result();

        if ($resultadoMatricula->num_rows > 0) {
            return false; // La matrícula ya está registrada
        } else {
            // Verificar si el correo ya está registrado
            $consultaCorreo = "SELECT * FROM clientes WHERE correo = ?";
            $stmtCorreo = $this->conexion->prepare($consultaCorreo);
            $stmtCorreo->bind_param("s", $correo);
            $stmtCorreo->execute();
            $resultadoCorreo = $stmtCorreo->get_result();

            if ($resultadoCorreo->num_rows > 0) {
                return false; // El correo ya está registrado
            } else {
                // Insertar el nuevo usuario en la base de datos
                $consultaInsertar = "INSERT INTO clientes (matricula, nombre, apellido, correo, contraseña, teléfono) VALUES (?, ?, ?, ?, ?, ?)";
                $stmtInsertar = $this->conexion->prepare($consultaInsertar);
                $stmtInsertar->bind_param("ssssss", $matricula, $nombre, $apellido, $correo, $contrasena, $telefono);

                if ($stmtInsertar->execute()) {
                    return true; // Registro exitoso
                } else {
                    return false; // Error al registrar usuario
                }
            }
        }
    }

}
?>