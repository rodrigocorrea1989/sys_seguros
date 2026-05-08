<?php

include('header.php');

include("comprobar_acceso.php");

?>

<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Crear Usuario</h3>
                </div>
                <div class="card-body">
                    <form action="insertar_usuario" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa tu nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingresa tu apellido">
                        </div>
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingresa tu nombre de usuario">
                        </div>
                        <div class="form-group">
                            <label for="contraseña">Contraseña</label>
                            <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Ingresa tu contraseña">
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <a class="btn btn-primary" href="usuarios">Volver</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>