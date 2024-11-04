
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
        <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="text" id="password" name="password " required><br><br>

        <label for="correo">Correo:</label><br>
        <input type="correo" id="correo" name="correo" required><br><br>
        
        <input type="submit" name="Log_in" value="Log_in">
    </form>
</div>
</body>
</html>