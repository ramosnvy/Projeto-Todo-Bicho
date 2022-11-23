<?php

use \App\Controller\Pages;
use App\Http\Response;

//ROTA ADOÇÃO
$obRouter->get('/adote',[
    function(){
        return new Response(200, Pages\Adote::getAdote());
    }
]);

//ROTAA DOACAO
$obRouter->get('/doacao', [
    function(){
        return new Response(200, Pages\Doacao::getDoacao());
    }
]);

//ROTA HOME
$obRouter->get('/', [
    function(){
        return new Response(200, Pages\Home::getHome());
    }
]);

//ROTA LOGIN
$obRouter->get('/login', [
    function(){
        return new Response(200, Pages\Login::getLogin());
    }
]);

//ROTA PAINEL
$obRouter->get('/painel', [
    function(){
        return new Response(200, Pages\Painel::getPainel());
    }
]);


//ROTA CADASTRAR
$obRouter->get('/cadastrar', [
    function(){
        return new Response(200, Pages\Cadastrar::getCadastrar());
    }
]);

//ROTA CADASTRAR
$obRouter->post('/cadastrar', [
    function($request){
        return new Response(200, Pages\Cadastrar::insertAnimais($request));
    }
]);

