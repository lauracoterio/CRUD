<?php

// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Definir las variables con los datos del nuevo usuario
$nombre_usuario = "clara_rivillas";  // Nombre de usuario
$password = "lobito1721";            // Contraseña en texto plano
$correo = "clary@gmail.com";         // Correo electrónico

// Para cifrar la contraseña, PREPARANDO
// Usamos la función password_hash() para cifrar la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);  
// PASSWORD_DEFAULT es el algoritmo de hashing recomendado (actualmente bcrypt)

// Sentencia preparada, ASOCIANDO los parámetros
// Preparamos una consulta SQL para insertar los datos en la tabla tbl_login
$stmt = $conexion->prepare("INSERT INTO tbl_login (nombre_usuario, password, correo) VALUES (?, ?, ?)");

// EJECUTAR los parámetros
// Vinculamos las variables de PHP a la consulta SQL preparada
// "sss" indica que los tres parámetros son de tipo string (cadena de texto)
$stmt->bind_param("sss", $nombre_usuario, $hashed_password, $correo);

// Ejecutamos la consulta
if ($stmt->execute()) {
    // Si la ejecución fue exitosa, mostramos un mensaje
    echo "Registro exitoso";
} else {
    // Si ocurrió un error, mostramos el mensaje de error
    echo "Error: " . $stmt->error;
}

// Cerramos la sentencia preparada para liberar recursos
$stmt->close();

// Cerramos la conexión a la base de datos
$conexion->close();

?>
