<?php

include('header.php');

include('conn.php');

include('alertas.php');

include("comprobar_acceso.php");

$base = dirname($_SERVER['PHP_SELF']);

$id_cliente = htmlentities(addslashes($_GET['cliente']));

$id_poliza = htmlentities(addslashes($_GET['id']));

$usuario = $_SESSION['usuario'];
$accion = "Baja Poliza";

$sql_log = "INSERT INTO historial (usuario, fecha, accion)
            VALUES ('$usuario', NOW(), '$accion')";

$conn->query($sql_log);


$sql = "UPDATE polizas 
        SET baja = 1,
            fecha_baja = NOW()
        WHERE id = '$id_poliza'
        AND id_cliente = '$id_cliente'";

if ($conn->query($sql)) {

    header("Location:$base/polizas_asociadas?id=$id_poliza&id=$id_cliente");
} else {

    echo "Error: " . $conn->error;
}
