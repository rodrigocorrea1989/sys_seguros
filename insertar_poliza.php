<?php

include('header.php');

include('conn.php');

include("comprobar_acceso.php");


$id_cliente = intval($_POST['id_cliente']);
$id_seguro  = intval($_POST['id_seguro']);
$numero     = floatval($_POST['numero']);
$fecha_alta = $_POST['fecha_alta']; // YYYY-MM-DD HH:MM
$id_return = intval($_POST['id_cliente']);

// Insertar póliza
$sql = "INSERT INTO polizas 
        (id_cliente, id_seguro, numero, fecha_alta)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "iids",
    $id_cliente,
    $id_seguro,
    $numero,
    $fecha_alta,

);

if ($stmt->execute()) {
    header("Location: polizas_asociadas?id=" . $id_return);
    exit;
} else {
    echo "Error al insertar póliza";
}



$stmt->close();
$conn->close();
