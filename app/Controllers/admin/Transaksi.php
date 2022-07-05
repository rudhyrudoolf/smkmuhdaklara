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

        $myTime = new DateTime();
        $myTime->setTimezone(new DateTimeZone('asia/jakarta'));

        $this->date = strval($myTime->format("Y-m-d"));

        $session = \Config\Services::session();
        $session->set('title','Transaksi');
    }

    public function index()
    {
        $periodfrom  = date('Y-m-d', strtotime('-0 day', strtotime($this->date)));
        $periodTo = $this->date;

        $data = [
            'title' => 'system',
            'periodFrom' => $periodfrom,
            'periodTo' => $periodTo,
            'listTransaksi' => $this->transaksiModel->getdata($periodfrom,$periodTo),
            'sandi' => $this->dropdownsandi
        ];

        return view('admin/pages/transaksi', $data);
    }

    public function Searchdata()
    {
        $periodfrom = $this->request->getGet('periodFrom');
        $periodTo = $this->request->getGet('periodTo');

        $data = [
            'listTransaksi' => $this->transaksiModel->getdata($periodfrom,$periodTo)
        ];

        echo json_encode($data);
    }


    public function getrekening()
    {
        $data = $this->nasabahModel->getDataRekening();
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

        $flag = $this->request->getPost('flag');
        $data = $this->transaksiModel->addData($params,$flag);
       
        if (!$data) {

            $response = [
                'title' => 'error',
                'content' => $data
            ];
        } else {
            // get id transaksi for print
            
            $response = [
                'title' => 'success',
                'content' => $data
            ];
        }

        echo json_encode($response);
        die;
    }
}
