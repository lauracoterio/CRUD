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
    <title>Log in</title>
    <style>
        .container {
            background-color: rgb(184, 137, 227);
            padding: 20px;
            margin: 20px auto;
            width: 300px;
            text-align: center;
        }
        .titulo {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .usuario {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container usuario">
    <p class="titulo"><i><b>Log in</b></i></p>
    <form action="" method="post">
        <label for="nombre_usuario">Nombre de usuario:</label><br>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" name="Log_in" value="Log in">
    </form>
</div>
</body>
</html> 
