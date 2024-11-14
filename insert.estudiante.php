<?php
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos.

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Solo ejecuta el bloque si se envía el formulario mediante el método POST.

    // isset verifica si una variable está definida y no es NULL.
    if (isset($_POST['crear_facultad'])) { // Verifica si se envió el formulario con el campo `crear_facultad`.
        // Proceso para crear una facultad

        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']); 
        // Limpia el valor del campo "nombre" para evitar inyecciones SQL.

        // Comando SQL para insertar una nueva facultad
        $sql = "INSERT INTO tbl_facultad_e (id_facultad, nombre) VALUES (NULL, '$nombre')"; 
        // Inserta un nuevo registro en la tabla `tbl_facultad_e` con el nombre ingresado.

        // Ejecuta la consulta y verifica si fue exitosa
        if ($conexion->query($sql) === TRUE) { 
            echo "Facultad creada exitosamente"; // Muestra un mensaje si la creación fue exitosa.
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error; // Muestra un mensaje de error en caso de fallo.
        }
    } elseif (isset($_POST['crear_carrera'])) { // Verifica si se envió el formulario con el campo `crear_carrera`.
        // Proceso para crear una carrera

        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']); 
        // Limpia el valor del campo "nombre" para evitar inyecciones SQL.
        
        $facultad = mysqli_real_escape_string($conexion, $_POST['id_facultad']); 
        // Limpia el valor del campo "id_facultad" para evitar inyecciones SQL.

        // Comando SQL para insertar una nueva carrera
        $sql = "INSERT INTO tbl_carrera_e (nombre, id_facultad) VALUES ('$nombre', '$facultad')"; 
        // Inserta un nuevo registro en la tabla `tbl_carrera_e` con el nombre y el ID de la facultad ingresados.

        // Ejecuta la consulta y verifica si fue exitosa
        if ($conexion->query($sql) === TRUE) {
            echo "Carrera insertada exitosamente"; // Muestra un mensaje si la inserción fue exitosa.
        } else {
            echo "Error al insertar la Carrera"; // Muestra un mensaje de error en caso de fallo.
        }
    } elseif (isset($_POST['crear_estudiante'])) { // Verifica si se envió el formulario con el campo `crear_estudiante`.
        // Proceso para crear un estudiante

        // Limpia y guarda cada valor enviado desde el formulario
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

        // Comando SQL para insertar un nuevo estudiante
        $sql = "INSERT INTO tbl_estudiantes_e (identificacion, nombres, apellidos, id_carrera, id_genero, semestre, telefono_celular, telefono_fijo, fecha_de_ingreso, saldo_en_deuda) 
        VALUES ('$identificacion', '$nombres', '$apellidos', '$id_carrera', '$id_genero', '$semestre', '$telefono_celular', '$telefono_fijo', '$fecha_de_ingreso', '$saldo_en_deuda')";
        // Inserta un nuevo registro en la tabla `tbl_estudiantes_e` con los valores ingresados.

        // Ejecuta la consulta y verifica si fue exitosa
        if ($conexion->query($sql) === TRUE) {
            echo "Estudiante matriculado exitosamente"; // Muestra un mensaje si la matrícula fue exitosa.
        } else {
            echo "Error al matricular el estudiante"; // Muestra un mensaje de error en caso de fallo.
        }
     }
}

// Cierra la conexión a la base de datos
$conexion->close(); // Cierra la conexión para liberar recursos.
?>



<?php
include 'conexion.php';
$sql = "SELECT id_facultad, nombre FROM tbl_facultad_e";////Define una consulta SQL que selecciona las columnas id_facultad y nombre
$resultado = $conexion -> query($sql);//Ejecuta la consulta en la base de datos y guarda el resultado en la variable $resultado
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
    <title>Formularios</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    
    <style>
        .container-custom {
            background-color: rgb(184, 137, 227);
            padding: 20px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .titulo {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <!-- Formulario para crear facultad -->
    <div class="container-custom col-12 col-md-6 col-lg-4 mx-auto mb-4">
        <p class="titulo text-center">Crear Facultad</p>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Facultad:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <button type="submit" name="crear_facultad" class="btn btn-primary w-100">Crear Facultad</button>
        </form>
    </div>

    <!-- Formulario para crear carrera -->
    <div class="container-custom col-12 col-md-6 col-lg-4 mx-auto mb-4">
        <p class="titulo text-center">Crear Carrera</p>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nombre_carrera" class="form-label">Nombre de la Carrera:</label>
                <input type="text" id="nombre_carrera" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="id_facultad" class="form-label">Facultad:</label>
                <select name="id_facultad" class="form-select" required>
                    <option value="">Seleccione una facultad</option>
                    <?php
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo '<option value="'.$fila['id_facultad'].'">'.$fila['nombre'].'</option>';
                        }
                    } else {
                        echo '<option value="">No hay facultades</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="crear_carrera" class="btn btn-primary w-100">Crear Carrera</button>
        </form>
    </div>

    <!-- Formulario para crear estudiante -->
    <div class="container-custom col-12 col-md-6 col-lg-4 mx-auto">
        <p class="titulo text-center">Crear Estudiante</p>
        <form action="" method="post">
            <div class="mb-3">
                <label for="identificacion" class="form-label">Identificación:</label>
                <input type="number" id="identificacion" name="identificacion" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" id="nombres" name="nombres" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control" required>
            </div>
            <div class="mb-3">
            <label for="id_carrera" class="form-label">Carrera:</label>
<!-- Etiqueta para el campo de selección, con el texto "Carrera:" -->

<select name="id_carrera" class="form-select" required>
    <option value="">Seleccione la carrera:</option>
    <?php
    if ($resultado_estudiante->num_rows > 0) {
        // Si hay resultados de la consulta a la base de datos

        while ($fila = $resultado_estudiante->fetch_assoc()) {
            // Recorre cada fila de resultados

            echo '<option value="'.$fila['id_carrera'].'">'.$fila['nombre'].'</option>';
            // Imprime cada carrera como opción: el id de la carrera como valor y su nombre como texto
        }
    } else {
        // Si no hay resultados en la base de datos

        echo '<option value="">No hay carreras</option>';
        // Muestra la opción "No hay carreras"
    }
    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_genero" class="form-label">Género:</label>
                <select name="id_genero" class="form-select" required>
                    <option value="">Seleccione su género:</option>
                    <?php
                    if ($resultado_genero->num_rows > 0) {
                        while ($fila = $resultado_genero->fetch_assoc()) {
                            echo '<option value="'.$fila['id_genero'].'">'.$fila['nombre'].'</option>';
                        }
                    } else {
                        echo '<option value="">No hay géneros</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="semestre" class="form-label">Semestre:</label>
                <input type="text" id="semestre" name="semestre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telefono_celular" class="form-label">Teléfono Celular:</label>
                <input type="tel" id="telefono_celular" name="telefono_celular" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telefono_fijo" class="form-label">Teléfono Fijo:</label>
                <input type="tel" id="telefono_fijo" name="telefono_fijo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="fecha_de_ingreso" class="form-label">Fecha de Ingreso:</label>
                <input type="date" id="fecha_de_ingreso" name="fecha_de_ingreso" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="saldo_en_deuda" class="form-label">Saldo en Deuda:</label>
                <input type="number" id="saldo_en_deuda" name="saldo_en_deuda" class="form-control" required>
            </div>
            <button type="submit" name="crear_estudiante" class="btn btn-primary w-100">Matricular Estudiante</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
