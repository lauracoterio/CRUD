<?php
include 'conexion.php';

    if ($_SERVER ['REQUEST_METHOD'] === 'GET' && isset ($_GET['identificacion'])) { // Proceso para eliminar estudiante
        // Obtener la identificación del estudiante a eliminar
        $identificacion = intval($_GET['identificacion']);
        
        // Consulta SQL para eliminar estudiante por identificación
        $sql = "DELETE FROM tbl_estudiantes_e WHERE identificacion = '$identificacion'";
        
        // Ejecutar la consulta
        if ($conexion->query($sql) === TRUE) {
            header ('Location: select.estudiante.php');
            exit();
        } else {
            header ('Locaton: select.estudiante.php?mensaje=hubo un error');
            exit();
        }
    }

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <title>Formularios</title>
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
        .estudiantes {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container estudiantes">
    <p class="titulo">Eliminar Estudiante</p>
    <form action="" method="post">
        <label for="identificacion">Identificación:</label><br>
        <input type="number" id="identificacion" name="identificacion" required><br><br>
        <!-- Cambiar el valor del botón de envío para eliminar estudiante -->
        <input type="submit" name="eliminar_estudiante" value="Eliminar estudiante">
    </form>
</div>


<!-- SweetAlert2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>
</html>