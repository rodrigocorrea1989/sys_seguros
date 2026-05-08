<?php

include('header.php');
include('conn.php');
include('alertas.php');
include("comprobar_acceso.php");

// ---------------- FILTRO FECHA ----------------

$fecha_desde = $_GET['fecha_desde'] ?? '';
$fecha_hasta = $_GET['fecha_hasta'] ?? '';

// ---------------- PAGINACIÓN ----------------

$limite = 10;

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

if ($pagina < 1) {
    $pagina = 1;
}

$desde = ($pagina - 1) * $limite;

// ---------------- WHERE ----------------

$where = "";

if (!empty($fecha_desde) && !empty($fecha_hasta)) {

    $where = "WHERE DATE(fecha) BETWEEN '$fecha_desde' AND '$fecha_hasta'";
} elseif (!empty($fecha_desde)) {

    $where = "WHERE DATE(fecha) >= '$fecha_desde'";
} elseif (!empty($fecha_hasta)) {

    $where = "WHERE DATE(fecha) <= '$fecha_hasta'";
}

// ---------------- TOTAL REGISTROS ----------------

$sql_total = "SELECT COUNT(id) as total 
              FROM historial
              $where";

$result_total = $conn->query($sql_total);
$row_total = $result_total->fetch_assoc();

$total_registros = $row_total['total'];

$total_paginas = ceil($total_registros / $limite);

// ---------------- CONSULTA ----------------

$sql = "SELECT id, usuario, fecha, accion
        FROM historial
        $where
        ORDER BY id DESC
        LIMIT $desde, $limite";

$result = $conn->query($sql);

?>

<div class="container mt-4">

    <center>
        <h2 class="text-info mb-4">Historial</h2>
    </center>

    <!-- FILTRO -->

    <form method="GET" class="mb-4">

        <div class="row">

            <div class="col-md-4">

                <label>Fecha Desde</label>

                <input
                    type="date"
                    name="fecha_desde"
                    class="form-control"
                    value="<?php echo htmlspecialchars($fecha_desde); ?>">

            </div>

            <div class="col-md-4">

                <label>Fecha Hasta</label>

                <input
                    type="date"
                    name="fecha_hasta"
                    class="form-control"
                    value="<?php echo htmlspecialchars($fecha_hasta); ?>">

            </div>

            <div class="col-md-4 d-flex align-items-end">

                <button type="submit" class="btn btn-primary w-100">
                    Filtrar
                </button>

            </div>

        </div>

    </form>

    <!-- TABLA -->

    <div class="table-responsive">

        <table class="table table-bordered table-hover table-striped">

            <thead class="thead-dark">

                <tr>

                    <th>
                        <center>ID</center>
                    </th>

                    <th>
                        <center>Usuario</center>
                    </th>

                    <th>
                        <center>Fecha</center>
                    </th>

                    <th>
                        <center>Acción</center>
                    </th>

                </tr>

            </thead>

            <tbody>

                <?php

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {

                        $id = $row['id'];
                        $usuario = $row['usuario'];
                        $fecha = date('d/m/Y H:i', strtotime($row['fecha']));
                        $accion = $row['accion'];

                        echo "

                        <tr>

                            <td>
                                <center>$id</center>
                            </td>

                            <td>
                                <center>$usuario</center>
                            </td>

                            <td>
                                <center>$fecha</center>
                            </td>

                            <td>
                                <center>$accion</center>
                            </td>

                        </tr>

                        ";
                    }
                } else {

                    echo "

                    <tr>

                        <td colspan='4'>
                            <center>No hay registros</center>
                        </td>

                    </tr>

                    ";
                }

                ?>

            </tbody>

        </table>

    </div>

    <!-- PAGINACIÓN -->

    <nav>

        <ul class="pagination justify-content-center">

            <!-- ANTERIOR -->

            <?php if ($pagina > 1) { ?>

                <li class="page-item">

                    <a class="page-link"
                        href="?pagina=<?php echo $pagina - 1; ?>&fecha_desde=<?php echo $fecha_desde; ?>&fecha_hasta=<?php echo $fecha_hasta; ?>">

                        Anterior

                    </a>

                </li>

            <?php } ?>

            <!-- NÚMEROS -->

            <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>

                <li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">

                    <a class="page-link"
                        href="?pagina=<?php echo $i; ?>&fecha_desde=<?php echo $fecha_desde; ?>&fecha_hasta=<?php echo $fecha_hasta; ?>">

                        <?php echo $i; ?>

                    </a>

                </li>

            <?php } ?>

            <!-- SIGUIENTE -->

            <?php if ($pagina < $total_paginas) { ?>

                <li class="page-item">

                    <a class="page-link"
                        href="?pagina=<?php echo $pagina + 1; ?>&fecha_desde=<?php echo $fecha_desde; ?>&fecha_hasta=<?php echo $fecha_hasta; ?>">

                        Siguiente

                    </a>

                </li>

            <?php } ?>

        </ul>

    </nav>

    <a class="btn btn-info mt-3" href="index">
        Volver
    </a>

</div>

<?php
$conn->close();
?>