<?php

include('header.php');
include('conn.php');
include("comprobar_acceso.php");
$base = dirname($_SERVER['PHP_SELF']);

$id_pago = addslashes(htmlentities($_GET['id_pago'] ?? null));
$id_poliza = addslashes(htmlentities($_GET['id'] ?? null));
$id = addslashes(htmlentities($_GET['cliente'] ?? null));
$fecha_creacion = addslashes(htmlentities($_GET['fecha_creacion'] ?? null));
$fecha_vencimiento_new = addslashes(htmlentities($_GET['fecha_vencimiento_new'] ?? null));
$monto_real = addslashes(htmlentities($_GET['monto_real'] ?? null));
$dias = addslashes(htmlentities($_GET['dias'] ?? null));
$ven = addslashes(htmlentities($_GET['ven'] ?? null));


$fecha_creacion2 = date(
    'Y-m-d H:i:s',
    strtotime($fecha_creacion . " + $dias days")
);


$fecha_vencimiento2 = date(
    'Y-m-d H:i:s',
    strtotime($fecha_creacion2 . " + $dias days")
);



$sql3 = "UPDATE pagos 
                SET pagado = 1
                WHERE id = $id_pago";

$result3 = mysqli_query($conn, $sql3);


//inserta nuevo pago 

if ($ven == 1) {

    $sql_insert = "INSERT INTO pagos
                (id_poliza, fecha_creacion, fecha_vencimiento, monto, pagado)
            VALUES ('$id_poliza', '$fecha_creacion2' , '$fecha_vencimiento2', '$monto_real', 0)";

    $result = mysqli_query($conn, $sql_insert);


    $usuario = $_SESSION['usuario'];
    $accion = "Procesar Pago";

    $sql_log = "INSERT INTO historial (usuario, fecha, accion)
            VALUES ('$usuario', NOW(), '$accion')";

    $conn->query($sql_log);
}

header("Location:$base/pagos?id=$id_poliza&cliente=$id");
