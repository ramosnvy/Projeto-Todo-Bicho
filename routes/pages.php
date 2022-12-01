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

