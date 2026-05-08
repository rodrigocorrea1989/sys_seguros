<?php

include("comprobar_acceso.php");

include("conn.php");

$id = intval($_POST['id']);
$nombre = htmlentities($_POST['nombre'], ENT_QUOTES, 'UTF-8');
$descripcion = htmlentities($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
$precio = floatval($_POST['precio']);
$dias = intval($_POST['dias']);

$sql = "UPDATE seguros 
        SET nombre = ?, descripcion = ?, precio = ?, dias = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $dias, $id);


$usuario = $_SESSION['usuario'];
$accion = "Actualizar Seguro";

$sql_log = "INSERT INTO historial (usuario, fecha, accion)
            VALUES ('$usuario', NOW(), '$accion')";

$conn->query($sql_log);

if ($stmt->execute()) {
    header("Location: seguros");
} else {
    echo "Error al actualizar";
}

$stmt->close();
$conn->close();
