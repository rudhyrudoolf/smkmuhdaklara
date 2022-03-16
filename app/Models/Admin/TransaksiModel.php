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
}
