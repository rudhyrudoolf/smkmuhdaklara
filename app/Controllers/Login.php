<?php

namespace App\Controllers;

class Login extends BaseController
{
    public $data = [];
    
    

    public function __constructor()
    {
        $this->load->helper('form');
        $this->load->helper('url');   
        $this->load->library('session');
        
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
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('pwd')
        ];
        //dd($data['email']);

        if($data['email'] == 'admin@admin.com' && $data['password']=='admin')
        {
            $ses_data = [
                    'userid' => 'Admin',
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
