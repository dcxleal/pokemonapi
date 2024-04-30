<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <?php
    // Verificar si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validar y obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        // Conectar a la base de datos (reemplaza con tus datos de conexión)
        $servername = "localhost";
        $username = "root";
        $password = "admin08/";
        $dbname = "pokemonapi";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Hash de la contraseña
        $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

        // Insertar el usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES ('$nombre', '$correo', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Usuario registrado exitosamente. <a href='login.php'>Iniciar Sesión</a>";
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }

        $conn->close();
    }
 
    ?>

    <h2>Registrarse</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>
        <label for="contraseña">Contraseña:</label><br>
        <input type="password" id="contraseña" name="contraseña" required><br><br>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
