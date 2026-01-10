<?php

include('header.php');

include('conn.php');

include('alertas.php');

include("comprobar_acceso.php");

$id = htmlentities(addslashes($_GET['id']));

$sql = "SELECT ID , DNI , NOMBRE , APELLIDO , DIRECCION , WHATSAPP , EMAIL FROM clientes WHERE ID='$id' ORDER BY ID DESC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

    $NOMBRE = $row["NOMBRE"];
    $APELLIDO = $row["APELLIDO"];
}


$cliente = ucfirst($NOMBRE) . ' ' . ucfirst($APELLIDO);

$id_cliente = intval($_GET['id']);

// Consulta
$sql2 = "SELECT 
            p.id,
            p.numero,
            s.nombre AS seguro,
            s.precio,
            p.fecha_alta,
            p.fecha_baja,
            s.id AS id_seguro
        FROM polizas p 
        INNER JOIN seguros s ON p.id_seguro = s.id
        WHERE p.id_cliente = ?
        ORDER BY p.fecha_alta DESC";

$stmt = $conn->prepare($sql2);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();
?>


<div class="container-fluid mt-5">
    <center>
        <h2 class="mt-3 text-info">Polizas Asociadas a <?php echo $cliente ?> </h2>
    </center>
    <a class="btn btn-primary mt-2 mb-2" href="nueva_poliza?id=<?php echo $id ?>">Asociar Nueva Poliza</a>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Número</th>
                <th scope="col">Seguro</th>
                <th scope="col">Costo</th>
                <th scope="col">Fecha de Alta</th>
                <th scope="col">
                    <center>Pagos Pendientes</center>
                </th>
                <th scope="col">Facturación
                </th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php $i = 1; ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <th scope="row"><?php echo $i++; ?></th>
                        <td><?php echo $row['numero']; ?></td>
                        <td><a href="perfil_poliza?id=<?php echo  $row['id_seguro'] ?>&id_cliente=<?php echo $id  ?>"><?php echo htmlspecialchars($row['seguro']); ?></a></td>
                        <td>$ <?php echo number_format($row['precio'], 2, ',', '.'); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['fecha_alta'])); ?></td>
                        <td>
                            <center>5</center>
                        </td>
                        <td><a class="btn btn-primary ml-3" href="pagos"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                                </svg></a></td>
                        <td><a class="btn btn-info">Pausar</a></td>
                        <td><a class="btn btn-danger">Dar de baja</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        No hay pólizas asociadas a este cliente
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a class="btn btn-primary" href="clientes">Volver</a>
</div>