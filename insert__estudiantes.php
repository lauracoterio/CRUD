<?php
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['crear_estudiante'])) {
        // Proceso para crear estudiante
        $identificacion = mysqli_real_escape_string($conexion, $_POST['identificacion']);
        $nombres = mysqli_real_escape_string($conexion, $_POST['nombres']);
        $apellidos = mysqli_real_escape_string($conexion, $_POST['apellidos']);
        $id_carrera = mysqli_real_escape_string($conexion, $_POST['id_carrera']);
        $id_genero = mysqli_real_escape_string($conexion, $_POST['id_genero']);
        $semestre = mysqli_real_escape_string($conexion, $_POST['semestre']);
        $telefono_celular = mysqli_real_escape_string($conexion, $_POST['telefono_celular']);
        $telefono_fijo = mysqli_real_escape_string($conexion, $_POST['telefono_fijo']);
        $fecha_de_ingreso = mysqli_real_escape_string($conexion, $_POST['fecha_de_ingreso']);
        $saldo_en_deuda = mysqli_real_escape_string($conexion, $_POST['saldo_en_deuda']);

        $sql = "INSERT INTO tbl_estudiantes_e (identificacion, nombres, apellidos, id_carrera, id_genero, semestre, telefono_celular, telefono_fijo, fecha_de_ingreso, saldo_en_deuda) 
        VALUES ('$identificacion', '$nombres', '$apellidos', '$id_carrera', '$id_genero', '$semestre', '$telefono_celular', '$telefono_fijo', '$fecha_de_ingreso', '$saldo_en_deuda')";

        if ($conexion->query($sql) === TRUE) {
            echo '<script>
                swal("¡Estudiante!", "Estudiante matriculado exitosamente", "success");
            </script>';
        } else {
            echo '<script>
                swal("¡Estudiante!", "Error al matricular el estudiante", "error");
            </script>';
        }
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
    <p class="titulo">Crear Estudiante</p>
    <form action="" method="post">
        <label for="identificacion">Identificación:</label><br>
        <input type="number" id="identificacion" name="identificacion" required><br><br>
        <label for="nombres">Nombres:</label><br>
        <input type="text" id="nombres" name="nombres" required><br><br>
        <label for="apellidos">Apellidos:</label><br>
        <input type="text" id="apellidos" name="apellidos" required><br><br>

        
        <label for="id_carrera">Carrera:</label><br>
        <select name="id_carrera" required>
      <option value ="">Seleccione la carrera:</option>
      <?php //ABRIR PHP PARA PODER HACER EL CICLO
        
       if ($resultado_estudiante -> num_rows > 0) { //num rows es la encargada de mostrar las filas de una tabla
        while ($fila = $resultado_estudiante -> fetch_assoc()) {
            echo  '<option value="'.$fila['id_carrera'].'">'.$fila['nombre'].'</option>';
        }
       }else {
        echo '<option value =""> No hay carreras</option>';
       }
      ?>
        </select><br><br>


        <label for="id_genero">Género:</label><br>
        <select name="id_genero" required>
      <option value ="">Seleccione su género:</option>
      <?php //ABRIR PHP PARA PODER HACER EL CICLO
        
       if ($resultado_genero -> num_rows > 0) { //num rows es la encargada de mostrar las filas de una tabla
        while ($fila = $resultado_genero -> fetch_assoc()) {
            echo  '<option value="'.$fila['id_genero'].'">'.$fila['nombre'].'</option>';
        }
       }else {
        echo '<option value =""> No hay géneros</option>';
       }
      ?>
        </select><br><br>

        <label for="semestre">Semestre:</label><br>
        <input type="text" id="semestre" name="semestre" required><br><br>
        <label for="telefono_celular">Teléfono Celular:</label><br>
        <input type="tel" id="telefono_celular" name="telefono_celular" required><br><br>
        <label for="telefono_fijo">Teléfono Fijo:</label><br>
        <input type="tel" id="telefono_fijo" name="telefono_fijo" required><br><br>
        <label for="fecha_de_ingreso">Fecha de Ingreso:</label><br>
        <input type="date" id="fecha_de_ingreso" name="fecha_de_ingreso" required><br><br>
        <label for="saldo_en_deuda">Saldo en Deuda:</label><br>
        
        <input type="number" id="saldo_en_deuda" name="saldo_en_deuda" required><br><br>
        <input type="submit" name="crear_estudiante" value="Matricular Estudiante">
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>
</html>