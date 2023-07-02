<?php

namespace app\controllers;

use app\classes\Validate;
use app\controllers\User as ControllersUser;
use app\database\builder\DeleteQuery;
use app\database\builder\InsertQuery;
use app\database\builder\ReadQuery;
use app\database\builder\UpdateQuery;
use app\database\models\User;
use DI\Container;
use Psr\Container\ContainerInterface;

class Home extends Controller
{   
    public function index($request, $response)
    {                
        
        $search = $_GET['s'] ?? '';

        $users = ReadQuery::select('users.id,firstName,lastName')
        ->from('users')
        ->where('users.id', '>=', 1, 'and')
        ->where('firstName', 'like', "%{$search}%")
        ->order('users.id', 'desc')
        ->paginate(10);
        

        // $updated = UpdateQuery::table('users')->set([
        //     'firstName' => 'Marcos',
        //     'lastName' => 'Santos',
        // ])->where('id', '=', 20)->update();


        // $deleted = DeleteQuery::table('users')->where('id', '=', 20)->delete();

        // $crated = InsertQuery::into('users')->insert([
        //     'firstName' => 'Alexandre',
        //     'lastName' => 'Cardoso',
        //     'email' => 'xandecar@hotmail.com',
        //     'password' => password_hash('123', PASSWORD_DEFAULT),
        // ]);

        $this->render('site/home', ['users' => $users, 'title' => 'Home']);

        return $response;
    }
}