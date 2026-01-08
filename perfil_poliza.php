<?php

include('header.php');

include('conn.php');

include('alertas.php');

include("comprobar_acceso.php");


$id = htmlentities(addslashes($_GET['id']));

$id_cliente = htmlentities(addslashes($_GET['id_cliente']));

$sql2 = "SELECT 
            s.id,
            s.descripcion,
            s.nombre AS seguro,
            s.precio,
            s.dias
        FROM seguros s
        WHERE s.id = ?";

$stmt = $conn->prepare($sql2);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $descripcion = $row['descripcion'];
    $nombre = $row['seguro'];
    $precio = $row['precio'];
    $dias = $row['dias'];
}

?>


<div class="container mt-5">
    <div class="card">
        <center>
            <h2 class="mt-3 text-info"> <?php echo $nombre ?> </h2>
            <h5 class="m-5 text-dark"><?php echo $descripcion ?></h5>
            <h5 class="mt-2 text-danger">Precio: <?php echo $precio ?>$</h5>
            <h5 class="mt-2 text-danger">Vencimiento: <?php echo $dias ?> Días</h5>
        </center>
    </div>
    <a class="btn btn-primary mt-2" href="polizas_asociadas?id=<?php echo $id_cliente  ?>">Volver</a>
</div>