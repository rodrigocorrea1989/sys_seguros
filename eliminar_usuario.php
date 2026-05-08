<?php
ob_start();

include("header.php");

include("conn.php");

include("comprobar_acceso.php");
// Obtener el ID del usuario a eliminar
$id = $_GET['id'];

// Preparar la consulta SQL para eliminar el registro
$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);


$usuario = $_SESSION['usuario'];
$accion = "Eliminar Usuario";

$sql_log = "INSERT INTO historial (usuario, fecha, accion)
            VALUES ('$usuario', NOW(), '$accion')";

$conn->query($sql_log);

// Ejecutar la consulta y verificar si fue exitosa
if ($stmt->execute()) {
    header("location:usuarios");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
