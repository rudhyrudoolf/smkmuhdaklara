<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Admin\SystemModel;
use App\Models\Admin\NasabahModel;
use CodeIgniter\HTTP\Message;
use CodeIgniter\HTTP\Request;
use Exception;

class MasterNasabah extends BaseController
{
    protected $systemModel;
    protected $nasabahModel;
    protected $dropdownJenisKelamin;
    protected $dropdownJenistabungan;


    protected $paramjenisTabungan = "dropdown_jenis_tabungan";
    protected $paramjenisJeniskelamin = "dropdown_jenis_kelamin";

    public function __construct()
    {
        $this->systemModel = new SystemModel();
        $this->nasabahModel = new NasabahModel();
        $this->print = new Mutasi();
        $this->dropdownJenisKelamin = $this->systemModel->getDataSystem($this->paramjenisJeniskelamin);
        $this->dropdownJenistabungan = $this->systemModel->getDataSystem($this->paramjenisTabungan);

        $session = \Config\Services::session();
        $session->set('title','Nasabah');
    }


    public function index()
    {

        $data = [
            'title' => 'system',
            'jenistabungan' => $this->dropdownJenistabungan,
            'jeniskelamin' => $this->dropdownJenisKelamin,
            'listNasabah' => $this->nasabahModel->getData()
        ];

        return view('admin/pages/nasabah', $data);
    }

    public function getDataInit()
    {
        $data = [
            'listNasabah' => $this->nasabahModel->getData()
        ];

        echo json_encode($data);
    }

    public function deleteData()
    {
        $id = $this->request->getPost('id');

        $data = $this->nasabahModel->deleteData($id);

        echo $data;
    }

    public function getdatadetailNasabah()
    {
        $data = [
            'title' => 'system',
            'jenistabungan' => $this->dropdownJenistabungan,
            'jeniskelamin' => $this->dropdownJenisKelamin
        ];
        return view('admin/pages/nasabah', $data);
    }

    public function savedata()
    {
        try {
            if (empty($this->request->getPost('nis'))) {
                $nis = $this->nasabahModel->getNewNis($this->request->getPost('jt'))->nis;
            } else {
                $nis = $this->request->getPost('nis');
            }
            $norek = "3030" . strval(substr($nis, -4)) . strval($this->request->getPost('thMasuk'));

            $params = [
                'id' => $this->request->getPost('id'),
                'nis' => $nis,
                'nama' => $this->request->getPost('nama'),
                'jenis_tabungan' => $this->request->getPost('jt'),
                'nomor_rekening' =>  $norek,
                'alamat' => $this->request->getPost('alamat'),
                'jenis_kelamin' => $this->request->getPost('jk'),
                'tanggal_masuk' => $this->request->getPost('thMasuk'),
                'created_by' => session()->get('userid')
            ];

            if ($this->request->getPost('flag') == 'insert')
                $data = $this->nasabahModel->savedata($params);
            else
                $data = $this->nasabahModel->editdata($params);
            if (!$data) {
                //session()->setFlashdata('pesan', 'Error! data tidak gagal di simpan');
                $response = [
                    'title' => 'error',
                    'content' => $data
                ];
            } else {
                //session()->setFlashdata('pesan', 'Data berhasi disimpan!');
                $response = [
                    'title' => 'success',
                    'content' => $data
                ];
            }

            echo json_encode($response);
            die;
        } catch (Exception $ex) {
            $response = [
                'title' => 'success',
                'content' => $ex->getMessage()
            ];
            echo json_encode($response);
            die;
        }
    }

    public function print($norek,$nama,$alamat,$nis)
    {
        $listdata = [
            'flag' => 'nasabah',
            'norek' => $norek,
            'nama' => $nama,
            'alamat' => $alamat,
            'nis' => $nis
        ];

        $this->generate($listdata);

    }
}
