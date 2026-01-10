<?php

include('header.php');
include('conn.php');
include("comprobar_acceso.php");

?>

<div class="container-fluid mt-4">
    <center>
        <h1 class="text-primary m-3">Facturación</h1>
    </center>
    <div class="card">
        <div class="card-body">
            <div class="row text-center">

                <div class="col-md-3 p-3">
                    <h4 class="text-primary mt-3">Seguro de Salud</h4>
                </div>

                <div class="col-md-2 p-3">
                    <h5>Fecha Creación</h5>
                    <p>10/01/2026 03:09</p>
                </div>

                <div class="col-md-2 p-3">
                    <h5>Fecha Vencimiento</h5>
                    <p>09/02/2026 03:09</p>
                </div>

                <div class="col-md-2 p-3">
                    <h5>Estado</h5>
                    <p class="text-danger"><strong>Vencido</strong></p>
                </div>

                <div class="col-md-1 p-3">
                    <h5>Monto</h5>
                    <p class="text-danger"><strong>2.1580 $</strong></p>
                </div>

                <div class="col-md-1 p-3 mt-3">
                    <a class="btn btn-danger">Cobrar</a>
                </div>

            </div>

        </div>
    </div>

</div>