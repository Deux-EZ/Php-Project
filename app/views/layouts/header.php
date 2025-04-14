.php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title><?= Config::get('APP_NAME', 'AnimePink Store') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?= Config::get('APP_URL') ?>/public/assets/css/login.css?v=<?= time() ?>">
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">
            <a href="<?= Config::get('APP_URL') ?>/public/index.php?route=home">
                <img src="<?= Config::get('APP_URL') ?>/public/assets/img/logo.png" alt="Logo" class="nav-logo">
                <span>✨ AnimePink Store</span>
            </a>
        </div>
        <div class="nav-links">
            <?php if (isset($_SESSION['usuario'])): ?>
                <span class="welcome-text">🌸 Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></span>
                <a href="<?= Config::get('APP_URL') ?>/public/index.php?route=users/list" class="nav-button">
                    <i class="fas fa-user"></i> Mi Cuenta
                </a>
                <form method="POST" action="<?= Config::get('APP_URL') ?>/public/index.php?route=auth/logout" class="logout-form">
                    <button type="submit" class="nav-button btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                    </button>
                </form>
            <?php else: ?>
                <a href="<?= Config::get('APP_URL') ?>/public/index.php?route=auth/login" class="nav-button">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                </a>
                <a href="<?= Config::get('APP_URL') ?>/public/index.php?route=auth/register" class="nav-button btn-register">
                    <i class="fas fa-user-plus"></i> Registrarse
                </a>
            <?php endif; ?>
        </div>
    </nav>