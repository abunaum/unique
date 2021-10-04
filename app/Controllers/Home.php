<?php

namespace App\Controllers;

class Home extends BaseController
{
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

    public function logo()
    {
        $data = [
            'menu' => 'aaa'
        ];
        return view('web/logo', $data);
    }
}
