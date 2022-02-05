<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    public function getUserAuth($username, $password)
    {
        $db = \Config\Database::connect();

        if ($db->connect_error) {
            var_dump("Connection failed: " . $db->connect_error);
            die();
        }

        $query = "SELECT B.nama FROM tbluser A
        INNER JOIN tblkaryawan B ON A.usercode = B.usercode        
        where username = :username: AND password = :pwd:";
        $result = $db->query($query, [
            'username' => $username,
            'pwd' => $password
        ]);

        return $result->getRow();
        // if(!$result)
        // {
        //     return $db->error();
        // }else{
        //     return $result;
        // }
    }

    public function getdata()
    {
        return "data berhasil";
    }
}
