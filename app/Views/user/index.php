<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-0">
            <i class="bi bi-people-fill me-2"></i>
            Manajemen User
        </h3>

        <small class="text-muted">
            Kelola data user aplikasi
        </small>
    </div>

    <button class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalTambah">

        <i class="bi bi-plus-circle me-2"></i>
        Tambah User

    </button>

</div>

<?php if (session()->getFlashdata('success')) : ?>

    <div class="alert alert-success">

        <?= session()->getFlashdata('success'); ?>

    </div>

<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4">

    <div class="card-body">

        <div class="table-responsive">

            <table id="tableUser" class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>
                        <th width="80">No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th width="180">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    <?php $no = 1; ?>

                    <?php foreach ($users as $user) : ?>

                        <tr>

                            <td><?= $no++; ?></td>

                            <td><?= $user['nama']; ?></td>

                            <td><?= $user['username']; ?></td>

                            <td>

                                <span class="badge bg-primary">

                                    <?= $user['role']; ?>

                                </span>

                            </td>

                            <td>

                                <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#edit<?= $user['id']; ?>">

                                    <i class="bi bi-pencil-square"></i>

                                </button>

                                <a href="/user/delete/<?= $user['id']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus user?')">

                                    <i class="bi bi-trash-fill"></i>

                                </a>

                            </td>

                        </tr>

                        <!-- MODAL EDIT -->

                        <div class="modal fade"
                            id="edit<?= $user['id']; ?>"
                            tabindex="-1">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <form action="<?= base_url('index.php/user/update/' . $user['id']) ?>"
                                        method="POST">

                                        <div class="modal-header">

                                            <h5 class="modal-title">
                                                Edit User
                                            </h5>

                                            <button type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"></button>

                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">

                                                <label>Nama</label>

                                                <input type="text"
                                                    name="nama"
                                                    class="form-control"
                                                    value="<?= $user['nama']; ?>"
                                                    required>

                                            </div>

                                            <div class="mb-3">

                                                <label>Username</label>

                                                <input type="text"
                                                    name="username"
                                                    class="form-control"
                                                    value="<?= $user['username']; ?>"
                                                    required>

                                            </div>

                                            <div class="mb-3">

                                                <label>Password Baru</label>

                                                <input type="password"
                                                    name="password"
                                                    class="form-control">

                                                <small class="text-muted">
                                                    Kosongkan jika tidak diubah
                                                </small>

                                            </div>

                                            <div class="mb-3">

                                                <label>Role</label>

                                                <select name="role"
                                                    class="form-select">

                                                    <option value="Admin"
                                                        <?= $user['role'] == 'Admin' ? 'selected' : ''; ?>>
                                                        Admin
                                                    </option>

                                                    <option value="User"
                                                        <?= $user['role'] == 'User' ? 'selected' : ''; ?>>
                                                        User
                                                    </option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="modal-footer">

                                            <button type="submit"
                                                class="btn btn-primary">

                                                Update

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- MODAL TAMBAH -->

<div class="modal fade"
    id="modalTambah"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="<?= base_url('index.php/user/store') ?>" method="POST">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Tambah User

                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label>Nama</label>

                        <input type="text"
                            name="nama"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Username</label>

                        <input type="text"
                            name="username"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Password</label>

                        <input type="password"
                            name="password"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Role</label>

                        <select name="role"
                            class="form-select">

                            <option value="Admin">
                                Admin
                            </option>

                            <option value="User">
                                User
                            </option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                        class="btn btn-primary">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
    $('#tableUser').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya"
            },
            zeroRecords: "Data tidak ditemukan",
            infoEmpty: "Data kosong"
        }
    });
</script>

<?= $this->endSection(); ?>