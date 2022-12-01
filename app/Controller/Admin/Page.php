<?php

namespace App\Controller\Admin;

use App\Utils\View;

class Page
{
    /**
     * Método responsável por retornar o conteúdo da mpssa página genérica
     * @return string
     */
    public static function getPage($title, $content){
        return View::render('admin/page', ['Title'=>$title, 'content'=>$content,]);
    }
}