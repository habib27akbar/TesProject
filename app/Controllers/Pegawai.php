<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\ProvinsiModel;
use App\Models\KabupatenModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;

class Pegawai extends BaseController
{
    protected $pegawaiModel;
    protected $provinsiModel;
    protected $kabupatenModel;
    protected $kecamatanModel;
    protected $kelurahanModel;

    public function __construct()
    {
        $this->pegawaiModel   = new PegawaiModel();
        $this->provinsiModel  = new ProvinsiModel();
        $this->kabupatenModel = new KabupatenModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->kelurahanModel = new KelurahanModel();
    }

    public function index()
    {
        $data = [

            'pegawai' => $this->pegawaiModel
                ->select('pegawai.*,
                          provinsi.name as provinsi,
                          kabupaten.name as kabupaten,
                          kecamatan.name as kecamatan,
                          kelurahan.name as kelurahan')
                ->join('provinsi', 'provinsi.id = pegawai.id_provinsi', 'left')
                ->join('kabupaten', 'kabupaten.id = pegawai.id_kabupaten', 'left')
                ->join('kecamatan', 'kecamatan.id = pegawai.id_kecamatan', 'left')
                ->join('kelurahan', 'kelurahan.id = pegawai.id_kelurahan', 'left')
                ->findAll(),

            'provinsi' => $this->provinsiModel->findAll(),
            'kabupatenModel' => $this->kabupatenModel,
            'kecamatanModel' => $this->kecamatanModel,
            'kelurahanModel' => $this->kelurahanModel

        ];

        return view('pegawai/index', $data);
    }

    public function store()
    {

        $validation = \Config\Services::validation();

        $validation->setRules([

            'foto' => [

                'label' => 'Foto',

                'rules' => 'uploaded[foto]|max_size[foto,300]|mime_in[foto,image/jpg,image/jpeg]',

                'errors' => [

                    'uploaded'  => 'Foto wajib diupload',
                    'max_size'  => 'Ukuran foto maksimal 300KB',
                    'mime_in'   => 'Format foto harus JPG/JPEG'

                ]

            ]

        ]);

        if (!$validation->withRequest($this->request)->run()) {

            return redirect()->back()->withInput()->with(
                'error',
                $validation->getError('foto')
            );
        }


        $foto = $this->request->getFile('foto');

        $namaFoto = '';

        if ($foto && $foto->isValid()) {

            $namaFoto = $foto->getRandomName();

            $foto->move('uploads/pegawai', $namaFoto);
        }

        $this->pegawaiModel->save([

            'nama_pegawai' => $this->request->getPost('nama_pegawai'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'email'        => $this->request->getPost('email'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'alamat'       => $this->request->getPost('alamat'),
            'kode_pos'     => $this->request->getPost('kode_pos'),

            'id_provinsi'  => $this->request->getPost('id_provinsi'),
            'id_kabupaten' => $this->request->getPost('id_kabupaten'),
            'id_kecamatan' => $this->request->getPost('id_kecamatan'),
            'id_kelurahan' => $this->request->getPost('id_kelurahan'),

            'foto'         => $namaFoto

        ]);
        return redirect()->to('/pegawai')->with(
            'success',
            'Pegawai berhasil ditambahkan'
        );
    }

    public function update($id)
    {
        $pegawai = $this->pegawaiModel->find($id);

        $foto = $this->request->getFile('foto');

        $namaFoto = $pegawai['foto'];

        /*
    |--------------------------------------------------------------------------
    | VALIDASI FOTO JIKA ADA FILE
    |--------------------------------------------------------------------------
    */

        if ($foto && $foto->isValid()) {

            $validation = \Config\Services::validation();

            $validation->setRules([

                'foto' => [

                    'label' => 'Foto',

                    'rules' => 'max_size[foto,300]|mime_in[foto,image/jpg,image/jpeg]',

                    'errors' => [

                        'max_size' => 'Ukuran foto maksimal 300KB',
                        'mime_in'  => 'Format foto harus JPG/JPEG'

                    ]

                ]

            ]);

            if (!$validation->withRequest($this->request)->run()) {

                return redirect()->back()->withInput()->with(
                    'error',
                    $validation->getError('foto')
                );
            }

            /*
        |--------------------------------------------------------------------------
        | HAPUS FOTO LAMA
        |--------------------------------------------------------------------------
        */

            if (
                $pegawai['foto'] &&
                file_exists('uploads/pegawai/' . $pegawai['foto'])
            ) {

                unlink('uploads/pegawai/' . $pegawai['foto']);
            }

            $namaFoto = $foto->getRandomName();

            $foto->move('uploads/pegawai', $namaFoto);
        }

        $this->pegawaiModel->update($id, [

            'nama_pegawai' => $this->request->getPost('nama_pegawai'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'email'        => $this->request->getPost('email'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'alamat'       => $this->request->getPost('alamat'),
            'kode_pos'     => $this->request->getPost('kode_pos'),

            'id_provinsi'  => $this->request->getPost('id_provinsi'),
            'id_kabupaten' => $this->request->getPost('id_kabupaten'),
            'id_kecamatan' => $this->request->getPost('id_kecamatan'),
            'id_kelurahan' => $this->request->getPost('id_kelurahan'),

            'foto'         => $namaFoto

        ]);

        return redirect()->to('/pegawai')->with(
            'success',
            'Data pegawai berhasil diupdate'
        );
    }

    public function delete($id)
    {
        $pegawai = $this->pegawaiModel->find($id);

        if (
            $pegawai['foto'] &&
            file_exists('uploads/pegawai/' . $pegawai['foto'])
        ) {

            unlink('uploads/pegawai/' . $pegawai['foto']);
        }

        $this->pegawaiModel->delete($id);

        return redirect()->to('/pegawai')->with(
            'success',
            'Pegawai berhasil dihapus'
        );
    }

    public function getKabupaten()
    {
        $id = $this->request->getPost('id');

        return $this->response->setJSON(

            $this->kabupatenModel
                ->where('province_id', $id)
                ->findAll()

        );
    }

    public function getKecamatan()
    {
        $id = $this->request->getPost('id');

        return $this->response->setJSON(

            $this->kecamatanModel
                ->where('regency_id', $id)
                ->findAll()

        );
    }

    public function getKelurahan()
    {
        $id = $this->request->getPost('id');

        return $this->response->setJSON(

            $this->kelurahanModel
                ->where('district_id', $id)
                ->findAll()

        );
    }
}
