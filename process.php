<?php
// Incluir el archivo de conexión a la base de datos
include 'db_connect.php';

if ($_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['csv_file']['tmp_name'];
    $fileName = $_FILES['csv_file']['name'];

    // Definir el mapeo de títulos de Excel a la base de datos
    $columnMap = [
        'CENTRO DE TRABAJO' => 'centro_trabajo',
        'RPE' => 'rpe',
        'NOMBRE' => 'nombre',
        'APELLIDO PATERNO' => 'a_paterno',
        'APELLIDO MATERNO' => 'a_materno',
        'RFC' => 'rfc',
        'NÚMERO DE SEGURIDAD SOCIAL' => 'nss',
        'SEXO' => 'sexo',
        'NUM.PLAZA' => 'n_plaza',
        'CATEGORÍA' => 'categ',
        'FECHA NACIMIENTO' => 'f_nacimiento',
        'EDAD ACTUAL' => 'edad_actual',
        'FECHA DE ANTIGÜEDAD' => 'fecha_antiguedad',
        'FECHA DE JUBILACIÓN' => 'fecha_jubilacion',
        'ENTIDAD FEDERATIVA' => 'ent_federativa',
        'RAMA' => 'rama',
        'TIPO DE CONTRATO' => 'tp_contrato',
        'ESTADO CIVIL' => 'est_civil',
        'CORREO' => 'correo',
        'CURP' => 'curp',
        'ALTA COMO PERMANENTE' => 'alta_permanente',
        'FECHA FIDELIDAD' => 'fecha_fidelidad',
        'PORCENTAJE FIDELIDAD' => 'porcentaje_fidelidad',
        'ESCOLARIDAD' => 'escolaridad',
        'SALARIO' => 'salario'
    ];

    // Abrir y leer el archivo CSV
    if (($handle = fopen($fileTmpPath, "r")) !== FALSE) {
        $headers = fgetcsv($handle, 1000, ",");

        // Mapear los títulos del archivo CSV a los de la base de datos
        foreach ($headers as &$header) {
            if (array_key_exists($header, $columnMap)) {
                $header = $columnMap[$header];
            }
        }

        // Procesar las filas e insertar en la base de datos
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Armar la consulta SQL
            $sql = "INSERT INTO nombre_tabla (".implode(',', $headers).") VALUES ('".implode("','", $data)."')";

            if (mysqli_query($conecta, $sql)) {
                echo "Fila insertada correctamente.<br>";
            } else {
                echo "Error al insertar la fila: " . mysqli_error($conecta) . "<br>";
            }
        }

        fclose($handle);
    } else {
        echo "Error al abrir el archivo.";
    }
} else {
    echo "Error al subir el archivo.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conecta);
?>
