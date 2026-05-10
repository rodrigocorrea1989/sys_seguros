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

    function eliminar_pago() {
        var respuesta = confirm("¿Desea eliminar el pago?");
        if (respuesta == false) {
            event.preventDefault();
        }
    }

    function dar_baja() {
        var respuesta = confirm("¿Desea dar de baja la póliza?");
        if (respuesta == false) {
            event.preventDefault();
        }
    }
</script>