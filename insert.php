<?php
include 'conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asegúrate de que el campo 'nombre' no esté vacío
    if (!empty($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        
        $sql = "INSERT INTO tbl_facultad (id_facultad, nombre) VALUES (NULL, '$nombre')";

        if ($conexion->query($sql) === TRUE) {
            echo "Facultad creada exitosamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    } else {
        echo "El campo 'nombre' es obligatorio.";
    }
}

// Cerrar la conexión $conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: aqua;
            font-family: Arial, sans-serif;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        label {
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>

</head>
<body>
    <h1>INSERTAR FACULTAD</h1>
    <form action="insert.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
