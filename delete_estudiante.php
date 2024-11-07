<?php
include 'conexion.php';


/*identificacion: Este bloque comprueba que el método de la solicitud sea GET y que exista el parámetro identificacion en la URL. 
Solo se ejecutará el bloque de eliminación si ambas condiciones son verdaderas. El método GET se usa aquí porque los datos se pasan a través de la URL.*/
    if ($_SERVER ['REQUEST_METHOD'] === 'GET' && isset ($_GET['identificacion'])) { // Proceso para eliminar estudiante


        // Obtener la identificación del estudiante a eliminar
        /*La variable $identificacion almacena el valor de $_GET['identificacion'] convertido en un número entero con intval(). Esto ayuda a evitar inyecciones SQL al asegurar que solo se usen números.*/
        $identificacion = intval($_GET['identificacion']);
        

        // Consulta SQL para eliminar estudiante por identificación
        /*Esta consulta elimina el registro en tbl_estudiantes_e donde el valor de identificacion coincida con el valor proporcionado.*/
        $sql = "DELETE FROM tbl_estudiantes_e WHERE identificacion = '$identificacion'";
        
        // Ejecutar la consulta
        if ($conexion->query($sql) === TRUE) {

            /*Si la consulta se ejecuta correctamente, la página redirige al archivo select.estudiante.php (que podría listar los estudiantes).
             header() envía un encabezado HTTP para redirigir, y exit() asegura que el script termine inmediatamente.*/
            header ('Location: select.estudiante.php');
            exit();
        } else {
            /*Si hay un error en la consulta, redirige a select.estudiante.php con un mensaje de error en la URL (?mensaje=hubo un error)*/
            header ('Location: select.estudiante.php?mensaje=hubo un error');
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