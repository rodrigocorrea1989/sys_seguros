<script>
    function confirmar_eliminar_usuario() {
        var respuesta = confirm("¿Esta seguro que desea Eliminar el usuario?");
        if (respuesta == false) {
            event.preventDefault();
        }
    }

    function confirmar_eliminar_cliente() {
        var respuesta = confirm("¿Esta seguro que desea Eliminar el cliente?");
        if (respuesta == false) {
            event.preventDefault();
        }
    }

    function confirmar_eliminar_seguro() {
        var respuesta = confirm("¿Esta seguro que desea Eliminar el seguro?");
        if (respuesta == false) {
            event.preventDefault();
        }
    }


    function confirmar_pago() {
        var respuesta = confirm("¿Desea confirmar pago?");
        if (respuesta == false) {
            event.preventDefault();
        }
    }

    function eliminar_poliza() {
        var respuesta = confirm("¿Desea eliminar la póliza?");
        if (respuesta == false) {
            event.preventDefault();
        }
    }
</script>