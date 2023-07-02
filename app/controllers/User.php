<?php

namespace app\controllers;

use app\classes\Flash;
use app\classes\Validate;
use app\database\models\User as ModelsUser;
use Psr\Container\ContainerInterface;

class User extends Controller
{
    private $user;
    private $validate;

    public function __construct()
    {
        $this->validate = new Validate;
        $this->user = new ModelsUser;
    }

    public function create($request, $response, $args)
    {
        $this->render('site/user_create');
        return $response;
    }

    public function edit($request, $response, $args)
    {
        $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);

        $user = $this->user->findBy('users', 'id', $id);

        if (!$user) {
            Flash::set('message', 'usuário não existe', 'danger');
            return redirect($response, '/');
        }

        $this->render('site/user_edit');


        return $response;
    }

    public function store($request, $response)
    {
        $firstName = strip_tags($_POST['firstName']);
        $lastName  = strip_tags($_POST['lastName']);
        $email     = strip_tags($_POST['email']);
        $password  = strip_tags($_POST['password']);


        $this->validate->required(['firstName', 'lastName', 'email', 'password'])->exists($this->user, 'users', 'email', $email);
        $erros = $this->validate->getErros();

        if ($erros) {
            return redirect($response, '/user/create');
        }

        $created = $this->user->create(['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

        if ($created) {
            Flash::set('message', 'cadastrado com sucesso');
            return redirect($response, '/');
        }

        Flash::set('message', 'Ocorreu um erro ao cadastrar o usuario');
        return redirect($response, '/user/create');

        return $response;
    }

    public function update($request, $response, $args)
    {
        $firstName = strip_tags($_POST['firstName']);
        $lastName  = strip_tags($_POST['lastName']);
        $email     = strip_tags($_POST['email']);
        $password  = strip_tags($_POST['password']);
        $id        = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);

        $this->validate->required(['firstName', 'lastName', 'email', 'password']);
        $errors = $this->validate->getErros();

        if ($errors) {
            return redirect($response, '/user/edit/' . $id);
        }

        $updated = $this->user->update(['fields' =>
        ['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)], 'where' => ['id' => $id]]);

        if ($updated) {
            Flash::set('message', 'Atualizado com sucesso');
            return redirect($response, '/user/edit/' . $id);
        }

        Flash::set('message', 'Ocorreu um erro ao atualizar', 'danger');
        return redirect($response, '/user/edit/' . $id);
    }

    public function destroy($request, $response, $args)
    {
        $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);

        $user = $this->user->findBy('users', 'id', $id);

        if (!$user) {
            Flash::set('message', 'usuário não existe', 'danger');
            return redirect($response, '/');
        }

        $deleted = $this->user->delete('users', ['id' => $id]);

        if ($deleted) {
            Flash::set('message', 'Deletado com sucesso');
            return redirect($response, '/');
        }

        Flash::set('message', 'Ocorreu um erro ao deletar', 'danger');
        return redirect($response, '/');
    }
}
