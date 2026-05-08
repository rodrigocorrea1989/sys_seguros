<?php

include('header.php');
include('conn.php');
include("comprobar_acceso.php");
$base = dirname($_SERVER['PHP_SELF']);

$id_pago = addslashes(htmlentities($_GET['id_pago'] ?? null));
$id_poliza = addslashes(htmlentities($_GET['id'] ?? null));
$id = addslashes(htmlentities($_GET['cliente'] ?? null));
$fecha_vencimiento2 = addslashes(htmlentities($_GET['fecha_vencimiento2'] ?? null));
$fecha_vencimiento_new = addslashes(htmlentities($_GET['fecha_vencimiento_new'] ?? null));
$monto_real = addslashes(htmlentities($_GET['monto_real'] ?? null));

$sql3 = "UPDATE pagos 
                SET pagado = 1
                WHERE id = $id_pago";

$result3 = mysqli_query($conn, $sql3);


//inserta nuevo pago 


$sql_insert = "INSERT INTO pagos
                (id_poliza, fecha_creacion, fecha_vencimiento, monto, pagado)
            VALUES ('$id_poliza', '$fecha_vencimiento2' , '$fecha_vencimiento_new', '$monto_real', 0)";

$result = mysqli_query($conn, $sql_insert);


header("Location:$base/pagos?id=$id_poliza&cliente=$id");
