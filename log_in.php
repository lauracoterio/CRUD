<?php
session_start(); // Inicia la sesión para almacenar y acceder a datos de sesión del usuario.
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos.

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verifica si la solicitud fue enviada usando el método POST.
    // CAPTURAR el usuario y la contraseña ingresados
    $nombre_usuario = $_POST["nombre_usuario"]; // Obtiene el nombre de usuario del formulario.
    $password = $_POST["password"]; // Obtiene la contraseña ingresada.

    // PREPARAR la consulta SQL para obtener id y password del usuario
    $stmt = $conexion->prepare("SELECT id, password FROM tbl_login WHERE nombre_usuario = ?"); 

    
    $stmt->bind_param("s", $nombre_usuario); // VINCULA el nombre de usuario al marcador de posición.
    $stmt->execute(); // EJECUTA la consulta SQL.

    // Almacenamos el resultado
    $stmt->store_result(); 

    // Verificamos si existe algún resultado
    if ($stmt->num_rows > 0) { // Verifica si hay al menos una fila en el resultado.
        // Asociamos los resultados a variables
        $stmt->bind_result($id, $hashed_password); // Vincula el resultado de la consulta a las variables.
        $stmt->fetch(); // Obtiene los valores del resultado de la consulta.

        // Verificamos la contraseña ingresada contra el hash almacenado
        if (password_verify($password, $hashed_password)) { // Compara la contraseña ingresada con la almacenada en la base de datos.
            // Iniciamos sesión y redirigimos
            $_SESSION["id"] = $id; // Guarda el ID del usuario en la sesión.
            $_SESSION["nombre_usuario"] = $nombre_usuario; // Guarda el nombre de usuario en la sesión.
            header("location: select.estudiante.php"); // Redirige al usuario a otra página.
            exit(); // Termina el script para evitar ejecutar el resto del código.
        } else {
            echo "Error, contraseña incorrecta"; // Muestra un mensaje si la contraseña es incorrecta.
        }
    } else {
        echo "Usuario no encontrado"; // Muestra un mensaje si no se encuentra el usuario.
    }

    // Cerramos la conexión
    $stmt->close(); // Cierra la declaración preparada.
    $conexion->close(); // Cierra la conexión a la base de datos.
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
