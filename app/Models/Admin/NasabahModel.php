<?php

namespace App\Models\Admin;

use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;

class NasabahModel extends Model
{
    protected $table =  "TB_M_NASABAH";
    protected $allowedFields = ['nis', 'nama', 'jenis_tabungan', 'nomor_rekening', 'alamat', 'jenis_kelamin', 'tanggal_masuk', 'created_by', 'updated_by'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = '';
    protected $updatedField  = '';


    protected $validationRules    = [];

    public function getNewNis($param)
    {
        $query = "select CONCAT('$param', RIGHT (CONCAT('0000', IFNULL(Max(RIGHT (nis,4)),0)+1),4)) as nis  FROM  TB_M_NASABAH where jenis_tabungan = :params:";

        $result = $this->db->query($query, [
            'params' => $param
        ]);

        return $result->getRow();
    }

    public function getNorekening()
    {
        $query = "select CONCAT(3030,id,RIGHT(nis,4),tanggal_masuk) norek from TB_M_NASABAH;";

        $result = $this->db->query($query);

        return $result->getRow();
    }

    public function getData($param = false)
    {
        $query = "
        select 
            tmn.id,
            tmn.nis,
            tmn.jenis_tabungan jtCode,
            ts.systemDesc as jenis_tabungan,
            tmn.nomor_rekening,
            tmn.Nama,
            tmn.Alamat,
            ts2.systemDesc as jenis_kelamin,
            tmn.jenis_kelamin jkCode,
            tmn.tanggal_masuk  as tahunMasuk
        from TB_M_NASABAH tmn 
        INNER JOIN tblsystem ts ON tmn.jenis_tabungan = ts.systemCode AND ts.systemType = 'dropdown_jenis_tabungan' 
        INNER JOIN tblsystem ts2 ON tmn.jenis_kelamin = ts2.systemCode AND ts2.systemType = 'dropdown_jenis_kelamin' 
        ";
        if (!$param) {

            $data = $this->db->query($query)->getResultArray();
        } else {
            $query = $query . " Where tmn.id = :id:";
            $data = $this->query($query, ["id" => $param])->getResultArray();
        }

        return $data;
    }

    public function savedata($param)
    {
        $data = [
            'nis' => $param['nis'],
            'nama' => $param['nama'],
            'jenis_tabungan' => $param['jenis_tabungan'],
            'nomor_rekening' => $param['nomor_rekening'],
            'alamat' => $param['alamat'],
            'jenis_kelamin' => $param['jenis_kelamin'],
            'tanggal_masuk' => $param['tanggal_masuk'],
            'created_by' => $param['created_by']
        ];
        $this->createdField = 'created_dt';
        $data = $this->save($data);
        return $data;
    }

    public function editdata($param)
    {
        $data = [
            'id' => $param['id'],
            'nama' => $param['nama'],
            'alamat' => $param['alamat'],
            'jenis_kelamin' => $param['jenis_kelamin'],
            'updated_by' => $param['created_by']
        ];
        $this->updatedField  = 'updated_dt';

        $data = $this->save($data);
        return $data;
    }

    public function getDataRekening($params)
    {
        $data = $this->like('nomor_rekening', $params)->findAll();
        $list = [];
        $key = 0;
        foreach ($data as $row) :
            $list[$key]['id'] = $row['id'];
            $list[$key]['text'] = $row['nomor_rekening'];
            $key++;
        endforeach;
        return $list;
    }
}
