<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\Admin\NasabahModel;
use App\Models\Admin\SystemModel;
use App\Models\Admin\TransaksiModel;
use DateTime;
use DateTimeZone;

/**
 * @property IncomingRequest $request;
 */

class Mutasi extends BaseController
{

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $myTime = new DateTime();
        $myTime->setTimezone(new DateTimeZone('asia/jakarta'));

        $this->date = strval($myTime->format("Y-m-d"));
    }
    public function index()
    {
        $periodfrom  = date('Y-m-d', strtotime('-7 day', strtotime($this->date)));
        $periodTo = $this->date;

        $data = [
            'title' => 'Mutasi',
            'periodFrom' => $periodfrom,
            'periodTo' => $periodTo
        ];
        return view('admin/pages/mutasi', $data);
    }
}
