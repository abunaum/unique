<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Beranda'
        ];
        return view('admin/beranda', $data);
    }
}
