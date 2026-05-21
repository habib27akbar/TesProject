<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard'; ?></title>

    <!-- Bootstrap 5 -->
    <link href="<?= base_url('public/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #212529;
            transition: 0.3s;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 5px;
        }

        .sidebar .nav-link:hover {
            background: #0d6efd;
            color: white;
        }

        .sidebar .nav-link.active {
            background: #0d6efd;
            color: white;
        }

        .content {
            width: 100%;
        }

        .card-dashboard {
            border: none;
            border-radius: 18px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .navbar-custom {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        @media(max-width:768px) {

            .sidebar {
                position: fixed;
                left: -260px;
                top: 0;
                z-index: 999;
            }

            .sidebar.show {
                left: 0;
            }

        }
    </style>

</head>

<body>

    <div class="d-flex">

        <?= $this->include('layout/sidebar'); ?>

        <div class="content">

            <?= $this->include('layout/navbar'); ?>

            <div class="container-fluid p-4">

                <?= $this->renderSection('content'); ?>

            </div>

        </div>

    </div>

    <?= $this->include('layout/footer'); ?>


</body>

</html>