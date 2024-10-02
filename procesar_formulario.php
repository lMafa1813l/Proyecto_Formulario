<?php
// Datos de conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "pagina-web_dinamica";  // Nombre de la base de datos que creaste

// Crear la conexión a MySQL
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar experiencia laboral
$stmt = $conn->prepare("INSERT INTO experiencia_laboral (empresa, puesto, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)");
for ($i = 1; isset($_POST["empresa_$i"]); $i++) {
    $empresa = $_POST["empresa_$i"];
    $puesto = $_POST["puesto_$i"];
    $fecha_inicio = $_POST["fecha_inicio_$i"];
    $fecha_fin = $_POST["fecha_fin_$i"];

    $stmt->bind_param("ssss", $empresa, $puesto, $fecha_inicio, $fecha_fin);
    if (!$stmt->execute()) {
        echo "Error al insertar experiencia laboral: " . $stmt->error;
    }
}
$stmt->close();

// Procesar formación
$stmt = $conn->prepare("INSERT INTO formacion (institucion, titulo, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)");
for ($i = 1; isset($_POST["institucion_$i"]); $i++) {
    $institucion = $_POST["institucion_$i"];
    $titulo = $_POST["titulo_$i"];
    $fecha_inicio = $_POST["formacion_inicio_$i"];
    $fecha_fin = $_POST["formacion_fin_$i"];

    $stmt->bind_param("ssss", $institucion, $titulo, $fecha_inicio, $fecha_fin);
    if (!$stmt->execute()) {
        echo "Error al insertar formación: " . $stmt->error;
    }
}
$stmt->close();

// Procesar idiomas
$stmt = $conn->prepare("INSERT INTO idiomas (idioma, nivel) VALUES (?, ?)");
for ($i = 1; isset($_POST["idioma_$i"]); $i++) {
    $idioma = $_POST["idioma_$i"];
    $nivel = $_POST["nivel_$i"];

    $stmt->bind_param("ss", $idioma, $nivel);
    if (!$stmt->execute()) {
        echo "Error al insertar idioma: " . $stmt->error;
    }
}
$stmt->close();

// Procesar aptitudes
$stmt = $conn->prepare("INSERT INTO aptitudes (aptitud) VALUES (?)");
for ($i = 1; isset($_POST["aptitud_$i"]); $i++) {
    $aptitud = $_POST["aptitud_$i"];

    $stmt->bind_param("s", $aptitud);
    if (!$stmt->execute()) {
        echo "Error al insertar aptitud: " . $stmt->error;
    }
}
$stmt->close();

echo "Formulario enviado y datos guardados correctamente.";

// Cerrar la conexión a la base de datos
$conn->close();
?>