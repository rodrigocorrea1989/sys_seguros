<?php
include('header.php');
include('conn.php');
include("comprobar_acceso.php");

// Obtener el ID del cliente seleccionado
$id_cliente = $_GET['id'];

// Recuperar los datos del cliente
$query = "SELECT * FROM clientes WHERE id = $id_cliente";
$resultado = mysqli_query($conn, $query);
$cliente = mysqli_fetch_assoc($resultado);
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Editar Cliente</h3>
                </div>
                <div class="card-body">
                    <form action="actualizar_cliente" method="POST">
                        <div class="form-group">
                            <label for="dni">Dni</label>
                            <input type="number" class="form-control text-danger" name="dni" id="dni" placeholder="Ingresa dni del cliente" value="<?php echo $cliente['DNI']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control text-danger" name="nombre" id="nombre" placeholder="Ingresa nombre del cliente" value="<?php echo $cliente['NOMBRE']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control text-danger" name="apellido" id="apellido" placeholder="Ingresa apellido del cliente" value="<?php echo $cliente['APELLIDO']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control text-danger" name="direccion" id="direccion" placeholder="Ingresa dirección del cliente" value="<?php echo $cliente['DIRECCION']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="wp">Télefono</label><br>
                            <span class="text-danger">No utilizar caracteres especiales como guiones o puntos.</span>
                            <input type="number" class="form-control text-danger" name="wp" id="wp" placeholder="Ejemplo: 541111223344" value="<?php echo $cliente['WHATSAPP']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="mail">E-mail</label>
                            <input type="email" class="form-control text-danger" name="mail" id="mail" placeholder="Ingresa correo electrónico del cliente" value="<?php echo $cliente['EMAIL']; ?>">
                        </div>
                        <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
                        <button type="submit" class="btn btn-info">Actualizar</button>
                        <a class="btn btn-info" href="clientes">Volver</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>