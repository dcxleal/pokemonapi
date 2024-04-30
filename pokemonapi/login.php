<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usuario']) && isset($_POST['contraseña'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    
    // Conectar a la base de datos (reemplaza con tus datos de conexión)
    $servername = "localhost";
    $username = "root";
    $password = "admin08/";
    $dbname = "pokemonapi";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta SQL ajustada para buscar por el campo "nombre"
    $sql = "SELECT * FROM usuarios WHERE nombre='$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contraseña, $row['contraseña'])) {
            $_SESSION['usuario'] = $usuario;
            header("Location: tabla.php");
            exit();
        } else {
            echo "Contraseña incorrecta. <a href='index.php'>Volver</a>";
        }
    } else {
        // Si el usuario no existe, redirigir a registro.php
        header("Location: registro.php");
        exit();
    }

    $conn->close();
}
?>
