<?php

include 'conexion.php'; //archivo de conexion para poder conectarse a la base de datos


//Verifica si el formulario fue enviado
if (isset($_POST['Log_in'])) { // Si se encuentra el método POST, capturar las variables
  
    //mysqli_rela_escape_string sirve para que no se pueda acceder a la base de datos
    $identificacion = mysqli_real_escape_string($conexion, $_POST['identificacion']);
    $nombre_usuario = mysqli_real_escape_string($conexion, $_POST['nombre_usuario']);
    $contraseña = mysqli_real_escape_string($conexion, $_POST['contraseña']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);

    // La consulta para actulizar los datos
    $sql = "INSERT INTO tbl_login (identificacion, nombre_usuario, contraseña, correo) 
        VALUES ('$identificacion', '$nombre_usuario', '$contraseña', '$correo')";

    //Condicional para que se muestre un mendaje de si se puso hacer la consulta o no
    if ($conexion->query($sql) === TRUE) {
        echo "Ingresado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
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
    <!-- Título del formulario -->
    <p class="titulo"><i><b>Log in</b></i></p>
<!--se abre al formulario-->
    <form action="" method="post">

        <!-- Campo oculto de identificación -->
         <!--inserta el valor de la identificacion del estudiante (obtenido de la base de datos) como el valor de este campo oculto.
          Esto asegura que el sistema sabrá a qué registro debe aplicar las actualizaciones -->
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

       
        <label for="nombre_usuario">Nombre de usuario:</label><br>
        <!--establece el valor predeterminado usando el valor de nombres obtenido del estudiante, para que el usuario vea el nombre actual y pueda actualizarlo si es necesario.-->
        <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo $fila['nombre_usuario']; ?>" required><br><br>

        <label for="contraseña">Contraseña:</label><br>
        <input type="text" id="contraseña" name="contraseña" value="<?php echo $fila['contraseña']; ?>" required><br><br>

        <label for="correo">Correo:</label><br>
        <input type="correo" id="correo" name="correo" value="<?php echo $fila['correo']; ?>" required><br><br>
        
        <input type="submit" name="Log_in" value="Log_in">
    </form>
</div>
</body>
</html>