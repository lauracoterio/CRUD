<?php
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos.

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Verifica si la solicitud fue enviada usando el método POST.
    if (isset($_POST['registrarse'])) { // Verifica si se envió el formulario de registro.

        // Escapar los valores para evitar inyecciones SQL
        $nombre_usuario = mysqli_real_escape_string($conexion, $_POST['nombre_usuario']); // Escapa el nombre de usuario para evitar inyecciones SQL.
        $password = mysqli_real_escape_string($conexion, $_POST['password']); // Escapa la contraseña ingresada.
        $correo = mysqli_real_escape_string($conexion, $_POST['correo']); // Escapa el correo ingresado.

        // Cifrar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Cifra la contraseña usando un hash seguro.

        // PREPARAR la consulta con placeholders
        $stmt = $conexion->prepare("INSERT INTO tbl_login (nombre_usuario, password, correo) VALUES (?, ?, ?)"); 
        // Prepara la consulta SQL con marcadores de posición para evitar inyecciones SQL.

        // ASIGNAR los parámetros
        $stmt->bind_param("sss", $nombre_usuario, $hashed_password, $correo); 
        // Vincula el nombre de usuario, contraseña cifrada y correo a los marcadores de posición de la consulta.

        // EJECUTAR la consulta
        if ($stmt->execute()) { // Ejecuta la consulta SQL.
            echo "¡Registrado! El usuario ha sido registrado correctamente"; // Muestra un mensaje si el registro fue exitoso.
        } else {
            echo "Error: No se pudo registrar el usuario"; // Muestra un mensaje si hubo un error en el registro.
        }

        // Cerrar la declaración preparada
        $stmt->close(); // Cierra la declaración preparada.
    }
}

// Cerrar la conexión a la base de datos
$conexion->close(); // Cierra la conexión a la base de datos.
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