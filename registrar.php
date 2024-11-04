<?php

include 'conexion.php';

$nombre_usuario = "lauracoterio";
$password = "laura930";
$correo = "lauracoterio3009@gmail.com";

//para cifrar la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

//sentencias preparadas
$stmt = $conexion->prepare ("INSERT INTO tbl_login (nombre_usuario, password, correo) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre_usuario, $hashed_password, $correo);

if ($stmt->execute()) {
    echo "Registro exitoso";
}else {
    echo "Error: ". $stmt->error;
}

$stmt->close();
$conexion->close();

?>