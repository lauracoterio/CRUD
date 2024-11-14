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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    
        body{
            background-color: #edb5f7;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .table-hover tbody tr:hover {
            background-color: #f2f2f2;
        }

        .no-data {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
        /* Estilos para los íconos */
        img {
            width: 20px;
            height: 20px;
            margin-left: 10px;
        }

        .text-center {
            text-align: center;
        }

        .btn-icon {
            border: none;
            background: none;
            padding: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Lista de Estudiantes</h1> <!-- Título principal de la página -->

    <?php
    if ($resultado->num_rows > 0) {  // Verifica si hay estudiantes en la base de datos
        echo "<div class='table-responsive'>  
                <table class='table table-bordered table-hover'>  
                    <thead class='table-primary text-center'>  
                        <tr>
                            <th>ID</th>  <!-- Columna para ID -->
                            <th>Nombres</th>  <!-- Columna para Nombres -->
                            <th>Apellidos</th>  <!-- Columna para Apellidos -->
                            <th>Carrera</th>  <!-- Columna para Carrera -->
                            <th>Género</th>  <!-- Columna para Género -->
                            <th>Semestre</th>  <!-- Columna para Semestre -->
                            <th>Fecha de Ingreso</th>  <!-- Columna para Fecha de Ingreso -->
                            <th>Acciones</th>  <!-- Columna para las acciones (Eliminar, Actualizar) -->
                        </tr>
                    </thead>
                    <tbody>";  // Aquí empieza la parte donde se agregan las filas de estudiantes 

        // Recorre los resultados de la base de datos y agrega una fila por cada estudiante
        while ($row = $resultado->fetch_assoc()) {  
            echo "<tr>
                    <td>" . $row["identificacion"] . "</td>  
                    <td>" . $row["nombres"] . "</td> 
                    <td>" . $row["apellidos"] . "</td>  
                    <td>" . $row["carrera_nombre"] . "</td>  
                    <td>" . $row["genero_nombre"] . "</td>  
                    <td>" . $row["semestre"] . "</td> 
                    <td>" . $row["fecha_de_ingreso"] . "</td>  
                    <td class='text-center'>  
                        <a href='delete_estudiante.php?identificacion=" . $row['identificacion'] . "' 
                           onclick='return confirm(\"¿Estás seguro de que deseas eliminar al estudiante?\");' class='btn-icon'>
                            <img src='icono/delete.png' alt='Eliminar'> 
                        </a>
                        <a href='update.estudiante.php?identificacion=" . $row['identificacion'] . "' 
                           onclick='return confirm(\"¿Estás seguro de que deseas actualizar al estudiante?\");' class='btn-icon'>
                            <img src='icono/update.png' alt='Actualizar'>  
                        </a>
                    </td>
                  </tr>";
        }

        // botón del insert
        echo "<tr>
                <td colspan='8' class='text-center'>
                    <a href='insert.estudiante.php' 
                       onclick='return confirm(\"¿Estás seguro de que deseas insertar un nuevo estudiante?\");' class='btn-icon'>
                        <img src='icono/insert.png' alt='Insertar'> 
                    </a>
                </td>
              </tr>";
        
        echo "</tbody>
              </table>
              </div>";
    } else {  // Si no hay estudiantes en la base de datos
        echo "<div class='no-data'>No existen estudiantes.</div>";  
    }

    $conexion->close();  // Cierra la conexión con la base de datos
    ?>
</div>

<!-- Bootstrap JS (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>  <!-- Carga JS de Bootstrap -->
</body>
</html>
