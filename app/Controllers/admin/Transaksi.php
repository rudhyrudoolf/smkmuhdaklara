<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\Admin\NasabahModel;
use App\Models\Admin\SystemModel;
use App\Models\Admin\TransaksiModel;

/**
 * @property IncomingRequest $request;
 */

class Transaksi extends BaseController
{

    protected $nasabahModel;
    protected $transaksiModel;

    protected $dropdownsandi;
    protected $paramDropdownsandi = "dropdown_sandi";

    public function __construct()
    {
        $this->systemModel = new SystemModel();
        $this->nasabahModel = new NasabahModel();
        $this->transaksiModel = new TransaksiModel();

        $this->dropdownsandi = $this->systemModel->getDataSystem($this->paramDropdownsandi);
    }

    public function index()
    {
        $data = [
            'title' => 'system',
            'sandi' => $this->dropdownsandi
        ];

        return view('admin/pages/transaksi', $data);
    }

    public function getrekening()
    {


        $searchdata = $this->request->getGet('search');

        // dd($searchdata);

        $data = $this->nasabahModel->getDataRekening($searchdata);
        echo json_encode($data);
    }

    public function getdetailnasabah()
    {
        $params = $this->request->getGet('id');
        $data = $this->nasabahModel->getData($params);
        echo json_encode($data);
    }

    public function savedata()
    {
        $params = $this->request->getPost();

        if ($this->request->getPost('flag') == 'insert')
            $data = $this->transaksiModel->addData($params);
        // // else
        // //     $data = $this->transaksiModel->editdata($params);

        // if (!$data) {

        //     $response = [
        //         'title' => 'error',
        //         'content' => $data
        //     ];
        // } else {
        //     $response = [
        //         'title' => 'success',
        //         'content' => $data
        //     ];
        // }

        echo json_encode($data);
        die;
    }
}
