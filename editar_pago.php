<?php

include('header.php');
include('conn.php');
include("comprobar_acceso.php");

$id_pago = intval($_GET['id'] ?? 0);

$id_cliente = intval($_GET['cliente'] ?? 0);

$id_poliza = intval($_GET['id_poliza'] ?? 0);


//echo $id_pago . "<br>";

//echo $id_poliza . "<br>";

//echo $id_cliente . "<br>";

if (!$id_pago) {
    die("ID de pago inválido");
}

/*
|--------------------------------------------------------------------------
| OBTENER DATOS DEL PAGO
|--------------------------------------------------------------------------
*/

$sql = "
SELECT 
    pagos.id,
    pagos.monto,
    pagos.fecha_creacion,
    pagos.fecha_vencimiento,
    pagos.pagado,
    
    polizas.id AS id_poliza,
    
    seguros.nombre AS nombre_seguro,
    seguros.dias AS dias_seguro

FROM pagos

INNER JOIN polizas 
    ON pagos.id_poliza = polizas.id

INNER JOIN seguros 
    ON polizas.id_seguro = seguros.id

WHERE pagos.id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_pago);

if (!$stmt->execute()) {
    die("Error SQL: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("No se encontró el pago");
}

$row = $result->fetch_assoc();

/*
|--------------------------------------------------------------------------
| VARIABLES
|--------------------------------------------------------------------------
*/

$monto = $row['monto'];
$fecha_creacion = $row['fecha_creacion'];
$fecha_vencimiento = $row['fecha_vencimiento'];
$pagado = $row['pagado'];
$nombre_seguro = $row['nombre_seguro'];
$dias_seguro = $row['dias_seguro'];
$id_poliza = $row['id_poliza'];

?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>Editar Pago</h3>
        </div>

        <div class="card-body">

            <form action="<?php echo dirname($_SERVER['PHP_SELF']); ?>/actualizar_pago" method="POST">

                <input
                    type="hidden"
                    name="id_pago"
                    value="<?php echo $id_pago; ?>">

                <div class="row">

                    <!-- SEGURO -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Seguro
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?php echo $nombre_seguro; ?>"
                            readonly>

                    </div>

                    <!-- MONTO -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Monto
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="monto"
                            class="form-control"
                            value="<?php echo $monto; ?>"
                            required>

                    </div>

                    <!-- FECHA CREACION -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Fecha Creación
                        </label>

                        <input
                            type="datetime-local"
                            name="fecha_creacion"
                            class="form-control"
                            value="<?php echo date('Y-m-d\TH:i', strtotime($fecha_creacion)); ?>"
                            required>

                    </div>

                    <!-- FECHA VENCIMIENTO -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Fecha Vencimiento
                        </label>

                        <input
                            type="datetime-local"
                            name="fecha_vencimiento"
                            class="form-control"
                            value="<?php echo date('Y-m-d\TH:i', strtotime($fecha_vencimiento)); ?>"
                            required>

                    </div>

                    <!-- DIAS -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Días del Seguro
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            value="<?php echo $dias_seguro; ?>"
                            readonly>

                    </div>

                    <!-- ESTADO -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Estado
                        </label>

                        <select
                            name="pagado"
                            class="form-control">
                            <option
                                value="0"
                                <?php if ($pagado == 0) echo "selected"; ?>>
                                No Pagado
                            </option>

                            <option
                                value="1"
                                <?php if ($pagado == 1) echo "selected"; ?>>
                                Pagado
                            </option>
                        </select>

                    </div>

                </div>

                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-success">
                        Guardar Cambios
                    </button>

                    <a
                        href="javascript:history.back()"
                        class="btn btn-secondary">
                        Volver
                    </a>

                </div>

                <input type="hidden" name="id" value="<?php echo $id_cliente ?>">

                <input type="hidden" name="id_poliza" value="<?php echo $id_poliza ?>">

            </form>

        </div>

    </div>

</div>

<?php include('footer.php'); ?>