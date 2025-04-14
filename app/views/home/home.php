<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="hero">
    <div class="hero-content">
        <h1>✨ Bienvenido a AnimePink Store</h1>
        <p>Tu destino para productos anime exclusivos</p>
        <div class="hero-buttons">
            <a href="<?= Config::get('APP_URL') ?>/public/index.php?route=auth/login" class="btn-primary">
                Iniciar Sesión
            </a>
            <a href="<?= Config::get('APP_URL') ?>/public/index.php?route=auth/register" class="btn-secondary">
                Registrarse
            </a>
        </div>
    </div>
</div>

<div class="categories">
    <div class="category-card">
        <img src="<?= Config::get('APP_URL') ?>/public/assets/img/figures.jpg" alt="Figuras">
        <div class="category-content">
            <h3>Figuras Coleccionables</h3>
            <p>Encuentra las mejores figuras de tus personajes favoritos</p>
        </div>
    </div>
    <div class="category-card">
        <img src="<?= Config::get('APP_URL') ?>/public/assets/img/manga.jpg" alt="Manga">
        <div class="category-content">
            <h3>Manga y Literatura</h3>
            <p>Las últimas novedades en manga y light novels</p>
        </div>
    </div>
    <div class="category-card">
        <img src="<?= Config::get('APP_URL') ?>/public/assets/img/accessories.jpg" alt="Accesorios">
        <div class="category-content">
            <h3>Accesorios</h3>
            <p>Complementa tu estilo con nuestros accesorios</p>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>