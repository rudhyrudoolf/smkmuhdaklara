<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class NasabahModel extends Model
{
    protected $table =  "TB_M_NASABAH";
    protected $allowedFields = ['nis', 'nama', 'jenis_tabungan', 'nomor_rekening', 'alamat', 'jenis_kelamin', 'tanggal_masuk', 'created_by'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_dt';
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
        if (!$param) {
            $query = "
            select 
                tmn.nis,
                ts.systemDesc as jenis_tabungan,
                tmn.nomor_rekening,
                tmn.Nama,
                tmn.Alamat,
                ts2.systemDesc as jenis_kelamin,
                tmn.tanggal_masuk  as tahunMasuk
            from TB_M_NASABAH tmn 
            INNER JOIN tblsystem ts ON tmn.jenis_tabungan = ts.systemCode AND ts.systemType = 'dropdown_jenis_tabungan' 
            INNER JOIN tblsystem ts2 ON tmn.jenis_kelamin = ts2.systemCode AND ts2.systemType = 'dropdown_jenis_kelamin' 
            ";

            $data = $this->db->query($query)->getResultArray();
        } else
            $data = $this->where('id', $param)->findAll();

        return $data;
    }

    public function savedata($param)
    {
        $data = $this->save($param);
        return $data;
    }
}
