<?php

include('header.php');
include('conn.php');
include("comprobar_acceso.php");
include("alertas.php");
$base = dirname($_SERVER['PHP_SELF']);

$id = htmlentities(addslashes($_GET['cliente']));


$sqlD = "SELECT ID , DNI , NOMBRE , APELLIDO , DIRECCION , WHATSAPP , EMAIL FROM clientes WHERE ID=$id ORDER BY ID DESC";
$resultD = $conn->query($sqlD);

while ($row = $resultD->fetch_assoc()) {

    $NOMBRE = $row["NOMBRE"];
    $APELLIDO = $row["APELLIDO"];
}


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
        pagos.fecha_vencimiento,
        polizas.id_seguro,
        seguros.nombre AS nombre_seguro,
        seguros.dias AS dias,
        seguros.precio AS monto_real,
        pagos.ven AS ven,
        pagos.pagado AS pagado,
        pagos.monto AS montado
    FROM pagos
    INNER JOIN polizas ON pagos.id_poliza = polizas.id
    INNER JOIN seguros ON polizas.id_seguro = seguros.id
    WHERE pagos.id_poliza = ?
    ORDER BY pagos.id DESC
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
    $fecha_vencimiento2,
    $id_seguro,
    $nombre_seguro,
    $dias,
    $monto_real,
    $ven,
    $pagado,
    $montado
);

if ($fecha_creacion) {
    $fecha_creacion = new DateTime($fecha_creacion);
    $fecha_creacion->format('d/m/Y H:i');
}




$fecha_vencimiento = '';

if (!empty($fecha_creacion)) {

    // Si ya es DateTime
    if ($fecha_creacion instanceof DateTime) {
        $fecha_creacion = $fecha_creacion->format('Y-m-d H:i:s');
    }

    $timestamp = strtotime($fecha_creacion);

    // Sumar 30 días
    $timestamp += (30 * 24 * 60 * 60);

    $fecha_vencimiento = date('d/m/Y H:i', $timestamp);
}


?>

<div class="container-fluid mt-4">
    <center>
        <h1 class="text-primary m-3">Facturación (<?php echo $NOMBRE . ' ' . $APELLIDO ?>) </h1>
    </center>

    <?php

    $total_pagado = 0;
    $total_no_pagado = 0;


    while ($stmt->fetch()) {

        if ($pagado == 1) {

            $total_pagado += $monto;
        } else {

            $total_no_pagado += $monto;
        }
        // Fecha creación formateada
        $fecha_creada = date('d/m/Y H:i', strtotime($fecha_creacion));

        // Timestamp original
        $timestamp = strtotime($fecha_creacion);

        // Sumar días
        $timestamp += ($dias * 24 * 60 * 60);

        // Fecha vencimiento
        $fecha_vencimiento = date('d/m/Y H:i', $timestamp);


        $fecha_hoy = time();

        // Timestamp vencimiento ya lo tenés en $timestamp + días
        $timestamp_vencimiento = $timestamp;

        $fecha_vencimiento_new = date(
            'Y-m-d H:i:s',
            strtotime($fecha_vencimiento2 . " + 0 days")

        );


        $timestamp_fechavenc = strtotime($fecha_vencimiento_new);


        if ($fecha_hoy >= $timestamp_fechavenc) {

            $estado = "Vencido";
            $clase = "text-danger";

            $now = date('d/m/Y H:i');

            $fecha_vencimiento_new = date(
                'Y-m-d H:i:s',
                strtotime($fecha_vencimiento2 . " + $dias days")

            );

            if ($ven == 0) {

                $sql3 = "UPDATE pagos 
                SET ven = 1
                WHERE id = $id_pago";

                $result3 = mysqli_query($conn, $sql3);
            }
        } else {

            $estado = "Activo";
            $clase = "text-success";
        }

    ?> <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 p-3">
                            <h4 class="text-primary mt-3"><?php echo $nombre_seguro ?></h4>

                            <?php if ($pagado == 0) { ?>
                                <a class="text text-success" href="<?= dirname($_SERVER['PHP_SELF']) ?>/editar_pago?id=<?php echo $id_pago ?>">Editar</a>

                            <?php } else { ?>

                                <a class="text text-primary">Imprimir comprobante</a>

                            <?php } ?>
                        </div>

                        <div class="col-md-2 p-3">
                            <h5>Fecha Creación</h5>
                            <p><?php echo $fecha_creada; ?></p>
                        </div>

                        <div class="col-md-2 p-3">
                            <h5>Fecha Vencimiento</h5>
                            <p> <?php echo date('d/m/Y H:i', strtotime((string)$fecha_vencimiento2)); ?></p>
                        </div>

                        <div class="col-md-2 p-3">
                            <h5>Estado</h5>
                            <p class=<?php echo $clase ?>><strong><?php echo $estado ?></strong></p>
                        </div>

                        <div class="col-md-1 p-3">
                            <h5>Monto</h5>
                            <p class=<?php echo $clase ?>><strong>
                                    $ <?php echo number_format((float)($monto ?? 0), 2, ',', '.'); ?>
                                </strong></p>
                        </div>



                        <div class="col-md-1 p-3 mt-3">

                            <?php if ($pagado == 0) { ?>
                                <a class="btn btn-danger" onclick="confirmar_pago();"
                                    href="<?= dirname($_SERVER['PHP_SELF']) ?>/procesar_pago?id=<?php echo $id_poliza ?>&id_pago=<?php echo $id_pago ?>&cliente=<?php echo $id ?>&fecha_vencimiento2=<?php echo $fecha_vencimiento2 ?>&fecha_vencimiento_new=<?php echo $fecha_vencimiento_new ?>&monto_real=<?php echo $montado ?>">
                                    Cobrar
                                </a>


                            <?php } else { ?>

                                <a class="btn btn-primary">
                                    Pagado
                                </a>

                            <?php } ?>
                        </div>

                    </div>

                </div>


            </div>
        </div>
        <br>
    <?php } ?>

    <div class="container m-5">
        <h2 class="text-success">Total Pagado: $ <?php echo number_format((float)($total_pagado ?? 0), 2, ',', '.'); ?> </h2>
    </div>
    <div class="container m-5">
        <h2 class="text-danger">Total Adeudado: $ <?php echo number_format((float)($total_no_pagado ?? 0), 2, ',', '.'); ?></h2>
    </div>

</div>