<?php
include 'conexion.php';

// Consulta SQL usando alias para evitar conflicto entre columnas con el mismo nombre
$sql = "SELECT tbl_estudiante.identificacion, tbl_estudiante.nombres, tbl_estudiante.apellidos, 
               tbl_carrera.nombre AS carrera_nombre, tbl_genero.nombre AS genero_nombre, 
               tbl_estudiante.semestre, tbl_estudiante.fecha_de_ingreso
        FROM tbl_estudiante
        JOIN tbl_carrera ON tbl_estudiante.id_carrera = tbl_carrera.id_carrera
        JOIN tbl_genero ON tbl_estudiante.id_genero = tbl_genero.id_genero";

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
            border: 1px solid #000000 ;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #000000;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .no-data {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
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
