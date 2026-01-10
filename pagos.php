<?php

include('header.php');
include('conn.php');
include("comprobar_acceso.php");


$id_poliza = addslashes(htmlentities($_GET['id'] ?? null));

if (!$id_poliza) {
    die("ID de póliza no válido");
}

$sql = "SELECT 
        pagos.*,
        polizas.id_seguro,
        seguros.nombre AS nombre_seguro
    FROM pagos
    INNER JOIN polizas ON pagos.id_poliza = polizas.id
    INNER JOIN seguros ON polizas.id_seguro = seguros.id
    WHERE pagos.id_poliza = ?
";
$stmt = $conn->prepare("
    SELECT 
        pagos.id,
        pagos.id_poliza,
        pagos.monto,
        pagos.fecha_creacion,
        polizas.id_seguro,
        seguros.nombre AS nombre_seguro
    FROM pagos
    INNER JOIN polizas ON pagos.id_poliza = polizas.id
    INNER JOIN seguros ON polizas.id_seguro = seguros.id
    WHERE pagos.id_poliza = ?
");

$stmt->bind_param("i", $id_poliza);

if (!$stmt->execute()) {
    die("Error SQL: " . $stmt->error);
}

$stmt->store_result();

if ($stmt->num_rows == 0) {
    die("No hay resultados");
}

$stmt->bind_result(
    $id_pago,
    $id_poliza_db,
    $monto,
    $fecha_creacion,
    $id_seguro,
    $nombre_seguro
);

if ($fecha_creacion) {
    $fecha_creacion = new DateTime($fecha_creacion);
    $fecha_creacion->format('d/m/Y H:i');
}
?>

<div class="container-fluid mt-4">
    <center>
        <h1 class="text-primary m-3">Facturación</h1>
    </center>
    <?php while ($stmt->fetch()) { ?>
        <div class="card">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 p-3">
                        <h4 class="text-primary mt-3"><?php echo $nombre_seguro ?></h4>
                    </div>

                    <div class="col-md-2 p-3">
                        <h5>Fecha Creación</h5>
                        <p><?php echo $fecha_creacion; ?></p>
                    </div>

                    <div class="col-md-2 p-3">
                        <h5>Fecha Vencimiento</h5>
                        <p>09/02/2026 03:09</p>
                    </div>

                    <div class="col-md-2 p-3">
                        <h5>Estado</h5>
                        <p class="text-danger"><strong>Vencido</strong></p>
                    </div>

                    <div class="col-md-1 p-3">
                        <h5>Monto</h5>
                        <p class="text-danger"><strong>
                                $ <?php echo number_format((float)($monto ?? 0), 2, ',', '.'); ?>
                            </strong></p>
                    </div>

                    <div class="col-md-1 p-3 mt-3">
                        <a class="btn btn-danger">Cobrar</a>
                    </div>

                </div>

            </div>

        <?php } ?>
        </div>

</div>