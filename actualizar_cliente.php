<?php
ob_start();

include('header.php');
include('conn.php');
include("comprobar_acceso.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $dni_original = $_POST['dni']; // para el WHERE

    $dni = htmlentities($_POST['dni']);
    $nombre = htmlentities($_POST['nombre']);
    $apellido = htmlentities($_POST['apellido']);
    $direccion = htmlentities($_POST['direccion']);
    $wp = htmlentities($_POST['wp']);
    $mail = htmlentities($_POST['mail']);

    $sql = "UPDATE clientes 
            SET DNI = ?, 
                NOMBRE = ?, 
                APELLIDO = ?, 
                DIRECCION = ?, 
                WHATSAPP = ?, 
                EMAIL = ?
            WHERE DNI = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssss",
        $dni,
        $nombre,
        $apellido,
        $direccion,
        $wp,
        $mail,
        $dni_original
    );

    $usuario = $_SESSION['usuario'];
    $accion = "Actualizar Cliente";

    $sql_log = "INSERT INTO historial (usuario, fecha, accion)
            VALUES ('$usuario', NOW(), '$accion')";

    $conn->query($sql_log);

    if ($stmt->execute()) {
        header("Location: clientes");
        exit;
    } else {
        echo "Error al actualizar: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
