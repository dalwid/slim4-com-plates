<?php

namespace app\controllers;

use app\classes\Flash;
use app\classes\Login as ClassesLogin;
use app\classes\Validate;

class Login extends Controller
{
    private $login;

    public function __construct()
    {
        $this->login = new ClassesLogin;
    }
    
    public function index($request, $response)
    {
        $this->render('site/login');
        return $response;
    }

    public function store($querest, $response)
    {
        $email     = strip_tags($_POST['email']);
        $password  = strip_tags($_POST['password']);

        $validate = new Validate;
        $validate->required(['email', 'password'])->email($email);
        $erros = $validate->getErros();

        if($erros){
            return redirect($response, '/login');
        }

        $logged = $this->login->login($email, $password);

        if($logged){
            return redirect($response, '/');
        }
        Flash::set('message', 'Ocorreu um erro ao logar, tente novamente em segundos', 'danger');
        return redirect($response, '/login');
    }

    public function destroy($querest, $response)
    {
        $this->login->logout();
        return redirect($response, '/');
    }
}