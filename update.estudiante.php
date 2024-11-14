<?php

include 'conexion.php'; //archivo de conexion para poder conectarse a la base de datos


//Verifica si el formulario fue enviado
if (isset($_POST['actualizar'])) { // Si se encuentra el método POST, capturar las variables
  
    //mysqli_rela_escape_string sirve para que no se pueda acceder a la base de datos
    $identificacion = mysqli_real_escape_string($conexion, $_POST['identificacion']);
    $nombres = mysqli_real_escape_string($conexion, $_POST['nombres']);
    $apellidos = mysqli_real_escape_string($conexion, $_POST['apellidos']);
    $semestre = mysqli_real_escape_string($conexion, $_POST['semestre']);

    // La consulta para actulizar los datos
    $sql = "UPDATE tbl_estudiantes_e
   
            SET nombres = '$nombres', apellidos = '$apellidos', semestre = '$semestre' 
            WHERE tbl_estudiantes_e.identificacion = '$identificacion'";

    //Condicional para que se muestre un mendaje de si se puso hacer la consulta o no
    if ($conexion->query($sql) === TRUE) {
        echo "Actualizado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

//verifica si hay algún valor asignado en ese campo
if (isset($_GET['identificacion'])) {

    //se guarda el valor del get y se guarde en la variable identificacfion, en la cual se hará la consulta
    $identificacion = $_GET['identificacion'];

    // Consulta para obtener el estudiante 
    //examina todos los valores de tbl_estudiantes_e y selecciona el valor que coincida con $identificacion, así es más específico
    $sql = "SELECT * FROM tbl_estudiantes_e WHERE identificacion = '$identificacion'";
    //El resultado de esta consulta se almacena en la variable $resultado.
    $resultado = $conexion->query($sql);

    // Verificar si se encontró el estudiante
    //num_rows cuenta cuántos registros devolvió la consulta, Si el número de filas es mayor que 0, eso indica que se encontró al menos un estudiante con esa identificación
    if ($resultado->num_rows > 0) {
//obtiene el primer registro (en este caso, debería ser el único) en un formato de array asociativo, lo que permite acceder a cada campo del estudiante como $fila. Esta línea guarda los datos en la variable $fila.
        $fila = $resultado->fetch_assoc();
    } else {
        echo "Estudiante no encontrado";
        exit; // Detener la ejecución si no se encuentra
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Estudiante</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .container-custom {
            background-color: rgb(184, 137, 227);
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
        <p class="titulo fs-4 text-center mb-4">Actualizar Estudiante</p>
        <form action="" method="post">
            <!-- Campo oculto de identificación -->
            <input type="hidden" name="identificacion" value="<?php echo $fila['identificacion']; ?>">

            <!-- Campo de Nombres -->
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo $fila['nombres']; ?>" required>
            </div>

            <!-- Campo de Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo $fila['apellidos']; ?>" required>
            </div>

            <!-- Campo de Semestre -->
            <div class="mb-3">
                <label for="semestre" class="form-label">Semestre:</label>
                <input type="number" id="semestre" name="semestre" class="form-control" value="<?php echo $fila['semestre']; ?>" required>
            </div>

            <!-- Botón de actualización -->
            <button type="submit" name="actualizar" class="btn btn-primary w-100">Actualizar Estudiante</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

