<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Api extends BaseController
{
    public function index()
    {
        die('cari apa bro ?');
    }

    public function cek_item()
    {
        $item = $this->item->findAll();
        return $this->response->setJSON($item);
    }
}
