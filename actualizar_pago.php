<?php

include('conn.php');
include("comprobar_acceso.php");
$base = dirname($_SERVER['PHP_SELF']);



$id = intval($_POST['id'] ?? 0);

$id_poliza = intval($_POST['id_poliza'] ?? 0);

$id_pago = intval($_POST['id_pago'] ?? 0);

$monto = floatval($_POST['monto'] ?? 0);

$fecha_creacion = $_POST['fecha_creacion'] ?? '';

$fecha_vencimiento = $_POST['fecha_vencimiento'] ?? '';

$pagado = intval($_POST['pagado'] ?? 0);

if (!$id_pago) {
    die("ID inválido");
}

/*
|--------------------------------------------------------------------------
| UPDATE
|--------------------------------------------------------------------------
*/

$sql = "
UPDATE pagos SET

    monto = ?,
    fecha_creacion = ?,
    fecha_vencimiento = ?,
    pagado = ?

WHERE id = ?
";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "dssii",
    $monto,
    $fecha_creacion,
    $fecha_vencimiento,
    $pagado,
    $id_pago
);

$usuario = $_SESSION['usuario'];
$accion = "Actualizar Pago";

$sql_log = "INSERT INTO historial (usuario, fecha, accion)
            VALUES ('$usuario', NOW(), '$accion')";

$conn->query($sql_log);

if ($stmt->execute()) {

    header("Location:$base/pagos?id=$id_poliza&cliente=$id");
    exit;
} else {

    echo "Error al actualizar";
}
