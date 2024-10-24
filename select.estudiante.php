<?php
include 'conexion.php';

// Consulta SQL usando alias para evitar conflicto entre columnas con el mismo nombre
$sql = "SELECT tbl_estudiantes_e.identificacion, tbl_estudiantes_e.nombres, tbl_estudiantes_e.apellidos, 
               tbl_carrera_e.nombre AS carrera_nombre, tbl_genero_e.nombre AS genero_nombre, 
               tbl_estudiantes_e.semestre, tbl_estudiantes_e.fecha_de_ingreso
        FROM tbl_estudiantes_e
        JOIN tbl_carrera_e ON tbl_estudiantes_e.id_carrera = tbl_carrera_e.id_carrera
        JOIN tbl_genero_e ON tbl_estudiantes_e.id_genero = tbl_genero_e.id_genero";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #000000;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: purple;
            color: white;
        }

        tr:hover {
            background-color: #ddd;
        }

        .no-data {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }

        button{
            margin-left: 10px;
        }

        /* Estilos para los botones de imagen */
        button img {
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>

<h1>Lista de Estudiantes</h1>

<?php
if ($resultado->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Carrera</th>
                <th>Género</th>
                <th>Semestre</th>
                <th>Fecha de Ingreso</th>
                <th>Acciones</th>
            </tr>";
    
    // Recorrer el resultado y mostrar cada fila
    while ($row = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["identificacion"] . "</td>
                <td>" . $row["nombres"] . "</td>
                <td>" . $row["apellidos"] . "</td>
                <td>" . $row["carrera_nombre"] . "</td>
                <td>" . $row["genero_nombre"] . "</td>
                <td>" . $row["semestre"] . "</td>
                <td>" . $row["fecha_de_ingreso"] . "</td>
                <td> 
                 
                    <a href='delete_estudiante.php?identificacion=" . $row['identificacion'] . "'
                     onclick = 'return confirm (\'¿Estás seguro de que deseas eliminar al estudiante?\');'>
                    <img src='icono/delete.png' alt='Eliminar'> 
                   </a>


                    
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<div class='no-data'>No existen estudiantes.</div>";
}
    
$conexion->close();
?>

</body>
</html>
