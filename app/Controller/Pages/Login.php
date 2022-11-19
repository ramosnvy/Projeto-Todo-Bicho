<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Animal;

class Login extends Page {

    /**
     * Método responsável por retornar o conteúdo (view)
     * @return string
     */
    public static function getLogin(){

        $obAnimal = new Animal();

        $content = View::render('pages/login', []);

        return self::getPage('Login', $content);
    }



}