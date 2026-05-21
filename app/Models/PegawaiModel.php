<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table            = 'pegawai';
    protected $primaryKey       = 'id';
    protected $allowedFields = [
        'nama_pegawai',
        'jenis_kelamin',
        'email',
        'no_hp',
        'foto',
        'alamat',
        'kode_pos',
        'id_provinsi',
        'id_kabupaten',
        'id_kecamatan',
        'id_kelurahan'
    ];
}
