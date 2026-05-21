<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-0">
            <i class="bi bi-people-fill me-2"></i>
            Manajemen Pegawai
        </h3>

        <small class="text-muted">
            Kelola data Pegawai
        </small>
    </div>

    <button class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalTambah">

        <i class="bi bi-plus-circle me-2"></i>
        Tambah Pegawai

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

            <table id="tablePegawai" class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Wilayah</th>
                        <th width="150">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($pegawai as $p) : ?>

                        <tr>

                            <td width="100">

                                <img src="<?= base_url('uploads/pegawai/' . $p['foto']) ?>"
                                    class="rounded"
                                    width="70">

                            </td>

                            <td><?= $p['nama_pegawai']; ?></td>

                            <td><?= $p['jenis_kelamin']; ?></td>

                            <td><?= $p['email']; ?></td>

                            <td><?= $p['no_hp']; ?></td>

                            <td>

                                <?= $p['provinsi']; ?><br>
                                <?= $p['kabupaten']; ?><br>
                                <?= $p['kecamatan']; ?><br>
                                <?= $p['kelurahan']; ?>

                            </td>
                            <td>

                                <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#edit<?= $p['id']; ?>">

                                    <i class="bi bi-pencil-square"></i>

                                </button>

                                <div class="modal fade"
                                    id="edit<?= $p['id']; ?>"
                                    tabindex="-1">

                                    <div class="modal-dialog modal-lg">

                                        <div class="modal-content">

                                            <form action="<?= base_url('index.php/pegawai/update/' . $p['id']) ?>"
                                                method="POST"
                                                enctype="multipart/form-data">

                                                <div class="modal-header">

                                                    <h5 class="modal-title">
                                                        Edit Pegawai
                                                    </h5>

                                                    <button type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"></button>

                                                </div>

                                                <div class="modal-body">

                                                    <div class="row">

                                                        <!-- NAMA -->

                                                        <div class="col-md-6 mb-3">

                                                            <label>Nama Pegawai</label>

                                                            <input type="text"
                                                                name="nama_pegawai"
                                                                class="form-control"
                                                                value="<?= $p['nama_pegawai']; ?>"
                                                                required>

                                                        </div>

                                                        <div class="col-md-6 mb-3">

                                                            <label>Jenis Kelamin</label>

                                                            <select name="jenis_kelamin"
                                                                class="form-select" required>
                                                                <option value="">
                                                                    -- Pilih Jenis Kelamin --
                                                                </option>
                                                                <option value="Laki-laki"
                                                                    <?= $p['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>
                                                                    Laki-laki
                                                                </option>

                                                                <option value="Perempuan"
                                                                    <?= $p['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>
                                                                    Perempuan
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <!-- EMAIL -->

                                                        <div class="col-md-6 mb-3">

                                                            <label>Email</label>

                                                            <input type="email"
                                                                name="email"
                                                                class="form-control"
                                                                value="<?= $p['email']; ?>">

                                                        </div>

                                                        <!-- NO HP -->

                                                        <div class="col-md-6 mb-3">

                                                            <label>No HP</label>

                                                            <input type="text"
                                                                name="no_hp"
                                                                class="form-control"
                                                                value="<?= $p['no_hp']; ?>">

                                                        </div>

                                                        <!-- FOTO -->

                                                        <div class="col-md-6 mb-3">

                                                            <label>Foto</label>

                                                            <input type="file"
                                                                name="foto"
                                                                class="form-control foto-upload"
                                                                accept=".jpg,.jpeg">

                                                            <small class="text-muted">
                                                                Kosongkan jika tidak diubah
                                                            </small>

                                                        </div>

                                                        <!-- ALAMAT -->

                                                        <div class="col-md-12 mb-3">

                                                            <label>Alamat</label>

                                                            <textarea name="alamat"
                                                                class="form-control"><?= $p['alamat']; ?></textarea>

                                                        </div>

                                                        <!-- KODE POS -->

                                                        <div class="col-md-6 mb-3">

                                                            <label>Kodepos</label>

                                                            <input type="text"
                                                                name="kode_pos"
                                                                class="form-control"
                                                                value="<?= $p['kode_pos']; ?>">

                                                        </div>

                                                        <!-- PROVINSI -->

                                                        <div class="col-md-6 mb-3">

                                                            <label>Provinsi</label>

                                                            <select name="id_provinsi"
                                                                class="form-select provinsi-edit"
                                                                data-id="<?= $p['id']; ?>">

                                                                <option value="">
                                                                    -- Pilih Provinsi --
                                                                </option>

                                                                <?php foreach ($provinsi as $pr) : ?>

                                                                    <option value="<?= $pr['id']; ?>"
                                                                        <?= $pr['id'] == $p['id_provinsi'] ? 'selected' : ''; ?>>

                                                                        <?= $pr['name']; ?>

                                                                    </option>

                                                                <?php endforeach; ?>

                                                            </select>

                                                        </div>

                                                        <!-- KABUPATEN -->

                                                        <div class="col-md-6 mb-3">

                                                            <label>Kabupaten</label>

                                                            <select name="id_kabupaten"
                                                                id="kabupaten-edit<?= $p['id']; ?>"
                                                                class="form-select">

                                                                <option value="">
                                                                    -- Pilih Kabupaten --
                                                                </option>

                                                                <?php

                                                                $kabupatenEdit = $kabupatenModel
                                                                    ->where('province_id', $p['id_provinsi'])
                                                                    ->findAll();

                                                                ?>

                                                                <?php foreach ($kabupatenEdit as $kb) : ?>

                                                                    <option value="<?= $kb['id']; ?>"
                                                                        <?= $kb['id'] == $p['id_kabupaten'] ? 'selected' : ''; ?>>

                                                                        <?= $kb['name']; ?>

                                                                    </option>

                                                                <?php endforeach; ?>

                                                            </select>

                                                        </div>

                                                        <!-- KECAMATAN -->

                                                        <div class="col-md-6 mb-3">

                                                            <label>Kecamatan</label>

                                                            <select name="id_kecamatan"
                                                                id="kecamatan-edit<?= $p['id']; ?>"
                                                                class="form-select">

                                                                <option value="">
                                                                    -- Pilih Kecamatan --
                                                                </option>

                                                                <?php

                                                                $kecamatanEdit = $kecamatanModel
                                                                    ->where('regency_id', $p['id_kabupaten'])
                                                                    ->findAll();

                                                                ?>

                                                                <?php foreach ($kecamatanEdit as $kc) : ?>

                                                                    <option value="<?= $kc['id']; ?>"
                                                                        <?= $kc['id'] == $p['id_kecamatan'] ? 'selected' : ''; ?>>

                                                                        <?= $kc['name']; ?>

                                                                    </option>

                                                                <?php endforeach; ?>

                                                            </select>

                                                        </div>

                                                        <!-- KELURAHAN -->

                                                        <div class="col-md-6 mb-3">

                                                            <label>Kelurahan</label>

                                                            <select name="id_kelurahan"
                                                                id="kelurahan-edit<?= $p['id']; ?>"
                                                                class="form-select">

                                                                <option value="">
                                                                    -- Pilih Kelurahan --
                                                                </option>

                                                                <?php

                                                                $kelurahanEdit = $kelurahanModel
                                                                    ->where('district_id', $p['id_kecamatan'])
                                                                    ->findAll();

                                                                ?>

                                                                <?php foreach ($kelurahanEdit as $kl) : ?>

                                                                    <option value="<?= $kl['id']; ?>"
                                                                        <?= $kl['id'] == $p['id_kelurahan'] ? 'selected' : ''; ?>>

                                                                        <?= $kl['name']; ?>

                                                                    </option>

                                                                <?php endforeach; ?>

                                                            </select>

                                                        </div>

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

                                <a href="<?= base_url('index.php/pegawai/delete/' . $p['id']) ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus pegawai?')">

                                    <i class="bi bi-trash-fill"></i>

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- MODAL -->

<div class="modal fade"
    id="modalTambah"
    tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form action="<?= base_url() . 'index.php/pegawai/store' ?>"
                method="POST"
                enctype="multipart/form-data">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Pegawai
                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Nama Pegawai</label>

                            <input type="text"
                                name="nama_pegawai"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Jenis Kelamin</label>

                            <select name="jenis_kelamin"
                                class="form-select" required>
                                <option value="">
                                    -- Pilih Jenis Kelamin --
                                </option>
                                <option value="Laki-laki">
                                    Laki-laki
                                </option>

                                <option value="Perempuan">
                                    Perempuan
                                </option>
                            </select>
                        </div>


                        <div class="col-md-6 mb-3">

                            <label>Email</label>

                            <input type="email"
                                name="email"
                                class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>No HP</label>

                            <input type="text"
                                name="no_hp"
                                class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Foto</label>

                            <input type="file"
                                name="foto"
                                class="form-control foto-upload"
                                accept=".jpg,.jpeg" required>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label>Alamat</label>

                            <textarea name="alamat"
                                class="form-control"></textarea>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Kodepos</label>

                            <input type="text"
                                name="kode_pos"
                                class="form-control">

                        </div>

                        <!-- PROVINSI -->

                        <div class="col-md-6 mb-3">

                            <label>Provinsi</label>

                            <select name="id_provinsi"
                                id="provinsi"
                                class="form-select ">

                                <option value="">
                                    -- Pilih Provinsi --
                                </option>

                                <?php foreach ($provinsi as $pr) : ?>

                                    <option value="<?= $pr['id']; ?>">

                                        <?= $pr['name']; ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- KABUPATEN -->

                        <div class="col-md-6 mb-3">

                            <label>Kabupaten</label>

                            <select name="id_kabupaten"
                                id="kabupaten"
                                class="form-select ">

                                <option value="">
                                    -- Pilih Kabupaten --
                                </option>

                            </select>

                        </div>

                        <!-- KECAMATAN -->

                        <div class="col-md-6 mb-3">

                            <label>Kecamatan</label>

                            <select name="id_kecamatan"
                                id="kecamatan"
                                class="form-select ">

                                <option value="">
                                    -- Pilih Kecamatan --
                                </option>

                            </select>

                        </div>

                        <!-- KELURAHAN -->

                        <div class="col-md-6 mb-3">

                            <label>Kelurahan</label>

                            <select name="id_kelurahan"
                                id="kelurahan"
                                class="form-select ">

                                <option value="">
                                    -- Pilih Kelurahan --
                                </option>

                            </select>

                        </div>

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
    $(document).ready(function() {

        $('#tablePegawai').DataTable({
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

    });
    document.querySelectorAll('.foto-upload')
        .forEach(function(input) {

            input.addEventListener('change', function() {

                const file = this.files[0];

                if (!file) return;

                /*
                |--------------------------------------------------------------------------
                | VALIDASI EXTENSION
                |--------------------------------------------------------------------------
                */

                const allowedTypes = [
                    'image/jpeg',
                    'image/jpg'
                ];

                if (!allowedTypes.includes(file.type)) {

                    alert('Format foto harus JPG/JPEG');

                    this.value = '';

                    return;

                }

                /*
                |--------------------------------------------------------------------------
                | VALIDASI SIZE
                |--------------------------------------------------------------------------
                */

                const maxSize = 300 * 1024;

                if (file.size > maxSize) {

                    alert('Ukuran foto maksimal 300KB');

                    this.value = '';

                    return;

                }

            });

        });


    document.getElementById('provinsi')
        .addEventListener('change', function() {

            fetch('<?= base_url() . 'index.php/' ?>/pegawai/get-kabupaten', {

                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },

                    body: 'id=' + this.value

                })

                .then(response => response.json())

                .then(data => {

                    let kabupaten = document.getElementById('kabupaten');

                    kabupaten.innerHTML =
                        '<option value="">-- Pilih Kabupaten --</option>';

                    data.forEach(item => {

                        kabupaten.innerHTML += `
                <option value="${item.id}">
                    ${item.name}
                </option>
            `;

                    });

                });

        });

    document.getElementById('kabupaten')
        .addEventListener('change', function() {

            fetch('<?= base_url() . 'index.php/' ?>/pegawai/get-kecamatan', {

                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },

                    body: 'id=' + this.value

                })

                .then(response => response.json())

                .then(data => {

                    let kecamatan = document.getElementById('kecamatan');

                    kecamatan.innerHTML =
                        '<option value="">-- Pilih Kecamatan --</option>';

                    data.forEach(item => {

                        kecamatan.innerHTML += `
                <option value="${item.id}">
                    ${item.name}
                </option>
            `;

                    });

                });

        });

    document.getElementById('kecamatan')
        .addEventListener('change', function() {

            fetch('<?= base_url() . 'index.php/' ?>/pegawai/get-kelurahan', {

                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },

                    body: 'id=' + this.value

                })

                .then(response => response.json())

                .then(data => {

                    let kelurahan = document.getElementById('kelurahan');

                    kelurahan.innerHTML =
                        '<option value="">-- Pilih Kelurahan --</option>';

                    data.forEach(item => {

                        kelurahan.innerHTML += `
                <option value="${item.id}">
                    ${item.name}
                </option>
            `;

                    });

                });

        });

    document.querySelectorAll('.provinsi-edit')
        .forEach(function(element) {

            element.addEventListener('change', function() {

                let id = this.dataset.id;
                let value = this.value;

                fetch('<?= base_url('index.php/pegawai/get-kabupaten') ?>', {

                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },

                        body: 'id=' + value

                    })

                    .then(response => response.json())

                    .then(data => {

                        let kabupaten =
                            document.getElementById(
                                'kabupaten-edit' + id
                            );

                        kabupaten.innerHTML =
                            '<option value="">-- Pilih Kabupaten --</option>';

                        data.forEach(item => {

                            kabupaten.innerHTML += `
                    <option value="${item.id}">
                        ${item.name}
                    </option>
                `;

                        });

                    });

            });

        });

    document.querySelectorAll('[id^="kabupaten-edit"]')
        .forEach(function(element) {

            element.addEventListener('change', function() {

                let id = this.id.replace('kabupaten-edit', '');

                fetch('<?= base_url('index.php/pegawai/get-kecamatan') ?>', {

                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },

                        body: 'id=' + this.value

                    })

                    .then(response => response.json())

                    .then(data => {

                        let kecamatan =
                            document.getElementById(
                                'kecamatan-edit' + id
                            );

                        kecamatan.innerHTML =
                            '<option value="">-- Pilih Kecamatan --</option>';

                        data.forEach(item => {

                            kecamatan.innerHTML += `
                    <option value="${item.id}">
                        ${item.name}
                    </option>
                `;

                        });

                    });

            });

        });

    document.querySelectorAll('[id^="kecamatan-edit"]')
        .forEach(function(element) {

            element.addEventListener('change', function() {

                let id = this.id.replace('kecamatan-edit', '');

                fetch('<?= base_url('index.php/pegawai/get-kelurahan') ?>', {

                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },

                        body: 'id=' + this.value

                    })

                    .then(response => response.json())

                    .then(data => {

                        let kelurahan =
                            document.getElementById(
                                'kelurahan-edit' + id
                            );

                        kelurahan.innerHTML =
                            '<option value="">-- Pilih Kelurahan --</option>';

                        data.forEach(item => {

                            kelurahan.innerHTML += `
                    <option value="${item.id}">
                        ${item.name}
                    </option>
                `;

                        });

                    });

            });

        });
</script>

<?= $this->endSection(); ?>