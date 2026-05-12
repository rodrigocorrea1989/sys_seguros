<?php
ob_start();

include('header.php');

include('conn.php');

include("comprobar_acceso.php");

// Obtener el ID del usuario a actualizar
$id = $_GET['id'];

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $tipo = $_POST['tipo'];

    // Preparar la consulta SQL
    if (!empty($contraseña)) {
        // Si se proporcionó una nueva contraseña, hashearla
        $sql = "UPDATE usuarios SET NOMBRE = ?, APELLIDO = ?, USUARIO = ?, PASS = ?, TIPO= ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssis", $nombre, $apellido, $usuario, $contraseña,  $tipo, $id);
    } else {
        // Si no se proporcionó una nueva contraseña, actualizar sin cambiar la contraseña
        $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, usuario = ? ,  TIPO= ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssis", $nombre, $apellido, $usuario, $tipo, $id);
    }

    $usuario2 = $_SESSION['usuario'];
    $accion = "Actualizar Usuario";

    $sql_log = "INSERT INTO historial (usuario, fecha, accion)
            VALUES ('$usuario2', NOW(), '$accion')";

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
}
