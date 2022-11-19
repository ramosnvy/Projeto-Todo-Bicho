<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Animal;

class Doacao extends Page {

    /**
     * Método responsável por retornar o conteúdo (view)
     * @return string
     */
    public static function getDoacao(){

        $content = View::render('pages/doacao', []);

        return self::getPage('Doacao', $content);
    }



}