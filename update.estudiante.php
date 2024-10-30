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
    --se eligen los datos que se desean actualizar, no necesariamente deben ser tosos
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
    <!-- Título del formulario -->
    <p class="titulo">Actualizar Estudiante</p>
<!--se abre al formulario-->
    <form action="" method="post">

        <!-- Campo oculto de identificación -->
         <!--inserta el valor de la identificacion del estudiante (obtenido de la base de datos) como el valor de este campo oculto.
          Esto asegura que el sistema sabrá a qué registro debe aplicar las actualizaciones -->
        <input type="hidden" name="identificacion" value="<?php echo $fila['identificacion']; ?>">

        <!-- Campo de Nombres -->
        <label for="nombres">Nombres:</label><br>
        <!--establece el valor predeterminado usando el valor de nombres obtenido del estudiante, para que el usuario vea el nombre actual y pueda actualizarlo si es necesario.-->
        <input type="text" id="nombres" name="nombres" value="<?php echo $fila['nombres']; ?>" required><br><br>

        <!-- Campo de Apellidos -->
        <label for="apellidos">Apellidos:</label><br>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo $fila['apellidos']; ?>" required><br><br>

        <!-- Campo de Semestre -->
        <label for="semestre">Semestre:</label><br>
        <input type="number" id="semestre" name="semestre" value="<?php echo $fila['semestre']; ?>" required><br><br>
        
        <input type="submit" name="actualizar" value="Actualizar Estudiante">
    </form>
</div>
</body>
</html>
