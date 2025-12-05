<?php 
namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        echo view('Auth/login');
    }
}



?>