<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Transaksi extends BaseController
{
    public function index()
    {
        return view('admin/pages/transaksi');
    }
}
