<div class="header">
        <div class="logo">
                <a href="<?php echo BASE_URL .'/admin/dashboard' ?>">
                        <h1><?php echo SITE_NAME; ?> - Admin</h1>
                </a>
        </div>
        <div class="user-info">
            <?php if (isset($_SESSION['user'])): ?>
                <span><?php echo $_SESSION['user']['username'] ?></span> &nbsp; &nbsp; <a href="<?php echo BASE_URL . '/logout'; ?>" class="logout-btn">Logout?</a>
            <?php endif ?>
        </div>
</div>