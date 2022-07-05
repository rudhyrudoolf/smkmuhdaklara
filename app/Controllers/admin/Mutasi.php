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
       
        $session = \Config\Services::session();
        $session->set('title','Mutasi');

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
        $periodFrom = $this->request->getGet('periodFrom');
        $periodTo = $this->request->getGet('periodTo');
        $idTrasksi = $this->request->getGet('id');
        $data = $this->transaksiModel->searchDataMutasi($norek,$periodFrom,$periodTo,$idTrasksi);

        echo json_encode($data);
        die;
    }

    function SearchTransaksi($id = '',$norek ='',$periodFrom = '',$periodTo='')
    {
        
        if(!empty($id) || $id != 0){
            
            $data = $this->transaksiModel->searchDataMutasiById($id);
        }else
        {
            if($id == 0)  $id = ''; 
            // dd($id);
            $data = $this->transaksiModel->searchDataMutasi($norek,$periodFrom,$periodTo,$id);
        }

        $listData = [
            'flag' => 'Mutasi',
            'listData' => $data
        ];
        $this->generate($listData);
    }
}
