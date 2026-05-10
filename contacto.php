<?php

include('header.php');
include('conn.php');
include('alertas.php');
include("comprobar_acceso.php");

?>


<div class="container">

    <center>
        <h1 class="text-primary mt-5">Contacto</h1>
    </center>

    <div class="row justify-content-center">

        <div class="col-md-10">

            <div class="card shadow border-0">

                <div class="card-body p-5">

                    <h2 class="text-center mb-4">
                        Información Legal y Soporte
                    </h2>

                    <div class="alert alert-primary">
                        <strong>1.</strong> Todos los derechos reservados © SYS_SEGUROS.
                    </div>

                    <div class="alert alert-secondary">
                        <strong>2.</strong> Sistema registrado bajo derecho de autor.
                    </div>

                    <div class="alert alert-warning">
                        <strong>3.</strong> Los reclamos técnicos deben realizarse mediante el correo:
                        <br><br>

                        <strong>Email:</strong>
                        <a href="mailto:coatisitemas@gmail.com?subject=Soporte%20Técnico">
                            coatisitemas@gmail.com
                        </a>

                        <br>

                        <strong>Asunto:</strong> "Soporte Técnico"
                    </div>

                    <div class="alert alert-info">
                        <strong>4.</strong> Todas las mejoras y actualizaciones tendrán un <strong>costo adicional</strong> a cotizar.
                        <br><br>

                        Las solicitudes deben enviarse a:

                        <br>

                        <strong>Email:</strong>
                        <a href="mailto:coatisitemas@gmail.com?subject=Soporte%20Funcional">
                            coatisitemas@gmail.com
                        </a>

                        <br>

                        <strong>Asunto:</strong> "Soporte Funcional"
                    </div>

                    <div class="text-center mt-4">
                        <small class="text-muted">
                            © <?php echo date('Y'); ?> SYS_SEGUROS - Todos los derechos reservados.
                        </small>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>