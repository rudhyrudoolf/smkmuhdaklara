<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
use Faker\Core\Number;
use phpDocumentor\Reflection\PseudoTypes\Numeric_;
use phpDocumentor\Reflection\Types\Float_;

class TransaksiModel extends Model
{
    protected $table =  "transaksi";
    protected $allowedFields = ['nomor_rekening', 'nis', 'debit', 'kredit', 'saldo', 'sandi', 'created_by', 'updated_by'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = '';
    protected $updatedField  = '';

    public function addData($param)
    {
        $kredit = intval($param['kredit']);
        $debit = intval($param['debit']);
        $nis = $param['nis'];

        $query = "select saldo  FROM  transaksi t where nomor_rekening = :norek: order by idtransaksi  DESC";
        $result = $this->db->query($query, ['norek' => $param['norek']]);
        $saldo = $result->getRow();

        // formula
        if ($saldo == null) {
            $saldo = 0;
            $saldo = $kredit;
        } else {
            $saldo = intval($saldo->saldo) + $kredit - $debit;
        }

        // return intval($saldo->saldo);

        $data = [
            'nomor_rekening' => $param['norek'],
            'nis' => $nis,
            'debit' => $debit,
            'kredit' => $kredit,
            'saldo' => $saldo,
            'sandi' => $param['sandi'],
            'created_by' => session()->get('userid')
        ];
        $this->createdField = 'created_dt';
        $data = $this->save($data);
        return $data;
    }

    public function getdata($periodFrom,$periodTo)
    {
        $query = "select t.nis, tmn.nama,t.debit, t.kredit ,t.saldo, t.sandi,tmn.id as norek ,t.created_by ,t.created_dt  from transaksi t
        INNER JOIN TB_M_NASABAH tmn ON t.nis = tmn.nis
        WHERE CAST(t.created_dt AS DATE) between ? ANd ?";

        $data = $this->db->query($query,[$periodFrom, $periodTo])->getResultArray();
        return $data;
    }

    public function getdetailData($periodFrom, $periodTo)
    {
        $query = "select t.nis, tmn.nama,t.debit, t.kredit ,t.saldo, t.sandi,tmn.id as norek ,t.created_by ,t.created_dt  from transaksi t
        INNER JOIN TB_M_NASABAH tmn ON t.nis = tmn.nis
        WHERE CAST(t.created_dt AS DATE) between ? ANd ? 
        ORDER BY tmn.nama";

        $data = $this->db->query($query, [$periodFrom, $periodTo])->getResultArray();
        return $data;
    }

    public function getsaldoTransaksi($periodTo, $periodFrom)
    {

        $query = "select IFNULL(SUM(kredit)-SUM(debit),0) as saldo from transaksi t 
        WHERE CAST(created_dt as DATE) BETWEEN ? AND ?";

        $result = $this->db->query($query, [$periodTo, $periodFrom]);
        return $result->getFirstRow();
    }
    public function getKreditTransaksi($periodTo, $periodFrom)
    {

        $query = "select IFNULL(SUM(kredit),0) as kredit from transaksi t 
        WHERE CAST(created_dt as DATE) BETWEEN ? AND ?";

        $result = $this->db->query($query, [$periodTo, $periodFrom]);
        return $result->getFirstRow();
    }
    public function getDebitTransaksi($periodTo, $periodFrom)
    {

        $query = "select IFNULL(SUM(debit),0) as debit from transaksi t 
        WHERE CAST(created_dt as DATE) BETWEEN ? AND ?";

        $result = $this->db->query($query, [$periodTo, $periodFrom]);
        return $result->getFirstRow();
    }

    public function searchDataMutasi($norek, $kodeTransaksi)
    {
        $query = "select t.nis, tmn.nama,t.debit, t.kredit ,t.saldo, t.sandi,t.nomor_rekening as norek ,t.created_by ,t.created_dt  from transaksi t
        INNER JOIN TB_M_NASABAH tmn ON t.nis = tmn.nis
        WHERE t.nomor_rekening = ? AND t.idtransaksi > ?";

        $data = $this->db->query($query, [$norek, $kodeTransaksi])->getResultArray();
        return $data;
    }
}
