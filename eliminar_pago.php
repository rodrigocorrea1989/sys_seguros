<?php

include('header.php');
include('conn.php');
include("comprobar_acceso.php");
include("alertas.php");

$id_pago = intval($_GET['id_pago'] ?? 0);

$id_cliente = intval($_GET['id'] ?? 0);

$id_poliza = intval($_GET['id_poliza'] ?? 0);


$sql = "DELETE FROM pagos WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id_pago);


if ($stmt->execute()) {

    $base = dirname($_SERVER['PHP_SELF']);

    header("Location: $base/pagos?id=$id_poliza&cliente=$id_cliente");
    exit;
} else {

    echo "Error al eliminar";
}
