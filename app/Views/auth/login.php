<!-- app/Views/auth/login.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HRD System</title>

    <!-- Bootstrap 5 -->
    <link href="<?= base_url('public/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, Helvetica, sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .login-header {
            background: white;
            padding: 35px 30px 20px;
            text-align: center;
        }

        .login-header img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 4px solid #0d6efd;
        }

        .login-body {
            padding: 30px;
            background: white;
        }

        .form-control {
            height: 50px;
            border-radius: 12px;
        }

        .input-group-text {
            border-radius: 12px 0 0 12px;
        }

        .btn-login {
            height: 50px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 16px;
        }

        .copyright {
            text-align: center;
            margin-top: 20px;
            color: white;
            font-size: 14px;
        }

        @media(max-width:576px) {

            .login-card {
                margin: 20px;
            }

            .login-header {
                padding: 25px 20px 15px;
            }

            .login-body {
                padding: 20px;
            }

        }
    </style>

</head>

<body>

    <div>

        <div class="card login-card">

            <div class="login-header">

                <img src="https://ui-avatars.com/api/?name=HRD&background=0D6EFD&color=fff" alt="Logo">

                <h3 class="fw-bold mb-1">
                    HRD System
                </h3>

                <p class="text-muted mb-0">
                    Silahkan login untuk melanjutkan
                </p>

            </div>

            <div class="login-body">

                <!-- ALERT -->
                <?php if (session()->getFlashdata('error')) : ?>

                    <div class="alert alert-danger alert-dismissible fade show">

                        <?= session()->getFlashdata('error'); ?>

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>

                    </div>

                <?php endif; ?>

                <form action="<?= base_url('index.php/login/process') ?>" method="POST">

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Username
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>

                            <input type="text"
                                name="username"
                                class="form-control"
                                placeholder="Masukkan username"
                                required>

                        </div>

                    </div>

                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Password
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>

                            <input type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                required>

                            <button type="button"
                                class="btn btn-outline-secondary"
                                onclick="showPassword()">

                                <i class="bi bi-eye-fill"
                                    id="iconPassword"></i>

                            </button>

                        </div>

                    </div>

                    <div class="d-grid">

                        <button type="submit"
                            class="btn btn-primary btn-login">

                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Login

                        </button>

                    </div>

                </form>

            </div>

        </div>

        <div class="copyright">

            © <?= date('Y'); ?> Fullstack Test

        </div>

    </div>

    <!-- Bootstrap -->
    <script src="<?= base_url('public/js/bootstrap.bundle.min.js') ?>"></script>

    <script>
        function showPassword() {

            let password = document.getElementById('password');
            let icon = document.getElementById('iconPassword');

            if (password.type === 'password') {

                password.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');

            } else {

                password.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');

            }

        }
    </script>

</body>

</html>