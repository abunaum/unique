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
        $item = $this->item;
        $getitem = $item->where('id', $id)->first();
        $nama = $getitem['nama'];
        $item->where('id', $id)->delete();
        session()->setFlashdata('sukses', [
            'pesan' => 'Mantap.',
            'value' => 'Berhasil menghapus ' . $nama
        ]);
        return redirect()->to(base_url('admin/item'));
    }
    public function edit_item($id)
    {
        $item = $this->item;
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
            $validasi = \Config\Services::validation();
            session()->setFlashdata('error', [
                'pesan' => 'Gagal mengedit ' . $nama,
                'value' => $validasi->getErrors()
            ]);
            return redirect()->to(base_url('admin/item'))->withInput();
        } else {
            $item->save([
                'id' => $id,
                'nama' => $nama,
                'deskripsi' => $deskripsi,
                'harga' => $harga
            ]);
            session()->setFlashdata('sukses', [
                'pesan' => 'Mantap.',
                'value' => 'Berhasil mengedit ' . $nama
            ]);
            return redirect()->to(base_url('admin/item'));
        }
    }
    public function edit_payment()
    {
        $payment = $this->payment;
        $apikey = $this->request->getVar('apikey');
        $privatekey = $this->request->getVar('privatekey');
        $kode = $this->request->getVar('kode');
        $jenis = $this->request->getVar('jenis');
        if (!$this->validate(
            [
                'apikey' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Apikey harus di isi.'
                    ]
                ],
                'privatekey' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'privatekey harus di isi.'
                    ]
                ],
                'kode' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Merchant harus di isi.'
                    ]
                ]
            ]
        )) {
            $validasi = \Config\Services::validation();
            session()->setFlashdata('error', [
                'pesan' => 'Gagal mengedit payment gateway',
                'value' => $validasi->getErrors()
            ]);
            return redirect()->to(base_url('admin/payment'))->withInput();
        } else {
            $payment->save([
                'id' => 1,
                'apikey' => $apikey,
                'apiprivatekey' => $privatekey,
                'kodemerchant' => $kode,
                'callback' => 'payment/callback',
                'jenis' => $jenis
            ]);
            session()->setFlashdata('sukses', [
                'pesan' => 'Mantap.',
                'value' => 'Berhasil mengedit payment gateway'
            ]);
            return redirect()->to(base_url('admin/payment'));
        }
    }
}
