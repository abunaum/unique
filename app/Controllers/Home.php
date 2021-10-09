<?php

namespace App\Controllers;

use App\Libraries\PaymentApiLibrary;

class Home extends BaseController
{
    public $apilib;

    public function __construct()
    {
        $this->apilib = new PaymentApiLibrary();
    }
    public function index()
    {
        return view('web/beranda');
    }

    public function layanan()
    {
        return view('web/layanan');
    }

    public function privasi()
    {
        return view('web/privasi');
    }

    public function tentang()
    {
        return view('web/tentang');
    }

    public function category($id)
    {
        $item = $this->item->where('id', $id)->first();
        if (!$item) {
            return redirect()->to(base_url());
        } else {
            $data = [
                'kategori' => $item,
                'validation' => \Config\Services::validation()
            ];
            return view('web/kategori', $data);
        }
    }
    public function order($id)
    {
        if (!$this->validate(
            [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Server harus di isi.'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email harus di isi.',
                        'valid_email' => 'Alamat Email tidak valid'
                    ]
                ]
            ]
        )) {
            $validasi = \Config\Services::validation();
            session()->setFlashdata('error', [
                'pesan' => 'Order Gagal',
                'value' => $validasi->getErrors()
            ]);
            return redirect()->to(base_url('category/' . $id))->withInput();
        } else {
            $nama = $this->request->getVar('nama');
            $text = $this->request->getVar('text');
            $deskripsi = $this->request->getVar('deskripsi');
            $email = $this->request->getVar('email');
            $random = rand(10000, 99999);
            $kode = date('dmYhis') . $random;
            $this->order->save([
                'kode' => $kode,
                'item' => $id,
                'nama_server' => $nama,
                'text' => $text,
                'deskripsi' => $deskripsi,
                'email' => $email,
                'status' => 'UNPAID'
            ]);
            session()->setFlashdata('sukses', [
                'pesan' => 'Order dibuat',
                'value' => 'Silahkan lanjut ke pembayaran'
            ]);
            return redirect()->to(base_url('order_check/' . $kode));
        }
    }
    public function order_check($kode)
    {
        $pembayaran = $this->apilib->getmerchantclosed();
        // print("<pre>" . print_r($pembayaran, true) . "</pre>");
        // die;
        $order = $this->order;
        $order->join('menu', 'menu.id = order.item', 'LEFT');
        $order->select('menu.nama as nama_item');
        $order->select('menu.harga as harga');
        $order->select('order.*');
        $order->where('order.kode', $kode);
        $order = $order->first();
        if (!$order) {
            return redirect()->to(base_url());
        }
        $data = [
            'order' => $order,
            'pembayaran' => $pembayaran,
            'validation' => \Config\Services::validation()
        ];
        return view('web/order_check', $data);
    }
}
