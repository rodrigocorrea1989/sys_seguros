<?php

include('header.php');
include('conn.php');
include("comprobar_acceso.php");

$id_cliente = intval($_POST['id_cliente']);
$id_seguro = intval($_POST['id_seguro']);
$numero = floatval($_POST['numero']);
$fecha_alta = $_POST['fecha_alta'];
$id_return = $id_cliente;

// ====================
// OBTENER DIAS Y PRECIO
// ====================
$sql_venc = "SELECT dias, precio FROM seguros WHERE id = ?";
$stmt_venc = $conn->prepare($sql_venc);
$stmt_venc->bind_param("i", $id_seguro);
$stmt_venc->execute();
$result = $stmt_venc->get_result();

if ($row = $result->fetch_assoc()) {
    $dias = $row['dias'];
    $precio = $row['precio'];
} else {
    echo "Seguro no encontrado";
    exit;
}
$stmt_venc->close();

// ====================
// INSERTAR POLIZA
// ====================
$sql_poliza = "INSERT INTO polizas
(id_cliente, id_seguro, numero, fecha_alta)
VALUES (?, ?, ?, ?)";

$stmt_poliza = $conn->prepare($sql_poliza);
$stmt_poliza->bind_param(
    "iids",
    $id_cliente,
    $id_seguro,
    $numero,
    $fecha_alta
);

if ($stmt_poliza->execute()) {

    $id_poliza = $stmt_poliza->insert_id;

    $fecha_creacion = date('Y-m-d H:i:s');
    $fecha_vencimiento = date(
        'Y-m-d H:i:s',
        strtotime($fecha_creacion . " + $dias days")
    );

    $pagado = 0;

    // ====================
    // INSERTAR PRIMER PAGO
    // ====================
    $sql_pago = "INSERT INTO pagos
(id_poliza, fecha_creacion, fecha_vencimiento, monto, pagado)
VALUES (?, ?, ?, ?, ?)";

    $stmt_pago = $conn->prepare($sql_pago);
    $stmt_pago->bind_param(
        "issdi",
        $id_poliza,
        $fecha_creacion,
        $fecha_vencimiento,
        $precio,
        $pagado
    );

    $stmt_pago->execute();
    $stmt_pago->close();

    $usuario = $_SESSION['usuario'];
    $accion = "Insertar Poliza";

    $sql_log = "INSERT INTO historial (usuario, fecha, accion)
            VALUES ('$usuario', NOW(), '$accion')";

    $conn->query($sql_log);

    header("Location: polizas_asociadas?id=" . $id_return);
    exit;
} else {
    echo "Error al insertar póliza";
}

$stmt_poliza->close();
$conn->close();
