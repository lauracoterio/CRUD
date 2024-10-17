<?php
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //solo funciona si se llena el formulario por el método post

    if (isset($_POST['crear_facultad'])) {
        // Proceso para crear facultad
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);

        $sql = "INSERT INTO tbl_facultad_e (id_facultad, nombre) VALUES (NULL, '$nombre')";

        if ($conexion->query($sql) === TRUE) {
            echo "Facultad creada exitosamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    } elseif (isset($_POST['crear_carrera'])) {
        // Proceso para crear carrera
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $facultad = mysqli_real_escape_string($conexion, $_POST['id_facultad']);

        $sql = "INSERT INTO tbl_carrera_e (nombre, id_facultad) VALUES ('$nombre', '$facultad')";

        if ($conexion->query($sql) === TRUE) {
            echo '<script>
                swal("¡Carrera!", "Carrera insertada exitosamente", "success");
            </script>';
        } else {
            echo '<script>
                swal("¡Carrera!", "Error al insertar la Carrera", "error");
            </script>';
        }
    } elseif (isset($_POST['crear_estudiante'])) {
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
     }elseif (isset($_POST['eliminar_estudiante'])) { // Proceso para eliminar estudiante
        // Obtener la identificación del estudiante a eliminar
        $identificacion = mysqli_real_escape_string($conexion, $_POST['identificacion']);
        
        // Consulta SQL para eliminar estudiante por identificación
        $sql = "DELETE FROM tbl_estudiantes_e WHERE identificacion = '$identificacion'";
        
        // Ejecutar la consulta
        if ($conexion->query($sql) === TRUE) {
            echo '<script>
                swal("¡Estudiante Eliminado!", "El estudiante ha sido eliminado correctamente", "success");
            </script>';
        } else {
            echo '<script>
                swal("Error", "No se pudo eliminar el estudiante", "error");
            </script>';
        }
    }


}

$conexion->close();
?>


<?php
include 'conexion.php';
$sql = "SELECT id_facultad, nombre FROM tbl_facultad_e";
$resultado = $conexion -> query($sql);
?>

<?php
include 'conexion.php';
$sql = "SELECT id_carrera, nombre FROM tbl_carrera_e";
$resultado_estudiante = $conexion -> query($sql);
?>

<?php
include 'conexion.php';
$sql = "SELECT id_genero, nombre FROM tbl_genero_e";
$resultado_genero = $conexion -> query($sql);
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

<div class="container estudiantes"> <!--CREAR EL CLASS CON DOS NOMBRES PARA QUE EN EL SEGUNDO ESTÉ LA SEPARACIÓN DE LOS FORMULARIOS-->
    <p class="titulo">Crear Facultad</p>
    <form action="" method="post">
        <label for="nombre">Nombre de la Facultad:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <input type="submit" name="crear_facultad" value="Crear Facultad">
    </form>
</div>

<div class="container estudiantes">
    <p class="titulo">Crear Carrera</p>
    <form action="" method="post">
        <label for="nombre_carrera">Nombre de la Carrera:</label><br>
        <input type="text" id="nombre_carrera" name="nombre" required><br><br>

        <label for="id_facultad">Facultad:</label><br>
        <select name="id_facultad" required>
      <option value ="">Seleccione una facultad</option>
      <?php //ABRIR PHP PARA PODER HACER EL CICLO
        
       if ($resultado -> num_rows > 0) { //num rows es la encargada de mostrar las filas de una tabla
        while ($fila = $resultado -> fetch_assoc()) {
            echo  '<option value="'.$fila['id_facultad'].'">'.$fila['nombre'].'</option>';
        }
       }else {
        echo '<option value = ""> No hay facultades</option>';
       }
      ?>
        </select><br><br>

        <input type="submit" name="crear_carrera" value="Crear Carrera">
    </form>
</div>

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