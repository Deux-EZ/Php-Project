<?php
session_start();
include('conexion.php');

if (isset($_SESSION['usuario'])) {
    header('Location: listar.php');
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $conn->real_escape_string($_POST['txtusuario'] ?? '');
    $pass = $_POST['txtpassword'] ?? ''; // Quitamos real_escape_string aquí
    
    if (!empty($nombre) && !empty($pass)) {
        // Cambiamos la consulta para buscar solo por usuario
        $query = $conn->prepare("SELECT * FROM login WHERE usuario = ?");
        $query->bind_param("s", $nombre);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            // Verificamos la contraseña correctamente
            if (password_verify($pass, $user['password'])) {
                $_SESSION['usuario'] = $nombre;
                header("Location: listar.php");
                exit();
            } else {
                $error = 'Usuario o contraseña incorrectos';
            }
        } else {
            $error = 'Usuario o contraseña incorrectos';
        }
    } else {
        $error = 'Por favor complete todos los campos';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de Sesión - Pink Style</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>✨ Inicio de Sesión</h2>
                <img src="logo.png" alt="Logo de la empresa" class="logo">
            </div>

            <form class="form" method="post">
                <?php if (!empty($error)): ?>
                    <div class="error-message" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="error-icon">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <div class="input-group">
                    <input type="text" 
                           id="usuario" 
                           name="txtusuario" 
                           required
                           autocomplete="username">
                    <label for="usuario">👤 Usuario</label>
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                </div>

                <div class="input-group">
                    <input type="password" 
                           id="password" 
                           name="txtpassword" 
                           required
                           autocomplete="current-password">
                    <label for="password">🔒 Contraseña</label>
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 17c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0-6c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2h2c0-2.21-1.79-4-4-4zm6-6h-2V3h-2v2H8V3H6v2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zm0 14H4V9h16v12z"/>
                        </svg>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Ingresar
                </button>

                <p class="register-link">
                    ¿No tienes cuenta? 
                    <a href="registrar.php" class="link">
                        Regístrate aquí
                    </a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
