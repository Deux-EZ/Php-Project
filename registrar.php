<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['txtusuario'], $_POST['txtpassword'])) {
        echo "<script>alert('Datos incompletos');</script>";
        exit();
    }

    $nombre = $conn->real_escape_string($_POST['txtusuario']);
    $pass = $_POST['txtpassword'];
    
    if (strlen($pass) < 8) {
        echo "<script>alert('La contraseña debe tener al menos 8 caracteres');</script>";
        exit();
    }

    $check = $conn->prepare("SELECT usuario FROM login WHERE usuario = ?");
    $check->bind_param("s", $nombre);
    $check->execute();
    
    if ($check->get_result()->num_rows > 0) {
        echo "<script>alert('El usuario ya existe');</script>";
    } else {
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        
        $query = $conn->prepare("INSERT INTO login (usuario, password) VALUES (?, ?)");
        $query->bind_param("ss", $nombre, $hashed_pass);
        
        if ($query->execute()) {
            echo "<script>alert('¡Registro exitoso!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Error en el registro');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Pink Style</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>✨ Registro de Usuario</h2>
                <img src="logo.png" alt="Logo" class="logo">
            </div>
            
            <form class="form" method="post">
                <div class="input-group">
                    <input type="text" name="txtusuario" required>
                    <label>👤 Usuario</label>
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                </div>

                <div class="input-group">
                    <input type="password" name="txtpassword" required>
                    <label>🔒 Contraseña</label>
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 17c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0-6c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2h2c0-2.21-1.79-4-4-4zm6-6h-2V3h-2v2H8V3H6v2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zm0 14H4V9h16v12z"/>
                        </svg>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Registrar</button>
                <a href="index.php" class="link">¿Ya tienes cuenta? Inicia sesión</a>
            </form>
        </div>
    </div>
</body>
</html>