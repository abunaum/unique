<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminProses extends BaseController
{
    public function tambah_item()
    {
        $validasi = \Config\Services::validation();
        $nama = $this->request->getVar('nama');
        $deskripsi = $this->request->getVar('deskripsi');
        $harga = $this->request->getVar('harga');
        $ambilkoma = '/,/i';
        $harga = preg_replace($ambilkoma, '', $harga);
        if (!$this->validate(
            [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama item harus di isi.'
                    ]
                ],
                'deskripsi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Deskripsi item harus di isi.'
                    ]
                ],
                'harga' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Harga item harus ada.',
                        'min_length' => 'Harga minimal Rp. 10,000'
                    ]
                ]
            ]
        )) {
            session()->setFlashdata('error', [
                'pesan' => 'Gagal menyimpan Item.',
                'value' => $validasi->getErrors()
            ]);
            return redirect()->to(base_url('admin/item'))->withInput();
        } else {
            $item = $this->item;
            $item->save([
                'nama' => $nama,
                'deskripsi' => $deskripsi,
                'harga' => $harga
            ]);
            session()->setFlashdata('sukses', [
                'pesan' => 'Mantap.',
                'value' => 'Berhasil menyimpan Item.'
            ]);
            return redirect()->to(base_url('admin/item'));
        }
    }
    public function hapus_item($id)
    {
        echo 'idnya ' . $id;
    }
}
