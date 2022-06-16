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
        $period = $this->date;

        $data = [
            'title' => 'Mutasi',
            'period' => $period
        ];
        return view('admin/pages/mutasi', $data);
    }

    public function searchData()
    {
        $norek = $this->request->getGet('norek');
        $kodeTransaksi = $this->request->getGet('kodeTransaksi');
        $data = $this->transaksiModel->searchDataMutasi($norek, $kodeTransaksi);

        echo json_encode($data);
        die;
    }
}
