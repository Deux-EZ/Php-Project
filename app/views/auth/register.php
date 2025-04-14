<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>✨ Registro de Usuario</h2>
            <img src="<?= Config::get('APP_URL') ?>/public/assets/img/logo.png" alt="Logo de la empresa" class="logo">
        </div>
        
        <form class="form" method="post" action="<?= Config::get('APP_URL') ?>/public/index.php?route=auth/register">
            <?php if (isset($error)): ?>
                <div class="error-message" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="error-icon">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

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
                        <path d="M12 17c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0-6c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2h2c0-2.21-1.79-4-4-4z"/>
                    </svg>
                </div>
            </div>

            <button type="submit" class="btn-submit">Registrar</button>
            <a href="<?= Config::get('APP_URL') ?>/public/index.php?route=auth/login" class="link">
                ¿Ya tienes cuenta? Inicia sesión
            </a>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>