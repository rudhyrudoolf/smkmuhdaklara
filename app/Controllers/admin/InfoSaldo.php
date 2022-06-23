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

class Infosaldo extends BaseController
{
    protected $date;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $myTime = new DateTime();
        $myTime->setTimezone(new DateTimeZone('asia/jakarta'));

        $this->date = strval($myTime->format("Y-m-d"));
    }
    public function index($paramperiodFrom = '',$paramperiodTo = '')
    {
        

        if(empty($paramperiodFrom) && empty($paramperiodTo)){

            $periodfrom  = date('Y-m-d', strtotime('-7 day', strtotime($this->date)));
            $periodTo = $this->date;
            //dd($paramperiodFrom);
            
            $data = [
                'title' => 'Info Saldo',
                'periodFrom' => $periodfrom,
                'periodTo' => $periodTo
            ];
        }else{
            // dd($paramperiodFrom);
            $totalsaldo = $this->transaksiModel->getsaldoTransaksi($paramperiodFrom, $paramperiodTo);
            $totalkredit = $this->transaksiModel->getKreditTransaksi($paramperiodFrom, $paramperiodTo);
            $totaldebit = $this->transaksiModel->getDebitTransaksi($paramperiodFrom, $paramperiodTo);
            $data = $this->transaksiModel->getdetailData($paramperiodFrom, $paramperiodTo);
            
            $data = [
                'title' => 'Info Saldo',
                'periodFrom' => $paramperiodFrom,
                'periodTo' => $paramperiodTo,
                'listdata' => $data,
                'kredit' => $totalkredit,
                'debit' => $totaldebit,
                'saldo' => $totalsaldo
            ];
        
        }

       

        return view('admin/pages/infosaldo', $data);
    }

    public function Coba1($param = '',$param2 = ''){
        dd($param. ' '. $param2);
    }

    public function searchData()
    {
        $periodFrom = $this->request->getGet('periodFrom');
        $periodTo = $this->request->getGet('periodTo');
        $totalsaldo = $this->transaksiModel->getsaldoTransaksi($periodFrom, $periodTo);
        $totalkredit = $this->transaksiModel->getKreditTransaksi($periodFrom, $periodTo);
        $totaldebit = $this->transaksiModel->getDebitTransaksi($periodFrom, $periodTo);
        $data = $this->transaksiModel->getdetailData($periodFrom, $periodTo);

        $data = [
            'listdata' => $data,
            'kredit' => $totalkredit,
            'debit' => $totaldebit,
            'saldo' => $totalsaldo
        ];
        echo json_encode($data);
        die;
    }
}
