<?php

ob_start();

include('header.php');

include('conn.php');

include("comprobar_acceso.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $nombre = addslashes(htmlentities($_POST['nombre']));
    $apellido = addslashes(htmlentities($_POST['apellido']));
    $usuario = addslashes(htmlentities($_POST['usuario']));
    $tipo = 1;
    $contraseña = addslashes(htmlentities($_POST['contraseña'])); // Hashear la contraseña

    // Preparar y ejecutar la consulta SQL
    $sql = "INSERT INTO usuarios (NOMBRE, APELLIDO , USUARIO , PASS, TIPO) VALUES (?, ?, ?, ? , ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $apellido, $usuario, $contraseña, $tipo);

    $usuario2 = $_SESSION['usuario'];
    $accion = "Insertar Usuario";

    $sql_log = "INSERT INTO historial (usuario, fecha, accion)
            VALUES ('$usuario2', NOW(), '$accion')";

    $conn->query($sql_log);

    if ($stmt->execute()) {
        header("location:usuarios");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
