<?php
header('content-type: text/html;charset=utf-8');

// Función para obtener una conexión a la base de datos
function obtenerConexion() {
    $mysqli = new mysqli("localhost", "root", "", "android");

    if ($mysqli->connect_error) {
        die("Error al conectar a la base de datos: " . $mysqli->connect_error);
    }

    return $mysqli;
}

// Recibe el valor de ID enviado por la aplicación Android
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Obtén la conexión a la base de datos
$conexion = obtenerConexion();

// Realiza la consulta a la base de datos utilizando la conexión
$consulta = "SELECT CUADRADO, CUBO, RAIZ_CUBICA, RAIZ_CUADRADA FROM numeros WHERE id = '$id'";
$resultado = $conexion->query($consulta);

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

// Prepara los resultados en un arreglo JSON
$response = array();
while ($fila = $resultado->fetch_assoc()) {
    $response[] = $fila;
}

// Devuelve los datos en formato JSON
echo json_encode($response);

// Cierra la conexión a la base de datos
$conexion->close();
?>