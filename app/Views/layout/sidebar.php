<div class="sidebar p-3" id="sidebar">

    <div class="text-center mb-4">

        <img src="https://ui-avatars.com/api/?name=Admin"
            class="rounded-circle mb-2"
            width="80">

        <h5 class="text-white mb-0">HRD System</h5>
        <small class="text-secondary">Administrator</small>

    </div>

    <?php
    $uri = service('uri');
    ?>

    <ul class="nav flex-column">

        <li class="nav-item">
            <a href="<?= base_url('index.php/dashboard') ?>"
                class="nav-link <?= ($uri->getSegment(1) == 'dashboard') ? 'active' : '' ?>">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('index.php/user') ?>"
                class="nav-link <?= ($uri->getSegment(1) == 'user') ? 'active' : '' ?>">
                <i class="bi bi-people-fill me-2"></i>
                Manajemen User
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('index.php/pegawai') ?>"
                class="nav-link <?= ($uri->getSegment(1) == 'pegawai') ? 'active' : '' ?>">
                <i class="bi bi-person-vcard-fill me-2"></i>
                Pegawai
            </a>
        </li>

        <li class="nav-item mt-3">
            <a href="<?= base_url('index.php/logout') ?>" class="nav-link text-danger">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
            </a>
        </li>

    </ul>

</div>