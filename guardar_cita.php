<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Usuario por defecto de XAMPP
$password = ""; // Contraseña por defecto de XAMPP
$dbname = "isavic1";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $fecha = $conn->real_escape_string($_POST['fecha']);
    $mensaje = isset($_POST['mensaje']) ? $conn->real_escape_string($_POST['mensaje']) : '';

    // Insertar los datos en la tabla "citas"
    $sql = "INSERT INTO citas (nombre, correo, telefono, fecha, mensaje)
            VALUES ('$nombre', '$correo', '$telefono', '$fecha', '$mensaje')";

    if ($conn->query($sql) === TRUE) {
        echo "Cita guardada exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
