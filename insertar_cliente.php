<?php

ob_start();

include('header.php');

include('conn.php');

include("comprobar_acceso.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $dni = addslashes(htmlentities($_POST['dni']));
    $nombre = addslashes(htmlentities($_POST['nombre']));
    $apellido = addslashes(htmlentities($_POST['apellido']));
    $direccion = addslashes(htmlentities($_POST['direccion']));
    $wp = addslashes(htmlentities($_POST['wp']));
    $mail = addslashes(htmlentities($_POST['mail'])); // Hashear la contraseña

    // Preparar y ejecutar la consulta SQL
    $sql = "INSERT INTO clientes (DNI, NOMBRE , APELLIDO , DIRECCION , WHATSAPP , EMAIL) VALUES (?, ?, ?, ? , ? , ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $dni, $nombre, $apellido, $direccion, $wp, $mail);

    $usuario = $_SESSION['usuario'];
    $accion = "Insertar Cliente";

    $sql_log = "INSERT INTO historial (usuario, fecha, accion)
            VALUES ('$usuario', NOW(), '$accion')";

    $conn->query($sql_log);

    if ($stmt->execute()) {
        header("location:clientes");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
