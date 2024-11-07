<?php

include 'conexion.php';

$nombre_usuario = "clara_rivillas";
$password = "lobito1721";
$correo = "clary@gmail.com";

//para cifrar la contraseña, PREPARANDO
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

//sentencias preparadas, ASOCCIANDO
$stmt = $conexion->prepare ("INSERT INTO tbl_login (nombre_usuario, password, correo) VALUES (?, ?, ?)");

//EJECUTAR los parámetros
$stmt->bind_param("sss", $nombre_usuario, $hashed_password, $correo);

if ($stmt->execute()) {
    echo "Registro exitoso";
}else {
    echo "Error: ". $stmt->error;
}

$stmt->close();
$conexion->close();

?>

