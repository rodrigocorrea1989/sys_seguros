<?php

include("comprobar_acceso.php");

include("conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $id = intval($_GET['id']);

    $sql = "DELETE FROM seguros WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    $usuario = $_SESSION['usuario'];
    $accion = "Eliminar Seguro";

    $sql_log = "INSERT INTO historial (usuario, fecha, accion)
            VALUES ('$usuario', NOW(), '$accion')";

    $conn->query($sql_log);

    if ($stmt->execute()) {
        header("Location: seguros");
        exit();
    } else {
        echo "Error al eliminar el seguro";
    }

    $stmt->close();
    $conn->close();
}
