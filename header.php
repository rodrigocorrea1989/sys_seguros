<?php

ob_start();

session_start();

error_reporting(1);

date_default_timezone_set('America/Argentina/Buenos_Aires');

if (!isset($_SESSION['usuario'])) {

    echo "<style>#salir{ display:none !important; } </style>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="casco.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <title>Sys Seguros</title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index">Sys Seguros</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

        <!-- Menú izquierdo -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="usuarios">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="clientes">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="seguros">Seguros</a>
            </li>
        </ul>

        <!-- Botón extremo derecho -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="logout" id="salir" class="btn btn-outline-success">
                    Cerrar sesión
                </a>
            </li>
        </ul>

    </div>
</nav>


<body>