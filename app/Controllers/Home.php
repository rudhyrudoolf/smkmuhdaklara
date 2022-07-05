<?php

namespace App\Controllers;

use App\Models\Admin\NasabahModel;
use App\Models\Admin\TransaksiModel;
use CodeIgniter\I18n\Time;
use DateTime;
use DateTimeZone;

class Home extends BaseController
{
    protected $nasabahModel;
    protected $transaksiModel;
    protected $date;

    public function __construct()
    {
        $this->nasabahModel = new NasabahModel();
        $this->transaksiModel = new TransaksiModel();
        $myTime = new DateTime();
        $myTime->setTimezone(new DateTimeZone('asia/jakarta'));

        $this->date = strval($myTime->format("Y-m-d"));

        $session = \Config\Services::session();
        $session->set('title','Dashboard');

    }

    public function index()
    {
        // $backdate = strtotime('-7 day', strtotime($this->date));
        $periodfrom  = date('Y-m-d', strtotime('-7 day', strtotime($this->date)));
        $periodTo = $this->date;
        $totalsaldo = $this->transaksiModel->getsaldoTransaksi($periodfrom, $periodTo);
        $totalnasabah = $this->nasabahModel->gettotalNasabah();
        $totalkredit = $this->transaksiModel->getKreditTransaksi($periodfrom, $periodTo);
        $totaldebit = $this->transaksiModel->getDebitTransaksi($periodfrom, $periodTo);

        $data = [
            'title' => 'dashboard',
            'totalnasabah' => $totalnasabah,
            'kredit' => $totalkredit,
            'debit' => $totaldebit,
            'saldo' => $totalsaldo,
            'periodFrom' => $periodfrom,
            'periodTo' => $periodTo
        ];
        return view('dashboard', $data);
    }

    public function searchdata()
    {
        $periodfrom = $this->request->getGet('periodFrom');
        $periodTo = $this->request->getGet('periodTo');

        $totalsaldo = $this->transaksiModel->getsaldoTransaksi($periodfrom, $periodTo);
        $totalnasabah = $this->nasabahModel->gettotalNasabah();
        $totalkredit = $this->transaksiModel->getKreditTransaksi($periodfrom, $periodTo);
        $totaldebit = $this->transaksiModel->getDebitTransaksi($periodfrom, $periodTo);

        $formatsaldo = number_format(floatval($totalsaldo->saldo), 2, ',', '.');
        $formatKredit = number_format(floatval($totalkredit->kredit), 2, ',', '.');
        $formatdebit = number_format(floatval($totaldebit->debit), 2, ',', '.');


        $data = [
            'totalnasabah' => $totalnasabah,
            'kredit' => $formatKredit,
            'debit' => $formatdebit,
            'saldo' => $formatsaldo
        ];
        echo json_encode($data);
    }
}
