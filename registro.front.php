<?php
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['registrarse'])) {

        // Escapar los valores para evitar inyecciones SQL
        $nombre_usuario = mysqli_real_escape_string($conexion, $_POST['nombre_usuario']);
        $password = mysqli_real_escape_string($conexion, $_POST['password']);
        $correo = mysqli_real_escape_string($conexion, $_POST['correo']);

        // Cifrar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta con placeholders
        $stmt = $conexion->prepare("INSERT INTO tbl_login (nombre_usuario, password, correo) VALUES (?, ?, ?)");

        // Asignar los parámetros
        $stmt->bind_param("sss", $nombre_usuario, $hashed_password, $correo);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "¡Registrado! El usuario ha sido registrado correctamente";
        } else {
            echo "Error: No se pudo registrar el usuario";
        }

        // Cerrar la declaración preparada
        $stmt->close();
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        .container-custom {
            background-color: rgb(220, 162, 248);
            padding: 20px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container mt-5 d-flex justify-content-center">
    <div class="container-custom col-12 col-md-6 col-lg-4">
        <p class="titulo fs-4 text-center mb-4"><i><b>Registrarse</b></i></p>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de usuario:</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" id="correo" name="correo" class="form-control" required>
            </div>

            <button type="submit" name="registrarse" class="btn btn-primary w-100">Registrarse</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>