<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Encryptopia</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="/" class="nav-link <?= $currentPage == "" ? 'active' : '' ?>">Home</a>
                </li>
                <li class="nav-item"><a href="/topic/1"
                        class="nav-link <?= strpos($currentPage, 'topic/') === 0 ? 'active' : '' ?>">Topics</a></li>
                <li class="nav-item"><a href="#"
                        class="nav-link <?php $currentPage == "" ? 'active' : '' ?>">Contact</a>
                </li>
                <li class="nav-item"><a href="#" class="nav-link <?php $currentPage == "" ? 'active' : '' ?>">About</a>
                </li>
                <li class="nav-item"><a href="/login" type="button" class="btn btn-outline-light me-2">Login</a></li>
                <?php
                if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
                    ?>
                    <li class="nav-item <?php $currentPage == "/" ? 'active' : '' ?>"><a
                            class="nav-link <?php $currentPage == "/" ? 'active' : '' ?>"
                            href="<?php echo BASE_URL . '/admin/dashboard' ?>">Dashboard</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>