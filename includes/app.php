<?php

require __DIR__ . '/../vendor/autoload.php';


use \App\Utils\View;
use \WilliamCosta\DotEnv\Environment;
use \WilliamCosta\DatabaseManager\Database;
use \App\Http\Middleware\Queue as MiddlewareQueue;




//DEFINE AS CONFIGURAÇÕES DO BANCO DE DADOS

Database::config( 'localhost', 'projeto_todobicho', 'root', '');




//CARREGA VARIAVEIS DO SISTEMA
Environment::load(__DIR__ . '/../');

//DEFINE CONSTANTE DE URL

define('URL', getenv('URL'));

//DEFINE O VALOR PADRÃO DAS VARIAVEIS
View::init(['URL'=> URL]);

//DEFINE O MAPEAMENTO DE MIDDLEWARES

MiddlewareQueue::setMap([
    'maintenance'=>\App\Http\Middleware\Maintenance::class
]);
