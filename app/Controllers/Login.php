<?php

namespace App\Controllers;

use \App\Models\AuthModel;


class Login extends BaseController
{
    public $data = [];
    
    protected $authModel;
    protected $db;

    public function __construct()
    {
        $this->authModel = new AuthModel();
        //$this->db = \Config\Database::connect();

    }
    

    public function index()
    {
        $data = ['title'=> 'Login | SMAMUHDAKLARA'];

        return view('login',$data);
    }

    public function auth()
    {
        $session = session();   
        
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('pwd')
        ];

        $data = $this->authModel->getUserAuth($data['username'],$data['password']);
        //dd($data);

        if($data != null)
        {
            $ses_data = [
                    'userid' => $data->nama,
                    'logged_in' => TRUE

            ];
            $session->set($ses_data);
            return redirect()->to('/home');
        }
        else
        {
            $session->setFlashdata('msg', 'Email atau password salah!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
