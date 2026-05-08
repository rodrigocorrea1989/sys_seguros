<?php

include('header.php');
include('conn.php');
include('alertas.php');
include("comprobar_acceso.php");

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

$sql_total = "SELECT COUNT(ID) as total FROM clientes";
$result_total = $conn->query($sql_total);
$row_total = $result_total->fetch_assoc();

$total_clientes = $row_total['total'];
$total_paginas = ceil($total_clientes / $limite);

// ---------------- CONSULTA PRINCIPAL ----------------

$sql = "SELECT ID, DNI, NOMBRE, APELLIDO, DIRECCION, WHATSAPP, EMAIL 
        FROM clientes 
        ORDER BY ID DESC
        LIMIT $desde, $limite";

$result = $conn->query($sql);

?>

<div class="container mt-3">

    <center>
        <h2 class="mt-3 text-danger">Clientes con Vencimientos</h2>
    </center>


    <table class="table table-danger mt-5">

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
                <th> </th>
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

                                <a class='btn btn-danger' target='_blank' href='polizas_asociadas?id=$id'>

                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-journal-check' viewBox='0 0 16 16'>
                                        <path fill-rule='evenodd' d='M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0'/>
                                        <path d='M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2'/>
                                    </svg>

                                </a>

                            </center>
                        </td>


                    </tr>";
                }
            } else {

                echo "<tr>
                        <td colspan='8'>
                            <center>No hay clientes</center>
                        </td>
                      </tr>";
            }

            ?>

        </tbody>

    </table>

    <!-- PAGINACIÓN -->

    <nav>

        <ul class="pagination justify-content-center">

            <!-- Botón Anterior -->

            <?php if ($pagina > 1) { ?>

                <li class="page-item">
                    <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>">
                        Anterior
                    </a>
                </li>

            <?php } ?>

            <!-- Números -->

            <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>

                <li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">

                    <a class="page-link" href="?pagina=<?php echo $i; ?>">

                        <?php echo $i; ?>

                    </a>

                </li>

            <?php } ?>

            <!-- Botón Siguiente -->

            <?php if ($pagina < $total_paginas) { ?>

                <li class="page-item">
                    <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>">
                        Siguiente
                    </a>
                </li>

            <?php } ?>

        </ul>

    </nav>

    <a class="btn btn-danger" href="index">Volver</a>

</div>

<?php
$conn->close();
?>