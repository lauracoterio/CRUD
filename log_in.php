<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturamos el usuario y la contraseña ingresados
    $nombre_usuario = $_POST["nombre_usuario"];
    $password = $_POST["password"];

    // Preparar la consulta SQL para obtener id y password del usuario
    $stmt = $conexion->prepare("SELECT id, password FROM tbl_login WHERE nombre_usuario = ?");
    
    // Asociar el valor de $nombre_usuario al marcador de posición
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();

    // Almacenamos el resultado
    $stmt->store_result();

    // Verificamos si existe algún resultado
    if ($stmt->num_rows > 0) {
        // Asociamos los resultados a variables
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verificamos la contraseña ingresada contra el hash almacenado
        if (password_verify($password, $hashed_password)) {
            // Iniciamos sesión y redirigimos
            $_SESSION["id"] = $id;
            $_SESSION["nombre_usuario"] = $nombre_usuario;
            header("location: select.estudiante.php");
            exit();
        } else {
            echo "Error, contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }

    // Cerramos la conexión
    $stmt->close();
    $conexion->close();
}
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
        <p class="titulo fs-4 text-center mb-4"><i><b>LOG IN</b></i></p>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de usuario:</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <button type="submit" name="log in" class="btn btn-primary w-100">Log in</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
