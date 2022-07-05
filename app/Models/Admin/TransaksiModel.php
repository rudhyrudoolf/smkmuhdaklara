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

    public function addData($param, $flag)
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
            'sandi' => $flag == 'insert' ? $param['sandi'] : 6,
            'created_by' => session()->get('userid')
        ];
        $this->createdField = 'created_dt';
        $data = $this->save($data);
        if($data) $data = $this->getInsertID();
        return $data;
    }

    public function getdata($periodFrom,$periodTo)  
    {
        $query = "select t.nis, sys.systemDesc, tmn.nama,t.debit, t.kredit ,t.saldo, t.sandi,tmn.id as norek ,t.created_by ,t.created_dt  from transaksi t
        INNER JOIN TB_M_NASABAH tmn ON t.nis = tmn.nis
        INNER JOIN tblsystem sys ON tmn.jenis_tabungan = sys.systemCode 
        WHERE CAST(t.created_dt AS DATE) between ? ANd ?
        ORDER BY tmn.nama asc, t.created_dt asc ";

        $data = $this->db->query($query,[$periodFrom, $periodTo])->getResultArray();
        return $data;
    }

    public function getdetailData($periodFrom, $periodTo)
    {
        $query = "select t.nis, tmn.nama,t.debit, t.kredit ,t.saldo, t.sandi,tmn.id as norek ,t.created_by ,t.created_dt  from transaksi t
        INNER JOIN TB_M_NASABAH tmn ON t.nis = tmn.nis
        WHERE CAST(t.created_dt AS DATE) between ? ANd ? 
        ORDER BY tmn.nama
        ";

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

    public function searchDataMutasi($norek, $periodFrom,$periodTo,$idTransaksi)
    {
        $query = "select t.nis,t.idtransaksi, tmn.nama,t.debit, t.kredit ,t.saldo, t.sandi,t.nomor_rekening as norek ,t.created_by ,DATE_FORMAT(t.created_dt,'%d/%m/%Y') created_dt  from transaksi t
        INNER JOIN TB_M_NASABAH tmn ON t.nis = tmn.nis
        WHERE t.nomor_rekening = :norek: AND CAST(t.created_dt as DATE) BETWEEN :periodFrom: AND :periodTo: AND (:id: is null or t.idtransaksi = :id:)";
        
        $bind = [
            'norek' =>  $norek,
            'periodFrom' => $periodFrom,
            'periodTo' => $periodTo,
            'id' => $idTransaksi == '' ? null : $idTransaksi
        ];
        $data = $this->db->query($query, $bind)->getResultArray();
        return $data;
    }

    public function searchDataMutasiById($id)
    {
        $query = "select t.nis, tmn.nama,t.debit, t.kredit ,t.saldo, t.sandi,t.nomor_rekening as norek ,t.created_by ,DATE_FORMAT(t.created_dt,'%d/%m/%Y') created_dt  from transaksi t
        INNER JOIN TB_M_NASABAH tmn ON t.nis = tmn.nis
        WHERE t.idtransaksi = ? ";

        $data = $this->db->query($query, [$id])->getResultArray();
        return $data;
    }
}
