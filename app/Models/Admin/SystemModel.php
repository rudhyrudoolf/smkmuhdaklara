<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class SystemModel extends Model
{
    protected $table =  "tblsystem";
    protected $returnType = 'array';

    public function getDataSystem($param)
    {
        return $this->where('systemType', $param)->findAll();
    }
}
