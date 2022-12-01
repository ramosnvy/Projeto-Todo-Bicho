<?php

use \App\Controller\Pages;
use App\Http\Response;

//ROTA LOGIN
$obRouter->get('/login', [ 'middlewares' =>['required-admin-logout'],
    function($request){
        return new Response(200, App\Controller\Admin\Login::getLogin($request));
    }
]);

//ROTA LOGIN
$obRouter->post('/login', [ 'middlewares' =>['required-admin-logout'],
    function($request){
        return new Response(200, App\Controller\Admin\Login::setLogin($request));
    }
]);

//ROTA LOGIN
$obRouter->get('/logout', [ 'middlewares' =>['required-admin-login'],
    function($request){
        return new Response(200, App\Controller\Admin\Login::setLogout($request));
    }
]);


//ROTA CADASTRAR
$obRouter->get('/cadastrar', [ 'middlewares' =>['required-admin-login'],
    function(){
        return new Response(200, Pages\Cadastrar::getCadastrar());
    }
]);

//ROTA CADASTRAR
$obRouter->post('/cadastrar', [ 'middlewares' =>['required-admin-login'],
    function($request){
        return new Response(200, Pages\Cadastrar::insertAnimais($request));
    }
]);


//ROTA PAINEL
$obRouter->get('/painel', [ 'middlewares' =>['required-admin-login'],
    function(){
        return new Response(200, Pages\Painel::getPainel());
    }
]);

//ROTA PAINEL
$obRouter->get('/delete', [ 'middlewares' =>['required-admin-login'],
    function(){
        return new Response(200, Pages\());
    }
]);



