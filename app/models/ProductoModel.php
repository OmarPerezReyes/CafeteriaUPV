<?php

class ProductoModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerProductos() {
        $consulta = "SELECT * FROM productos";
        $resultados = $this->conexion->query($consulta);

        $productos = [];
        while ($row = $resultados->fetch_assoc()) {
            $productos[] = $row;
        }

        return $productos;
    }

}
?> 