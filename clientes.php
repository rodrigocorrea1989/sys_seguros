<?php

include('header.php');
include('conn.php');
include('alertas.php');
include("comprobar_acceso.php");

// ---------------- FILTRO ----------------

$buscar = trim($_GET['buscar'] ?? '');

// ---------------- PAGINACIÓN ----------------

// Cantidad de clientes por página
$limite = 5;

// Página actual
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

if ($pagina < 1) {
    $pagina = 1;
}

// Desde qué registro comenzar
$desde = ($pagina - 1) * $limite;

// ---------------- TOTAL DE CLIENTES ----------------

if ($buscar != '') {

    $sql_total = "SELECT COUNT(ID) as total 
                  FROM clientes
                  WHERE DNI LIKE '%$buscar%'
                  OR NOMBRE LIKE '%$buscar%'
                  OR APELLIDO LIKE '%$buscar%'
                  OR CONCAT(NOMBRE, ' ', APELLIDO) LIKE '%$buscar%'";
} else {

    $sql_total = "SELECT COUNT(ID) as total FROM clientes";
}

$result_total = $conn->query($sql_total);
$row_total = $result_total->fetch_assoc();

$total_clientes = $row_total['total'];
$total_paginas = ceil($total_clientes / $limite);

// ---------------- CONSULTA PRINCIPAL ----------------

if ($buscar != '') {

    $sql = "SELECT ID, DNI, NOMBRE, APELLIDO, DIRECCION, WHATSAPP, EMAIL 
            FROM clientes
            WHERE DNI LIKE '%$buscar%'
            OR NOMBRE LIKE '%$buscar%'
            OR APELLIDO LIKE '%$buscar%'
            OR CONCAT(NOMBRE, ' ', APELLIDO) LIKE '%$buscar%'
            ORDER BY ID DESC
            LIMIT $desde, $limite";
} else {

    $sql = "SELECT ID, DNI, NOMBRE, APELLIDO, DIRECCION, WHATSAPP, EMAIL 
            FROM clientes 
            ORDER BY ID DESC
            LIMIT $desde, $limite";
}

$result = $conn->query($sql);

?>

<div class="container mt-3">

    <center>
        <h2 class="mt-3 text-info">Clientes</h2>
    </center>

    <a class="mt-2 btn btn-info" href="nuevo_cliente">
        Nuevo Cliente
    </a>

    <!-- FILTRO -->

    <form method="GET" class="mt-3 mb-3">

        <div class="row">

            <div class="col-md-10">

                <input
                    type="text"
                    name="buscar"
                    class="form-control"
                    placeholder="Buscar por DNI o Nombre"
                    value="<?php echo htmlspecialchars($buscar); ?>">

            </div>

            <div class="col-md-2">

                <button type="submit" class="btn btn-primary w-100">
                    Buscar
                </button>

            </div>

        </div>

    </form>

    <table class="table mt-2">

        <thead class="thead-dark">

            <tr>

                <th>
                    <center>Dni/Cuit</center>
                </th>

                <th>
                    <center>Nombre</center>
                </th>

                <th>
                    <center>Apellido</center>
                </th>

                <th>
                    <center>Dirección</center>
                </th>

                <th>
                    <center>Teléfono</center>
                </th>

                <th>
                    <center>E-mail</center>
                </th>

                <th></th>
                <th></th>

            </tr>

        </thead>

        <tbody>

            <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    $id = $row["ID"];
                    $dni = $row["DNI"];
                    $NOMBRE = $row["NOMBRE"];
                    $APELLIDO = $row["APELLIDO"];
                    $DIRECCION = $row["DIRECCION"];
                    $WHATSAPP = $row["WHATSAPP"];
                    $EMAIL = $row["EMAIL"];

                    echo "

                    <tr>

                        <th scope='row'>
                            <center>$dni</center>
                        </th>

                        <td>
                            <center>$NOMBRE</center>
                        </td>

                        <td>
                            <center>$APELLIDO</center>
                        </td>

                        <td>
                            <center>$DIRECCION</center>
                        </td>

                        <td>
                            <center>$WHATSAPP</center>
                        </td>

                        <td>
                            <center>$EMAIL</center>
                        </td>

                        <td>

                            <center>

                                <a class='btn btn-primary' href='polizas_asociadas?id=$id'>

                                    <svg xmlns='http://www.w3.org/2000/svg'
                                         width='16'
                                         height='16'
                                         fill='currentColor'
                                         class='bi bi-journal-check'
                                         viewBox='0 0 16 16'>

                                        <path fill-rule='evenodd'
                                              d='M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0'/>

                                        <path d='M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2'/>

                                    </svg>

                                </a>

                            </center>

                        </td>

                        <td>

                            <a class='btn btn-success mr-2'
                               href='editar_cliente?id=$id'>

                                <svg xmlns='http://www.w3.org/2000/svg'
                                     width='16'
                                     height='16'
                                     fill='currentColor'
                                     class='bi bi-pencil-square'
                                     viewBox='0 0 16 16'>

                                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>

                                </svg>

                            </a>

                            <a class='btn btn-danger'
                               href='eliminar_cliente?id=$id'
                               onclick='return confirmar_eliminar_cliente()'>

                                <svg xmlns='http://www.w3.org/2000/svg'
                                     width='16'
                                     height='16'
                                     fill='currentColor'
                                     class='bi bi-trash3-fill'
                                     viewBox='0 0 16 16'>

                                    <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5'/>

                                </svg>

                            </a>

                        </td>

                    </tr>
                    ";
                }
            } else {

                echo "
                <tr>

                    <td colspan='8'>
                        <center>No hay clientes</center>
                    </td>

                </tr>
                ";
            }

            ?>

        </tbody>

    </table>

    <!-- PAGINACIÓN -->

    <nav>

        <ul class="pagination justify-content-center">

            <!-- ANTERIOR -->

            <?php if ($pagina > 1) { ?>

                <li class="page-item">

                    <a class="page-link"
                        href="?pagina=<?php echo $pagina - 1; ?>&buscar=<?php echo urlencode($buscar); ?>">

                        Anterior

                    </a>

                </li>

            <?php } ?>

            <!-- NÚMEROS -->

            <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>

                <li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">

                    <a class="page-link"
                        href="?pagina=<?php echo $i; ?>&buscar=<?php echo urlencode($buscar); ?>">

                        <?php echo $i; ?>

                    </a>

                </li>

            <?php } ?>

            <!-- SIGUIENTE -->

            <?php if ($pagina < $total_paginas) { ?>

                <li class="page-item">

                    <a class="page-link"
                        href="?pagina=<?php echo $pagina + 1; ?>&buscar=<?php echo urlencode($buscar); ?>">

                        Siguiente

                    </a>

                </li>

            <?php } ?>

        </ul>

    </nav>

    <a class="btn btn-info" href="index">
        Volver
    </a>

</div>

<?php
$conn->close();
?>