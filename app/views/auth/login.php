<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>✨ Inicio de Sesión</h2>
            <img src="<?= Config::get('APP_URL') ?>/public/assets/img/logo.png" alt="Logo de la empresa" class="logo">
        </div>

        <form class="form" method="post" action="<?= Config::get('APP_URL') ?>/public/index.php?route=auth/login">
            <?php if (isset($error)): ?>
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
            </div>

            <div class="input-group">
                <input type="password" 
                       id="password" 
                       name="txtpassword" 
                       required
                       autocomplete="current-password">
                <label for="password">🔒 Contraseña</label>
            </div>

            <button type="submit" class="btn-submit">Ingresar</button>
            <p class="register-link">
                ¿No tienes cuenta? 
                <a href="<?= Config::get('APP_URL') ?>/public/index.php?route=auth/register" class="link">
                    Regístrate aquí
                </a>
            </p>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>