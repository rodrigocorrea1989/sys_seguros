<?php

include('header.php');

include('conn.php');

include('alertas.php');

include("comprobar_acceso.php");

// Consulta SQL para obtener datos
$sql = "SELECT id , nombre, descripcion , precio, dias  FROM seguros ORDER BY id DESC";
$result = $conn->query($sql);

?>

<div class="container-fluid mt-3">
    <center>
        <h2 class="mt-3 text-success">Seguros </h2>
    </center>
    <a class="mt-2 btn btn-success" href="nuevo_seguro">Crear Seguro</a>
    <table class="table mt-2">
        <thead class="thead-dark">
            <tr>
                <th scope="col">
                    <center>Nombre</center>
                </th>
                <th scope="col">
                    <center>Descripción</center>
                </th>
                <th scope="col">
                    <center>Precio</center>
                </th>
                <th scope="col">
                    <center>Vencimiento</center>
                </th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($result)) {
                if ($result->num_rows > 0) {
                    // Salida de datos por cada fila
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $nombre = $row["nombre"];
                        $descripcion = $row["descripcion"];
                        $precio = $row["precio"];
                        $dias = $row["dias"];
                        echo "<tr>
                                    <th scope='row'><center>" . $nombre . "</center></th>
                                    <td>" . $descripcion . "</td>
                                    <td><center>" . $precio . "$</center></td>
                                    <td><center>" . $dias . " Días</center></td>
                                    <td><a class='btn btn-success mr-2' href='editar_seguro?id=$id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
  <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
  <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
</svg>
</a></td><td><a class='btn btn-danger' href='eliminar_seguro?id=$id' onclick='confirmar_eliminar_seguro()'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
  <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5'/>
</svg>
</a></td>
                                </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>0 resultados</td></tr>";
                }
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    </table>
    <a class="btn btn-success" href="index">Volver</a>

</div>