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


$sql = "SELECT DISTINCT
            clientes.ID,
            clientes.DNI,
            clientes.NOMBRE,
            clientes.APELLIDO,
            clientes.DIRECCION,
            clientes.WHATSAPP,
            clientes.EMAIL
        FROM clientes
        INNER JOIN polizas 
            ON polizas.id_cliente = clientes.ID
        INNER JOIN pagos 
            ON pagos.id_poliza = polizas.id
        WHERE pagos.ven = 1 AND pagos.pagado=0
        ORDER BY clientes.ID DESC
        LIMIT $desde, $limite";

$result = $conn->query($sql);

?>

<div class="container mt-3">

    <center>
        <h2 class="mt-3 text-danger">Clientes con Vencimientos y pendientes de Pago</h2>
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
                    $np = $NOMBRE . ' ' . $APELLIDO;
                    $wp = $WHATSAPP;
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
                        <td>
                            <center>
                                <a class='btn btn-success' 
                                target='_blank' 
                                href='https://wa.me/$wp?text=Estimado%20cliente%20$np%20le%20informamos%20que%20en%20el%20día%20de%20la%20fecha%20tiene%20un%20saldo%20pendiente.'>

                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-whatsapp' viewBox='0 0 16 16'>
                                        <path d='M13.601 2.326A7.854 7.854 0 0 0 8.004 0C3.58 0 .003 3.577.003 8c0 1.409.369 2.784 1.07 3.995L0 16l4.117-1.053A7.95 7.95 0 0 0 8.004 16c4.423 0 8-3.577 8-8a7.95 7.95 0 0 0-2.403-5.674M8.004 14.5a6.47 6.47 0 0 1-3.301-.902l-.236-.141-2.443.625.652-2.381-.154-.245A6.47 6.47 0 0 1 1.504 8a6.5 6.5 0 1 1 6.5 6.5'/>
                                        <path d='M11.387 9.461c-.209-.104-1.236-.61-1.428-.679-.191-.07-.331-.105-.47.105-.139.209-.539.679-.661.818-.122.139-.244.157-.453.052-.209-.104-.882-.325-1.68-1.036-.62-.552-1.039-1.234-1.161-1.443-.122-.209-.013-.322.092-.426.094-.093.209-.244.314-.366.104-.122.139-.209.209-.348.07-.139.035-.261-.017-.366-.052-.104-.47-1.131-.644-1.548-.17-.408-.344-.353-.47-.359l-.401-.007c-.139 0-.366.052-.557.261-.191.209-.731.714-.731 1.74 0 1.026.748 2.017.852 2.156.104.139 1.472 2.248 3.568 3.151.499.215.888.344 1.191.44.5.159.955.137 1.314.083.401-.06 1.236-.505 1.411-.992.174-.487.174-.905.122-.992-.052-.087-.191-.139-.401-.244'/>
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