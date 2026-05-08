<?php
include('header.php');

include('conn.php');

include("comprobar_acceso.php");
// Obtener el ID del usuario a editar
$id = $_GET['id'];

// Consulta para obtener los datos actuales del usuario
$sql = "SELECT NOMBRE , APELLIDO, USUARIO, PASS, TIPO FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container col-md-4 mt-1 mb-5">
        <div class="card">
            <div class="card-header">
                <h2 class="text-success">Editar Usuario</h2>
                <form method="POST" action="actualizar_usuario?id=<?php echo $id; ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $user['NOMBRE']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $user['APELLIDO']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $user['USUARIO']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contraseña">Contraseña</label>
                        <input type="password" class="form-control" id="contraseña" value="<?php echo $user['PASS']; ?>" name="contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a class="btn btn-primary" href="usuarios">Volver</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>