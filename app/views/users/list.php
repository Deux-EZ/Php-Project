<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="dashboard">
    <div class="sidebar">
        <div class="user-info">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="user-icon">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
            <h3><?= htmlspecialchars($_SESSION['usuario']) ?></h3>
        </div>
        <form method="POST" action="<?= Config::get('APP_URL') ?>/public/index.php?route=auth/logout">
            <button type="submit" class="logout-btn">Cerrar sesión</button>
        </form>
    </div>

    <div class="content">
        <h1>Lista de Usuarios</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['usuario']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>